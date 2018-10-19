<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPotSPM;

/**
 * RefPotSPMSearch represents the model behind the search form about `common\models\RefPotSPM`.
 */
class RefPotSPMSearch extends RefPotSPM
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Pot'], 'integer'],
            [['Nm_Pot', 'Kd_MAP'], 'safe'],
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
        $query = RefPotSPM::find();

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
            'Kd_Pot' => $this->Kd_Pot,
        ]);

        $query->andFilterWhere(['like', 'Nm_Pot', $this->Nm_Pot])
            ->andFilterWhere(['like', 'Kd_MAP', $this->Kd_MAP]);

        return $dataProvider;
    }
}
