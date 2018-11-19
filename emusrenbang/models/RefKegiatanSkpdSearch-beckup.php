<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKegiatan;
use common\models\RefProgram;
use common\models\RefUnit;

/**
 * RefKegiatanSearch represents the model behind the search form about `app\models\RefKegiatan`.
 */
class RefKegiatanSkpdSearch extends RefKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg'], 'integer'],
            [['Ket_Kegiatan', 'Ket_Program', 'Nm_Urusan', 'Nm_Bidang','Nm_Unit'], 'safe'],
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

    public $Nm_Unit;
    public $Kd_Sub;
    public function search($params)
    {
        $query = RefKegiatan::find();

        $query->select(['Ref_Kegiatan.*', 'Ref_Urusan.Nm_Urusan', 'Ref_Bidang.Nm_Bidang', 'Ref_Program.Ket_Program']);
        $query->leftJoin('Ref_Urusan', 'Ref_Urusan.Kd_Urusan=Ref_Kegiatan.Kd_Urusan')
            ->leftJoin('Ref_Bidang', 'Ref_Bidang.Kd_Urusan=Ref_Kegiatan.Kd_Urusan
            	and Ref_Bidang.Kd_Bidang=Ref_Kegiatan.Kd_Bidang')
            ->leftJoin('Ref_Program', 'Ref_Program.Kd_Urusan=Ref_Kegiatan.Kd_Urusan
            	and Ref_Program.Kd_Bidang=Ref_Kegiatan.Kd_Bidang and Ref_Program.Kd_Prog=Ref_Kegiatan.Kd_Prog');

        // add conditions that should always apply here

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


        $identity=Yii::$app->user->identity;
        if($identity){
            $this->Kd_Urusan=$identity->id_urusan;
            $this->Kd_Bidang=$identity->id_bidang;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Ref_Kegiatan.Kd_Urusan' => $this->Kd_Urusan,
            'Ref_Kegiatan.Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
        ]);

        $query->andFilterWhere(['like', 'Ket_Kegiatan', $this->Ket_Kegiatan])
            ->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan])
            ->andFilterWhere(['like', 'Nm_Bidang', $this->Nm_Bidang])
            ->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program]);

        return $dataProvider;
    }

    public function searchProgram($params)
    {

        $query = RefProgram::find()->leftJoin('Ref_Kamus_Program kp', 'kp.Kd_Program=Ref_Program.Kd_Prog')->where(['status'=>2]);


        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
        	$this->Kd_Urusan=$cookies['urusan']->value;
        	$this->Kd_Bidang=$cookies['bidang']->value;
        }else{
        	$identity=Yii::$app->user->identity;
        	if($identity){
            	$this->Kd_Urusan=$identity->id_urusan;
            	$this->Kd_Bidang=$identity->id_bidang;
        	}
        }

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

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang
        ]);

        $query->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program]);

        return $dataProvider;
    }

    public function searchProgramAdmin($urusan,$bidang,$params)
    {
        $query = RefProgram::find();

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

        $this->Kd_Urusan=$urusan;
        $this->Kd_Bidang=$bidang;

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang
        ]);

        $query->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program]);

        return $dataProvider;
    }


    public function searchKegiatan($id,$params)
    {
        $query =RefKegiatan::find()
        ->innerJoin('kegiatan_skpd ks', '
            Ref_Kegiatan.Kd_Urusan=ks.Kd_Urusan and
            Ref_Kegiatan.Kd_Bidang=ks.Kd_Bidang and
            Ref_Kegiatan.Kd_Prog=ks.Kd_Program and
            Ref_Kegiatan.Kd_Keg=ks.Kd_Kegiatan
        ')
        ->groupBy(['ks.Kd_Program','ks.Kd_Kegiatan'])
        ->orderBy(['Ref_Kegiatan.Kd_Keg'=>SORT_ASC])
        ;

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


        $identity=Yii::$app->user->identity;
        $cookies = Yii::$app->request->cookies;
        if(!empty($cookies['skpd'])){
        	$this->Kd_Urusan = $cookies['urusan']->value;
            $this->Kd_Bidang = $cookies['bidang']->value;
            $this->Kd_Unit   = $cookies['skpd']->value;
            $kdSub= $cookies['subUnit']->value;
        }else{
            $this->Kd_Urusan = $identity->id_urusan;
            $this->Kd_Bidang = $identity->id_bidang;
            $this->Kd_Unit   = $identity->id_skpd;
            $kdSub    = $identity->id_subunit;
        }


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

    public function searchUnit($params)
    {

        $query = RefUnit::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'Nm_Unit', $this->Nm_Unit]);

        return $dataProvider;
    }
}