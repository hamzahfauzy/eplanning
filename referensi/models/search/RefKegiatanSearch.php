<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKegiatan;

/**
 * RefKegiatanSearch represents the model behind the search form about `common\models\RefKegiatan`.
 */
class RefKegiatanSearch extends RefKegiatan
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
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'integer'],
            [['Ket_Kegiatan'], 'safe'],
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
        $query = RefKegiatan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan]);

        return $dataProvider;
    }


    public function searchKegiatan($id,$params)
    {
        $query =RefKegiatan::find();

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


        // $identity=Yii::$app->user->identity;
        $user = Yii::$app->levelcomponent->getUnit();

        $cookies = Yii::$app->request->cookies;

        if(!empty($cookies['skpd'])){
            $this->Kd_Urusan = $cookies['urusan']->value;
            $this->Kd_Bidang = $cookies['bidang']->value;
            $this->Kd_Unit   = $cookies['skpd']->value;
            $kdSub= $cookies['subUnit']->value;
        }else{
            $this->Kd_Urusan = $user->Kd_Urusan;
            $this->Kd_Bidang = $user->Kd_Bidang;
            $this->Kd_Unit   = $user->Kd_Unit;
            $kdSub= $user->Kd_Sub_Unit;
        }


        // if($kdSub!=0){
        //     $this->Kd_Sub=$kdSub;
        // }else{
        //     $this->Kd_Sub=$this->Kd_Unit;
        // }


        if($kdSub!=0){
            $this->Kd_Sub=$kdSub;
        }else{
            $this->Kd_Sub=$this->Kd_Unit;
        }


        // grid filtering conditions
        $query->andFilterWhere([
            'ks.Kd_Urusan' => $this->Kd_Urusan,
            'ks.Kd_Bidang' => $this->Kd_Bidang,
            'ks.Kd_Unit' => $this->Kd_Unit,
            'ks.Kd_Sub' => $this->Kd_Sub,
            'ks.Kd_Program' => $id
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan]);

        return $dataProvider;
    }

}
