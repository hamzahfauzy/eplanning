<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaPrioritas;

/**
 * TaPrioritasSearch represents the model behind the search form about `backend\models\TaPrioritas`.
 */
class TaPrioritasSearch extends TaPrioritas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prioritas'], 'integer'],
            [['Nm_Prioritas', 'Tema'], 'safe'],
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
        $query = TaPrioritas::find();

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
            'Kd_Prioritas' => $this->Kd_Prioritas,
        ]);

        $query->andFilterWhere(['like', 'Nm_Prioritas', $this->Nm_Prioritas])
            ->andFilterWhere(['like', 'Tema', $this->Tema]);

        return $dataProvider;
    }
}
