<?php

namespace emusrenbang\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\RefSubUnitApbn;

/**
 * RefSubUnitApbnSearch represents the model behind the search form of `emusrenbang\models\RefSubUnitApbn`.
 */
class RefSubUnitApbnSearch extends RefSubUnitApbn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Flag'], 'integer'],
            [['Nm_Sub_Unit', 'Token'], 'safe'],
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
        $query = RefSubUnitApbn::find();

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
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Flag' => $this->Flag,
        ]);

        $query->andFilterWhere(['like', 'Nm_Sub_Unit', $this->Nm_Sub_Unit])
            ->andFilterWhere(['like', 'Token', $this->Token]);

        return $dataProvider;
    }
}
