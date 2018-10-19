<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPotSPMRek;

/**
 * RefPotSPMRekSearch represents the model behind the search form about `common\models\RefPotSPMRek`.
 */
class RefPotSPMRekSearch extends RefPotSPMRek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Pot_Rek', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Pot'], 'integer'],
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
        $query = RefPotSPMRek::find();

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
            'Kd_Pot_Rek' => $this->Kd_Pot_Rek,
            'Kd_Rek_1' => $this->Kd_Rek_1,
            'Kd_Rek_2' => $this->Kd_Rek_2,
            'Kd_Rek_3' => $this->Kd_Rek_3,
            'Kd_Rek_4' => $this->Kd_Rek_4,
            'Kd_Rek_5' => $this->Kd_Rek_5,
            'Kd_Pot' => $this->Kd_Pot,
        ]);

        return $dataProvider;
    }
}
