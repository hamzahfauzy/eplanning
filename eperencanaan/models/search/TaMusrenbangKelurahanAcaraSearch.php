<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaMusrenbangKelurahanAcara;

/**
 * TaMusrenbangKelurahanAcaraSearch represents the model behind the search form of `eperencanaan\models\TaMusrenbangKelurahanAcara`.
 */
class TaMusrenbangKelurahanAcaraSearch extends TaMusrenbangKelurahanAcara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nama_Tempat', 'Alamat', 'Nama_Pejabat'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta'], 'integer'],
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
        $query = TaMusrenbangKelurahanAcara::find();

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
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Waktu_Unduh_Absen' => $this->Waktu_Unduh_Absen,
            'Waktu_Unduh_Berita_Acara' => $this->Waktu_Unduh_Berita_Acara,
            'Waktu_Mulai' => $this->Waktu_Mulai,
            'Waktu_Selesai' => $this->Waktu_Selesai,
            'Jumlah_Peserta' => $this->Jumlah_Peserta,
        ]);

        $query->andFilterWhere(['like', 'Nama_Tempat', $this->Nama_Tempat])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Nama_Pejabat', $this->Nama_Pejabat]);

        return $dataProvider;
    }
}
