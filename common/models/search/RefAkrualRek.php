<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAkrualRek as RefAkrualRekModel;

/**
 * RefAkrualRek represents the model behind the search form about `common\models\RefAkrualRek`.
 */
class RefAkrualRek extends RefAkrualRekModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5', 'Kd_AkrualD_1', 'Kd_AkrualD_2', 'Kd_AkrualD_3', 'Kd_AkrualD_4', 'Kd_AkrualD_5', 'Kd_AkrualK_1', 'Kd_AkrualK_2', 'Kd_AkrualK_3', 'Kd_AkrualK_4', 'Kd_AkrualK_5'], 'integer'],
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
        $query = RefAkrualRekModel::find();

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
            'Kd_Akrual_1' => $this->Kd_Akrual_1,
            'Kd_Akrual_2' => $this->Kd_Akrual_2,
            'Kd_Akrual_3' => $this->Kd_Akrual_3,
            'Kd_Akrual_4' => $this->Kd_Akrual_4,
            'Kd_Akrual_5' => $this->Kd_Akrual_5,
            'Kd_AkrualD_1' => $this->Kd_AkrualD_1,
            'Kd_AkrualD_2' => $this->Kd_AkrualD_2,
            'Kd_AkrualD_3' => $this->Kd_AkrualD_3,
            'Kd_AkrualD_4' => $this->Kd_AkrualD_4,
            'Kd_AkrualD_5' => $this->Kd_AkrualD_5,
            'Kd_AkrualK_1' => $this->Kd_AkrualK_1,
            'Kd_AkrualK_2' => $this->Kd_AkrualK_2,
            'Kd_AkrualK_3' => $this->Kd_AkrualK_3,
            'Kd_AkrualK_4' => $this->Kd_AkrualK_4,
            'Kd_AkrualK_5' => $this->Kd_AkrualK_5,
        ]);

        return $dataProvider;
    }
}
