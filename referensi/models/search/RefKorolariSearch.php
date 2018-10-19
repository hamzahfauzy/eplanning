<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKorolari;

/**
 * RefKorolariSearch represents the model behind the search form about `common\models\RefKorolari`.
 */
class RefKorolariSearch extends RefKorolari
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'D_Rek_1', 'D_Rek_2', 'D_Rek_3', 'D_Rek_4', 'D_Rek_5', 'K_Rek_1', 'K_Rek_2', 'K_Rek_3', 'K_Rek_4', 'K_Rek_5'], 'integer'],
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
        $query = RefKorolari::find();

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
            'Kd_Rek_1' => $this->Kd_Rek_1,
            'Kd_Rek_2' => $this->Kd_Rek_2,
            'Kd_Rek_3' => $this->Kd_Rek_3,
            'Kd_Rek_4' => $this->Kd_Rek_4,
            'Kd_Rek_5' => $this->Kd_Rek_5,
            'D_Rek_1' => $this->D_Rek_1,
            'D_Rek_2' => $this->D_Rek_2,
            'D_Rek_3' => $this->D_Rek_3,
            'D_Rek_4' => $this->D_Rek_4,
            'D_Rek_5' => $this->D_Rek_5,
            'K_Rek_1' => $this->K_Rek_1,
            'K_Rek_2' => $this->K_Rek_2,
            'K_Rek_3' => $this->K_Rek_3,
            'K_Rek_4' => $this->K_Rek_4,
            'K_Rek_5' => $this->K_Rek_5,
        ]);

        return $dataProvider;
    }
}
