<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaKegiatan;

/**
 * TaKegiatanSearch represents the model behind the search form of `eperencanaan\models\TaKegiatan`.
 */
class TaKegiatanSearch extends TaKegiatan
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

    // public function searchKegiatan($id,$params)
    // {
    //     $user = Yii::$app->levelcomponent->getUnit();
    //     $urusan = $user->Kd_Urusan;
    //     $bidang = $user->Kd_Bidang;

    //     $query =TaKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id]);

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //         'sort'  => false
    //     ]);

    //     $this->load($params);

    //     if (!$this->validate()) {
    //         // uncomment the following line if you do not want to return any records when validation fails
    //         // $query->where('0=1');
    //         return $dataProvider;
    //     }


    //     // $identity=Yii::$app->user->identity;

    //     $cookies = Yii::$app->request->cookies;

    //     if(!empty($cookies['skpd'])){
    //         $this->Kd_Urusan = $cookies['urusan']->value;
    //         $this->Kd_Bidang = $cookies['bidang']->value;
    //         // $this->Kd_Unit   = $cookies['skpd']->value;
    //         // $kdSub= $cookies['subUnit']->value;
    //     }else{
    //         $this->Kd_Urusan = $user->Kd_Urusan;
    //         $this->Kd_Bidang = $user->Kd_Bidang;
    //         // $this->Kd_Unit   = $user->Kd_Unit;
    //         // $kdSub = $user->Kd_Sub_Unit;
    //     }


    //     // if($kdSub!=0){
    //     //     $this->Kd_Sub=$kdSub;
    //     // }else{
    //     //     $this->Kd_Sub=$this->Kd_Unit;
    //     // }


    //     // grid filtering conditions
    //     $query->andFilterWhere([
    //         'Kd_Urusan' => $this->Kd_Urusan,
    //         'Kd_Bidang' => $this->Kd_Bidang,
    //         // 'Kd_Unit' => $this->Kd_Unit,
    //         // 'ks.Kd_Sub' => $this->Kd_Sub,
    //         // 'ks.Kd_Program' => $id
    //     ]);

    //     $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan]);

    //     return $dataProvider;
    // }

    public function searchKegiatan($PosisiKegiatan)
    {

        $query =TaKegiatan::find()->where($PosisiKegiatan);

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

        $query =TaKegiatan::find()->where(['Kd_Urusan'=>$urusan, 'Kd_Bidang'=>$bidang, 'Kd_Prog'=>$id]);

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
