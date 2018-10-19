<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaMusrenbangKelurahan;

/**
 * TaMusrenbangKelurahanSearch represents the model behind the search form of `eperencanaan\models\TaMusrenbangKelurahan`.
 */
class TaMusrenbangKelurahanSearch extends TaMusrenbangKelurahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Permasalahan', 'Jenis_Usulan'], 'safe'],
            [['Kd_Ta_Muserenbang_Kelurahan', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'Kd_Status'], 'integer'],
            [['Harga_Satuan', 'Harga_Total'], 'number'],
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
        $query = TaMusrenbangKelurahan::find();

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
            'Kd_Ta_Muserenbang_Kelurahan' => $this->Kd_Ta_Muserenbang_Kelurahan,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Jumlah' => $this->Jumlah,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga_Satuan' => $this->Harga_Satuan,
            'Harga_Total' => $this->Harga_Total,
            'Kd_Sasaran' => $this->Kd_Sasaran,
            'Tanggal' => $this->Tanggal,
            'Kd_Status' => $this->Kd_Status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan]);

        return $dataProvider;
    }
}
