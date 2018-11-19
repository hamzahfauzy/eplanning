<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaMusrenbang;

/**
 * TaMusrenbangSearch represents the model behind the search form of `eperencanaan\models\TaMusrenbang`.
 */
class TaMusrenbangSearch extends TaMusrenbang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey', 'Kd_Prioritas_Pembangunan_Daerah', 'Status_Usulan', 'Kd_User', 'Kd1', 'Kd2', 'Kd3', 'Kd4', 'Kd5', 'Kd6','Status_Prioritas'], 'integer'],
            [['Tahun', 'Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi', 'Latitute', 'Longitude', 'Rincian_Skor', 'Status_Penerimaan_Kelurahan', 'Alasan_Kelurahan', 'Status_Penerimaan_Kecamatan', 'Alasan_Kecamatan', 'Status_Penerimaan_Skpd', 'Alasan_Skpd', 'Status_Penerimaan_Kota', 'Alasan_Kota', 'Kd_Asal', 'Uraian_Usulan', 'Kd_Asal_Usulan'], 'safe'],
            [['Harga_Satuan', 'Harga_Total', 'Skor'], 'number'],
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
        $query = TaMusrenbang::find();

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
            'id' => $this->id,
            'Tahun' => $this->Tahun,
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
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Pem' => $this->Kd_Pem,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Jumlah' => $this->Jumlah,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga_Satuan' => $this->Harga_Satuan,
            'Harga_Total' => $this->Harga_Total,
            'Kd_Sasaran' => $this->Kd_Sasaran,
            'Tanggal' => $this->Tanggal,
            'status' => $this->status,
            'Status_Survey' => $this->Status_Survey,
            'Kd_Prioritas_Pembangunan_Daerah' => $this->Kd_Prioritas_Pembangunan_Daerah,
            'Skor' => $this->Skor,
            'Status_Usulan' => $this->Status_Usulan,
            'Kd_User' => $this->Kd_User,
            'Kd1' => $this->Kd1,
            'Kd2' => $this->Kd2,
            'Kd3' => $this->Kd3,
            'Kd4' => $this->Kd4,
            'Kd5' => $this->Kd5,
            'Kd6' => $this->Kd6,
            'Status_Prioritas' => $this->Status_Prioritas,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi])
            ->andFilterWhere(['like', 'Latitute', $this->Latitute])
            ->andFilterWhere(['like', 'Longitude', $this->Longitude])
            ->andFilterWhere(['like', 'Rincian_Skor', $this->Rincian_Skor])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kelurahan', $this->Status_Penerimaan_Kelurahan])
            ->andFilterWhere(['like', 'Alasan_Kelurahan', $this->Alasan_Kelurahan])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kecamatan', $this->Status_Penerimaan_Kecamatan])
            ->andFilterWhere(['like', 'Alasan_Kecamatan', $this->Alasan_Kecamatan])
            ->andFilterWhere(['like', 'Status_Penerimaan_Skpd', $this->Status_Penerimaan_Skpd])
            ->andFilterWhere(['like', 'Alasan_Skpd', $this->Alasan_Skpd])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kota', $this->Status_Penerimaan_Kota])
            ->andFilterWhere(['like', 'Alasan_Kota', $this->Alasan_Kota])
            ->andFilterWhere(['like', 'Kd_Asal', $this->Kd_Asal])
            ->andFilterWhere(['like', 'Uraian_Usulan', $this->Uraian_Usulan])
            ->andFilterWhere(['like', 'Kd_Asal_Usulan', $this->Kd_Asal_Usulan]);

        return $dataProvider;
    }

    public function searchLaporanPokir($params)
    {
        $query = TaMusrenbang::find()
                ->where(['Kd_User' => Yii::$app->user->identity->id]);

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
            'id' => $this->id,
            'Tahun' => $this->Tahun,
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
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Pem' => $this->Kd_Pem,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Jumlah' => $this->Jumlah,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga_Satuan' => $this->Harga_Satuan,
            'Harga_Total' => $this->Harga_Total,
            'Kd_Sasaran' => $this->Kd_Sasaran,
            'Tanggal' => $this->Tanggal,
            'status' => $this->status,
            'Status_Survey' => $this->Status_Survey,
            'Kd_Prioritas_Pembangunan_Daerah' => $this->Kd_Prioritas_Pembangunan_Daerah,
            'Skor' => $this->Skor,
            'Status_Usulan' => $this->Status_Usulan,
            'Kd_User' => $this->Kd_User,
            'Kd1' => $this->Kd1,
            'Kd2' => $this->Kd2,
            'Kd3' => $this->Kd3,
            'Kd4' => $this->Kd4,
            'Kd5' => $this->Kd5,
            'Kd6' => $this->Kd6,
            'Status_Prioritas' => $this->Status_Prioritas,
        ]);


        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi])
            ->andFilterWhere(['like', 'Latitute', $this->Latitute])
            ->andFilterWhere(['like', 'Longitude', $this->Longitude])
            ->andFilterWhere(['like', 'Rincian_Skor', $this->Rincian_Skor])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kelurahan', $this->Status_Penerimaan_Kelurahan])
            ->andFilterWhere(['like', 'Alasan_Kelurahan', $this->Alasan_Kelurahan])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kecamatan', $this->Status_Penerimaan_Kecamatan])
            ->andFilterWhere(['like', 'Alasan_Kecamatan', $this->Alasan_Kecamatan])
            ->andFilterWhere(['like', 'Status_Penerimaan_Skpd', $this->Status_Penerimaan_Skpd])
            ->andFilterWhere(['like', 'Alasan_Skpd', $this->Alasan_Skpd])
            ->andFilterWhere(['like', 'Status_Penerimaan_Kota', $this->Status_Penerimaan_Kota])
            ->andFilterWhere(['like', 'Alasan_Kota', $this->Alasan_Kota])
            ->andFilterWhere(['like', 'Kd_Asal', $this->Kd_Asal])
            ->andFilterWhere(['like', 'Uraian_Usulan', $this->Uraian_Usulan])
            ->andFilterWhere(['like', 'Kd_Asal_Usulan', $this->Kd_Asal_Usulan]);

        return $dataProvider;
    }
}
