<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\PrioritasNasional;

/**
 * PrioritasNasionalSearch represents the model behind the search form about `app\models\PrioritasNasional`.
 */
class PrioritasNasionalSearch extends PrioritasNasional
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_nawacita'], 'integer'],
            [[
            'prioritas_nasional',
            'namaNawacita',
            'tahun'
            ], 'safe'],
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
        $query = PrioritasNasional::find();
        $query->select(['prioritas_nasional.*',
            'nc.nawacita namaNawacita'
        ]);
        $query->leftJoin('nawacita nc', 'nc.id=prioritas_nasional.id_nawacita')
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_nawacita' => $this->id_nawacita,
        ]);

        $query->andFilterWhere(['like', 'prioritas_nasional', $this->prioritas_nasional])
            ->andFilterWhere(['like', 'nawacita', $this->namaNawacita])
            ->andFilterWhere(['like', 'tahun', $this->tahun]);

        return $dataProvider;
    }
}
