<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefIndikator;

/**
 * RefIndikatorSearch represents the model behind the search form about `common\models\RefIndikator`.
 */
class RefIndikatorSearch extends RefIndikator
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Indikator'], 'integer'],
            [['Nm_Indikator'], 'safe'],
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
        $query = RefIndikator::find();

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
            'Kd_Indikator' => $this->Kd_Indikator,
        ]);

        $query->andFilterWhere(['like', 'Nm_Indikator', $this->Nm_Indikator]);

        return $dataProvider;
    }
}
