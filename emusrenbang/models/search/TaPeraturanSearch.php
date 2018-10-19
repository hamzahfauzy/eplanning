<?php

namespace emusrenbang\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\TaPeraturan;

/**
 * TaPeraturanSearch represents the model behind the search form about `emusrenbang\models\TaPeraturan`.
 */
class TaPeraturanSearch extends TaPeraturan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Peraturan', 'Tgl_Peraturan', 'Uraian'], 'safe'],
            [['Kd_Tahapan', 'Kd_Peraturan', 'No_ID'], 'integer'],
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
        $query = TaPeraturan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Tahapan' => $this->Kd_Tahapan,
            'Kd_Peraturan' => $this->Kd_Peraturan,
            'No_ID' => $this->No_ID,
            'Tgl_Peraturan' => $this->Tgl_Peraturan,
        ]);

        $query->andFilterWhere(['like', 'No_Peraturan', $this->No_Peraturan])
            ->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
