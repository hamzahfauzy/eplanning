<?php

namespace emonev\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emonev\models\TaKegiatanApbn;

/**
 * TaKegiatanApbnSearch represents the model behind the search form of `emusrenbang\models\TaKegiatanApbn`.
 */
class TaKegiatanApbnSearch extends TaKegiatanApbn
{
    /**
     * @inheritdoc
     */

    public function NASarraymap($data) {
        $NASarray = [
            'Kd_Urusan' => $data['Kd_Urusan'],
            'Kd_Bidang' => $data['Kd_Bidang'],
            'Kd_Unit' => $data['Kd_Unit'],
            'Kd_Sub' => $data['Kd_Sub_Unit']
                //'Kd_Lingkungan' => $data['Kd_Lingkungan'],
        ];

        return $NASarray;
    }

    public function Unit() {
        $unitskpd = Yii::$app->levelcomponent->getUnit();
        $unit = [
            'Kd_Urusan' => $unitskpd['Kd_Urusan'],
            'Kd_Bidang' => $unitskpd['Kd_Bidang'],
            'Kd_Unit' => $unitskpd['Kd_Unit'],
            'Kd_Sub' => $unitskpd['Kd_Sub_Unit'],
        ];
        return $unit;
    }

    public function rules()
    {
        return [
            [['Tahun', 'Ket_Kegiatan', 'Lokasi', 'Kelompok_Sasaran', 'Status_Kegiatan', 'Waktu_Pelaksanaan', 'Keterangan', 'Keterangan_Verifikasi_Bappeda'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Unit', 'Kd_Sub', 'ID_Prog', 'Kd_Sumber', 'Status', 'Verifikasi_Bappeda', 'Tanggal_Verifikasi_Bappeda', 'Kd_Urusan_Prov', 'Kd_Bidang_Prov', 'Kd_Unit_Prov', 'Kd_Sub_Prov'], 'integer'],
            [['Pagu_Anggaran', 'Pagu_Anggaran_Nt1'], 'number'],
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
        $query = TaKegiatanApbn::find();

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
            'Pagu_Anggaran_Nt1' => $this->Pagu_Anggaran_Nt1,
            'Verifikasi_Bappeda' => $this->Verifikasi_Bappeda,
            'Tanggal_Verifikasi_Bappeda' => $this->Tanggal_Verifikasi_Bappeda,
            'Kd_Urusan_Prov' => $this->Kd_Urusan_Prov,
            'Kd_Bidang_Prov' => $this->Kd_Bidang_Prov,
            'Kd_Unit_Prov' => $this->Kd_Unit_Prov,
            'Kd_Sub_Prov' => $this->Kd_Sub_Prov,
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan])
            ->andFilterWhere(['like', 'Lokasi', $this->Lokasi])
            ->andFilterWhere(['like', 'Kelompok_Sasaran', $this->Kelompok_Sasaran])
            ->andFilterWhere(['like', 'Status_Kegiatan', $this->Status_Kegiatan])
            ->andFilterWhere(['like', 'Waktu_Pelaksanaan', $this->Waktu_Pelaksanaan])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan])
            ->andFilterWhere(['like', 'Keterangan_Verifikasi_Bappeda', $this->Keterangan_Verifikasi_Bappeda]);

        return $dataProvider;
    }

      public function searchKegiatan($PosisiKegiatan)
    {

        $query =TaKegiatanApbn::find()->where($PosisiKegiatan);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
        ]);
        return $dataProvider;
    }

    public function searchKegiatan2($id,$params)
    {
        $user = Yii::$app->levelcomponent->getUnit();
        $urusan = $user->Kd_Urusan;
        $bidang = $user->Kd_Bidang;

        $query =TaKegiatanApbn::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $query->andFilterWhere([
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Prog' => $id
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan]);

        return $dataProvider;
    }
}
