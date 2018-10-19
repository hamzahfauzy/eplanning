<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaPeraturan;

/**
 * TaPeraturanSearch represents the model behind the search form about `backend\models\TaPeraturan`.
 */
class TaPeraturanSearch extends TaPeraturan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Peraturan', 'No_ID'], 'integer'],
            [['No_Peraturan', 'Tgl_Peraturan', 'Uraian'], 'safe'],
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
            'Kd_Peraturan' => $this->Kd_Peraturan,
            'No_ID' => $this->No_ID,
            'Tgl_Peraturan' => $this->Tgl_Peraturan,
        ]);

        $query->andFilterWhere(['like', 'No_Peraturan', $this->No_Peraturan])
            ->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
