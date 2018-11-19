<?php

namespace emusrenbang\models;

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

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'Kd_Pem', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status', 'Status_Survey', 'Kd_Prioritas_Pembangunan_Daerah', 'Status_Usulan', 'Kd_User', 'Kd1', 'Kd2', 'Kd3', 'Kd4', 'Kd5', 'Kd6','Status_Prioritas'], 'integer'],
            [['Tahun', 'Nm_Permasalahan', 'Jenis_Usulan', 'Detail_Lokasi', 'globalSearch', 'Latitute', 'Longitude', 'Rincian_Skor', 'Status_Penerimaan_Kelurahan', 'Alasan_Kelurahan', 'Status_Penerimaan_Kecamatan', 'Alasan_Kecamatan', 'Status_Penerimaan_Skpd', 'Alasan_Skpd', 'Status_Penerimaan_Kota', 'Alasan_Kota', 'Kd_Asal', 'Uraian_Usulan', 'Kd_Asal_Usulan', 'Kd_Jalan'], 'safe'],
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
			 ->andFilterWhere(['like', 'Kd_Sub', $this->Kd_Sub])
            ->andFilterWhere(['like', 'Alasan_Kota', $this->Alasan_Kota])
            ->andFilterWhere(['like', 'Kd_Asal', $this->Kd_Asal])
            ->andFilterWhere(['like', 'Uraian_Usulan', $this->Uraian_Usulan])
            ->andFilterWhere(['like', 'Kd_Asal_Usulan', $this->Kd_Asal_Usulan]);

        return $dataProvider;
    }

    public function Posisi()
    {
        $kelompok = Yii::$app->levelcomponent->getUnit();
        return [
            'Kd_Urusan'=>$kelompok->Kd_Urusan, 
            'Kd_Bidang'=>$kelompok->Kd_Bidang,
            'Kd_Unit'=>$kelompok->Kd_Unit,
            'Kd_Sub'=>$kelompok->Kd_Sub_Unit,
        ];
    }

    public function searchLingkungan($params)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                ->where($this->Posisi())
                ->andWhere(['>', 'Skor', 0])
                ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                ->andWhere(['!=', 'Kd_Lingkungan', 0])
                ->andWhere(['IN', 'Kd_Asal_Usulan', ['1', '2']]);
        }
        else {
            $query = TaMusrenbang::find()
                ->andWhere(['>', 'Skor', 0])
                ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                ->andWhere(['!=', 'Kd_Lingkungan', 0])
                ->andWhere(['IN', 'Kd_Asal_Usulan', ['1', '2']])
                ->andWhere(['Tahun' => $Tahun]);
        }

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
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

    public function searchKelurahan($params)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbangKelurahan::find()
                    ->where($this->Posisi())
                    ->andWhere(['>', 'Skor', 0])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Urut_Kel', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['2', '3']]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        else {
            $query = TaMusrenbang::find()
                    ->andWhere(['>', 'Skor', 0])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['!=', 'Kd_Urut_Kel', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['2', '3']])
                    ->andWhere(['Tahun' => $Tahun]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        

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
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

    public function searchKecamatan($params)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                    ->where($this->Posisi())
                    ->andWhere(['!=', 'Kd_Kec', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['3']])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0]);
                    

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        else {
            $query = TaMusrenbang::find()
                    ->andWhere(['Tahun' => $Tahun])
                    ->andWhere(['!=', 'Kd_Kec', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['3']])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        

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
			 'Status_Penerimaan_Skpd'=> $this->Status_Penerimaan_Skpd,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

    public function searchAll($params)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                    ->where($this->Posisi())
					->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2'],
						//['Status_Penerimaan_Kecamatan' => '3']
						
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                    ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'Skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ])
						->andwhere(["NOT",["Skor"=>NULL]])
					->andwhere(["NOT",["Skor"=>0]]);
						
						
				

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        else {
            $query = TaMusrenbang::find()
                    //->where($this->Posisi())
					->andWhere(['or',
                        ['Status_Penerimaan_Kecamatan' => '1'],
                        ['Status_Penerimaan_Kecamatan' => '2'],
					
						
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                   ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'Skor', 0],
                            ['!=', 'Kd_Kec', 0],
						])
					->andwhere(["NOT",["Skor"=>NULL]])
					->andwhere(["NOT",["Skor"=>0]]);
					
						
						
            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        

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
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }
//Usulan FOrum

 public function searchForum($params)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                    ->where($this->Posisi())
					->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
						
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                   // ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        else {
            $query = TaMusrenbang::find()
                    //->where($this->Posisi())
					->andwhere(['or',
									['Status_Penerimaan_Skpd'=>'1'],
									['Status_Penerimaan_Skpd'=>'2'],
                    ])
                    ->andWhere(['>', 'Kd_Prioritas_Pembangunan_Daerah', 0])
                 //  ->andWhere(['IN', 'Kd_Asal_Usulan', ['1','2','3']])
                    ->andWhere(['OR',
                            ['>', 'skor', 0],
                            ['!=', 'Kd_Kec', 0],
                        ]);

            // add conditions that should always apply here

            $dataProvider = new ActiveDataProvider([
                'query' => $query,
            ]);
        }
        

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
			 'Status_Penerimaan_Kota' => $this->Status_Penerimaan_Kota, 
		
        ]);
		

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }



//----------------------------------------------------------------------//
    public function searchPokir($params,$dapil=NULL,$user_dapil=NULL)
    {
        $Tahun = date('Y');

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaMusrenbang::find()
                ->where($this->Posisi())
                ->andWhere(['Kd_Asal_Usulan' => '5']);
        }
        else {
            $query = TaMusrenbang::find()
                ->andWhere(['Kd_Asal_Usulan' => '5'])
                ->andWhere(['Tahun' => $Tahun]);
            if (isset($dapil)) $query = $query->andWhere(['Kd_Dapil' => $dapil]);
            if (isset($user_dapil)) $query = $query->andWhere(['Kd_User_Dapil' => $user_dapil]);
        }
        

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
            'Kd_Dapil' => $this->Kd_Dapil,
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
			'Status_Penerimaan_Kota' => $this->Status_Penerimaan_Kota, 
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

    public function searchUsulanLingkungan($params)
    {
        $query = TaMusrenbang::find()
                ->where(['Kd_Asal_Usulan' => '1']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
            [
                'pageSize' => 10
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'Tahun' => $this->Tahun,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Dapil' => $this->Kd_Dapil,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

    public function searchUsulanKelurahan($params)
    {
        $query = TaMusrenbang::find()
                ->where(['or',
                    ['Kd_Asal_Usulan' => '1'],
                    ['Kd_Asal_Usulan' => '2']
                ])
                ->andwhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ]);

        $query->joinWith('kdJalan');
        $query->joinWith('kecamatan');
        $query->joinWith('kelurahan');
        $query->joinWith('lingkungan');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
             [
              'pageSize' => 20
             ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->globalSearch])
            ->orFilterWhere(['like', 'Jenis_Usulan', $this->globalSearch])
            ->orFilterWhere(['like', 'Detail_Lokasi', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Jalan', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Kec', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Kel', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Lingkungan', $this->globalSearch]);

        return $dataProvider;
    }

    public function searchUsulanKecamatan($params)
    {

        $query = TaMusrenbang::find()
                ->where(['or',
                    ['Kd_Asal_Usulan' => 1],
                    ['Kd_Asal_Usulan' => 2],
                    ['Kd_Asal_Usulan' => 3]
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kecamatan' => '1'],
                    ['Status_Penerimaan_Kecamatan' => '2']
                ]);

        $query->joinWith('kdJalan');
        $query->joinWith('kecamatan');
        $query->joinWith('kelurahan');
        $query->joinWith('lingkungan');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
             [
              'pageSize' => 20
             ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->globalSearch])
            ->orFilterWhere(['like', 'Jenis_Usulan', $this->globalSearch])
            ->orFilterWhere(['like', 'Detail_Lokasi', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Jalan', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Kec', $this->globalSearch])
            ->orFilterWhere(['like', 'Nm_Kel', $this->globalSearch])
			->orFilterWhere(['like', 'Status_Penerimaan_Skpd', $this->Status_Penerimaan_Skpd])
            ->orFilterWhere(['like', 'Nm_Lingkungan', $this->globalSearch]);
			

        return $dataProvider;
    }

    public function searchUsulanSemuaTerima($params)
    {
        $query = TaMusrenbang::find()
                ->where(['or',
                    ['Kd_Asal_Usulan' => '1'],
                    ['Kd_Asal_Usulan' => '2'],
                    ['Kd_Asal_Usulan' => '3']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kelurahan' => '1'],
                    ['Status_Penerimaan_Kelurahan' => '2']
                ])
                ->andWhere(['or',
                    ['Status_Penerimaan_Kecamatan' => '1'],
                    ['Status_Penerimaan_Kecamatan' => '2']
                ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
             [
              'pageSize' => 20
             ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'Tahun' => $this->Tahun,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Dapil' => $this->Kd_Dapil,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
			'Status_Penerimaan_Skpd'=>$this->Status_Penerimaan_Skpd,

        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan])
            ->andFilterWhere(['like', 'Detail_Lokasi', $this->Detail_Lokasi]);

        return $dataProvider;
    }

}
