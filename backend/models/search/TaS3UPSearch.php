<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaS3UP;

/**
 * TaS3UPSearch represents the model behind the search form about `backend\models\TaS3UP`.
 */
class TaS3UPSearch extends TaS3UP
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_BKU', 'Kd_Bank', 'Kd_Pembayaran'], 'integer'],
            [['No_Bukti', 'Tgl_Bukti', 'D_K', 'Keterangan'], 'safe'],
            [['Nilai'], 'number'],
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
        $query = TaS3UP::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Tgl_Bukti' => $this->Tgl_Bukti,
            'No_BKU' => $this->No_BKU,
            'Kd_Bank' => $this->Kd_Bank,
            'Kd_Pembayaran' => $this->Kd_Pembayaran,
            'Nilai' => $this->Nilai,
        ]);

        $query->andFilterWhere(['like', 'No_Bukti', $this->No_Bukti])
            ->andFilterWhere(['like', 'D_K', $this->D_K])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
