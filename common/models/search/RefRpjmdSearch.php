<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefRpjmd;

/**
 * RefRpjmdSearch represents the model behind the search form about `common\models\RefRpjmd`.
 */
class RefRpjmdSearch extends RefRpjmd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Prioritas_Pembangunan_Kota', 'Keterangan'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Prioritas_Pembangunan_Kota'], 'integer'],
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
        $query = RefRpjmd::find();

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
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Prioritas_Pembangunan_Kota' => $this->Kd_Prioritas_Pembangunan_Kota,
        ]);

        $query->andFilterWhere(['like', 'Nm_Prioritas_Pembangunan_Kota', $this->Nm_Prioritas_Pembangunan_Kota])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
