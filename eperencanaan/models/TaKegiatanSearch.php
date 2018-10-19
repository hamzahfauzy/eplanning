<?php

namespace eperencanaan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaKegiatan;

/**
 * TaKegiatanSearch represents the model behind the search form of `eperencanaan\models\TaKegiatan`.
 */
class TaKegiatanSearch extends TaKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Ket_Kegiatan', 'Lokasi', 'Kelompok_Sasaran', 'Status_Kegiatan', 'Waktu_Pelaksanaan', 'Keterangan'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status'], 'integer'],
            [['Pagu_Anggaran'], 'number'],
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
        $query = TaKegiatan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'ID_Prog' => $this->ID_Prog,
            'Pagu_Anggaran' => $this->Pagu_Anggaran,
            'Kd_Sumber' => $this->Kd_Sumber,
            'Status' => $this->Status,
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan])
            ->andFilterWhere(['like', 'Lokasi', $this->Lokasi])
            ->andFilterWhere(['like', 'Kelompok_Sasaran', $this->Kelompok_Sasaran])
            ->andFilterWhere(['like', 'Status_Kegiatan', $this->Status_Kegiatan])
            ->andFilterWhere(['like', 'Waktu_Pelaksanaan', $this->Waktu_Pelaksanaan])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
