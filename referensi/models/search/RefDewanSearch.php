<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\RefDewan;

/**
 * RefDewanSearch represents the model behind the search form about `eperencanaan\models\RefDewan`.
 */
class RefDewanSearch extends RefDewan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Dewan'], 'safe'],
            [['Kd_Dapil', 'Kd_Dewan'], 'integer'],
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
        $query = RefDewan::find();

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
            'Kd_Dapil' => $this->Kd_Dapil,
            'Kd_Dewan' => $this->Kd_Dewan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Dewan', $this->Nm_Dewan]);

        return $dataProvider;
    }
}
