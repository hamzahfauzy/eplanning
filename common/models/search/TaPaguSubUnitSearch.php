<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaPaguSubUnit;

/**
 * TaPaguSubUnitSearch represents the model behind the search form of `common\models\TaPaguSubUnit`.
 */
class TaPaguSubUnitSearch extends TaPaguSubUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['pagu'], 'number'],
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
        $query = TaPaguSubUnit::find();

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
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'pagu' => $this->pagu,
        ]);

        return $dataProvider;
    }

}
