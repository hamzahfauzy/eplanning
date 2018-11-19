<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefLRARek;

/**
 * RefLRARekSearch represents the model behind the search form about `common\models\RefLRARek`.
 */
class RefLRARekSearch extends RefLRARek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_LRA_1', 'Kd_LRA_2', 'Kd_LRA_3', 'Kd_LRA_4', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4'], 'integer'],
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
        $query = RefLRARek::find();

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
            'Kd_LRA_1' => $this->Kd_LRA_1,
            'Kd_LRA_2' => $this->Kd_LRA_2,
            'Kd_LRA_3' => $this->Kd_LRA_3,
            'Kd_LRA_4' => $this->Kd_LRA_4,
            'Kd_Rek_1' => $this->Kd_Rek_1,
            'Kd_Rek_2' => $this->Kd_Rek_2,
            'Kd_Rek_3' => $this->Kd_Rek_3,
            'Kd_Rek_4' => $this->Kd_Rek_4,
        ]);

        return $dataProvider;
    }
}
