<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefStandardHarga3 as RefStandardHarga3Model;

/**
 * RefStandardHarga3 represents the model behind the search form about `common\models\RefStandardHarga3`.
 */
class RefStandardHarga3 extends RefStandardHarga3Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Uraian', 'Keterangan'], 'safe'],
            [['Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'integer'],
            [['Harga'], 'number'],
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
        $query = RefStandardHarga3Model::find();

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
            'Kd_1' => $this->Kd_1,
            'Kd_2' => $this->Kd_2,
            'Kd_3' => $this->Kd_3,
            'Harga' => $this->Harga,
            'Kd_Satuan' => $this->Kd_Satuan,
        ]);

        $query->andFilterWhere(['like', 'Uraian', $this->Uraian])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
