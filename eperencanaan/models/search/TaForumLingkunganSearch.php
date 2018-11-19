<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaForumLingkungan;

/**
 * TaForumLingkunganSearch represents the model behind the search form of `eperencanaan\models\TaForumLingkungan`.
 */
class TaForumLingkunganSearch extends TaForumLingkungan
{
    /**
     * @inheritdoc
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['Tahun', 'Nm_Permasalahan', 'Jenis_Usulan', 'globalSearch'], 'safe'],
            [['Kd_Ta_Forum_Lingkungan', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi', 'Jumlah', 'Kd_Satuan', 'Kd_Sasaran', 'Tanggal', 'status'], 'integer'],
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
        $query = TaForumLingkungan::find();

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
            'Kd_Ta_Forum_Lingkungan' => $this->Kd_Ta_Forum_Lingkungan,
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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan]);

        return $dataProvider;
    }

    public function searchLihatUsulan($params)
    {
        $query = TaForumLingkungan::find();

        $query->joinWith('kdJalan');
        $query->joinWith('kdKec');
        $query->joinWith('kdKel');
        $query->joinWith('kdLink');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' =>
            [
                'pageSize' => 10
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
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

    public function searchUsulanSemuaTolak($params)
    {

        $query = TaForumLingkungan::find()
                ->select('Ta_Forum_Lingkungan.*')
                ->innerJoin('Ta_Musrenbang', ['or',
                    'Ta_Forum_Lingkungan.Kd_Prov        = Ta_Musrenbang.Kd_Prov',
                    'Ta_Forum_Lingkungan.Kd_Kab         = Ta_Musrenbang.Kd_Kab',
                    'Ta_Forum_Lingkungan.Kd_Kec         = Ta_Musrenbang.Kd_Kec',
                    'Ta_Forum_Lingkungan.Kd_Kel         = Ta_Musrenbang.Kd_Kel',
                    'Ta_Forum_Lingkungan.Kd_Urut_Kel    = Ta_Musrenbang.Kd_Urut_Kel',
                    'Ta_Forum_Lingkungan.Kd_Lingkungan  = Ta_Musrenbang.Kd_Lingkungan'
                ])
                ->where(['IS', 'Ta_Musrenbang.id', NULL]);

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
            'Kd_Ta_Forum_Lingkungan' => $this->Kd_Ta_Forum_Lingkungan,
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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Jenis_Usulan', $this->Jenis_Usulan]);

        return $dataProvider;
    }
}
