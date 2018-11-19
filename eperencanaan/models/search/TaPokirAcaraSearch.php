<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaPokirAcara;

/**
 * TaPokirAcaraSearch represents the model behind the search form of `eperencanaan\models\TaPokirAcara`.
 */
class TaPokirAcaraSearch extends TaPokirAcara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Masa_Reses', 'Nama_Tempat', 'Nama_Tempat2', 'Nama_Tempat3', 'Alamat'], 'safe'],
            [['Kd_User', 'Waktu_Unduh_Absen', 'Waktu_Unduh_Berita_Acara', 'Waktu_Mulai', 'Waktu_Selesai', 'Jumlah_Peserta'], 'integer'],
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
        $query = TaPokirAcara::find();

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
            'Kd_User' => $this->Kd_User,
            'Waktu_Unduh_Absen' => $this->Waktu_Unduh_Absen,
            'Waktu_Unduh_Berita_Acara' => $this->Waktu_Unduh_Berita_Acara,
            'Waktu_Mulai' => $this->Waktu_Mulai,
            'Waktu_Selesai' => $this->Waktu_Selesai,
            'Jumlah_Peserta' => $this->Jumlah_Peserta,
        ]);

        $query->andFilterWhere(['like', 'Masa_Reses', $this->Masa_Reses])
            ->andFilterWhere(['like', 'Nama_Tempat', $this->Nama_Tempat])
            ->andFilterWhere(['like', 'Nama_Tempat2', $this->Nama_Tempat2])
            ->andFilterWhere(['like', 'Nama_Tempat3', $this->Nama_Tempat3])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat]);

        return $dataProvider;
    }
}
