<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaKalender as TaKalenderModel;

/**
 * TaKalender represents the model behind the search form of `common\models\TaKalender`.
 */
class TaKalender extends TaKalenderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Kalender'], 'integer'],
            [['Tahun', 'Waktu_Mulai', 'Waktu_Selesai', 'Keterangan'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TaKalenderModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Kalender' => $this->Kd_Kalender,
            'Tahun' => $this->Tahun,
            'Waktu_Mulai' => $this->Waktu_Mulai,
            'Waktu_Selesai' => $this->Waktu_Selesai,
        ]);

        $query->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
