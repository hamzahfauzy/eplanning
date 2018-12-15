<?php

namespace emonev\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emonev\models\RefUrusanApbn;

/**
 * RefUrusanApbnSearch represents the model behind the search form of `emusrenbang\models\RefUrusanApbn`.
 */
class RefUrusanApbnSearch extends RefUrusanApbn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Flag'], 'integer'],
            [['Nm_Urusan', 'Token'], 'safe'],
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
        $query = RefUrusanApbn::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Flag' => $this->Flag,
        ]);

        $query->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan])
            ->andFilterWhere(['like', 'Token', $this->Token]);

        return $dataProvider;
    }
}
