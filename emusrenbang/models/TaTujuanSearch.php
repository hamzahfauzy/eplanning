<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\TaTujuan;

/**
 * TaTujuanSearch represents the model behind the search form about `app\models\TaTujuan`.
 */
class TaTujuanSearch extends TaTujuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Ur_Tujuan','urMisi'], 'safe'],
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
        $query = TaTujuan::find();
        $query->select(['Ta_Tujuan.*',
            'tm.Tahun tm_Tahun',
            'tm.Ur_Misi urMisi'
        ]);
        $query->innerJoin('Ta_Misi tm', '
            tm.Kd_Urusan=Ta_Tujuan.Kd_Urusan and
            tm.Kd_Bidang=Ta_Tujuan.Kd_Bidang and
            tm.Kd_Unit=Ta_Tujuan.Kd_Unit and
            tm.Kd_Sub=Ta_Tujuan.Kd_Sub and
            tm.No_Misi=Ta_Tujuan.No_Misi and
            tm.Tahun=Ta_Tujuan.Tahun
            ')
        ;

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

        if(Yii::$app->user->identity->id_level!==1){
            $identity=Yii::$app->user->identity;
            $this->Kd_Urusan=$identity->id_urusan;
            $this->Kd_Bidang=$identity->id_bidang;
            $this->Kd_Unit=$identity->id_skpd;
            $this->Kd_Sub=$identity->id_subunit;
        }
        if(!isset($this->Tahun) or $this->Tahun==''){
            $this->Tahun= ( date('Y') + 1 );
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Ta_Tujuan.Tahun' => $this->Tahun,
            'Ta_Tujuan.Kd_Urusan' => $this->Kd_Urusan,
            'Ta_Tujuan.Kd_Bidang' => $this->Kd_Bidang,
            'Ta_Tujuan.Kd_Unit' => $this->Kd_Unit,
            'Ta_Tujuan.Kd_Sub' => $this->Kd_Sub,
            'Ta_Tujuan.No_Misi' => $this->No_Misi,
            'No_Tujuan' => $this->No_Tujuan,
        ]);

        $query->andFilterWhere(['like', 'Ur_Tujuan', $this->Ur_Tujuan])
            ->andFilterWhere( ['like', 'tm.Ur_Misi', $this->urMisi] )
        ;


        return $dataProvider;
    }
}
