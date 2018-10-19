<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaSasaran;

/**
 * TaSasaranSearch represents the model behind the search form about `app\models\TaSasaran`.
 */
class TaSasaranSearch extends TaSasaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
            [['Ur_Sasaran','urMisi','urTujuan'], 'safe'],
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
        $query = TaSasaran::find();
        $query->select(['Ta_Sasaran.*',
            'tm.Tahun tm_Tahun',
            'tm.Ur_Misi urMisi',
            'tt.Tahun tt_Tahun',
            'tt.Ur_Tujuan urTujuan'
        ]);
        $query->innerJoin('Ta_Misi tm', '
            tm.Kd_Urusan=Ta_Sasaran.Kd_Urusan and
            tm.Kd_Bidang=Ta_Sasaran.Kd_Bidang and
            tm.Kd_Unit=Ta_Sasaran.Kd_Unit and
            tm.Kd_Sub=Ta_Sasaran.Kd_Sub and
            tm.No_Misi=Ta_Sasaran.No_Misi and
            tm.Tahun=Ta_Sasaran.Tahun
            ')
            ->innerJoin('Ta_Tujuan tt', '
            tt.Kd_Urusan=Ta_Sasaran.Kd_Urusan and
            tt.Kd_Bidang=Ta_Sasaran.Kd_Bidang and
            tt.Kd_Unit=Ta_Sasaran.Kd_Unit and
            tt.Kd_Sub=Ta_Sasaran.Kd_Sub and
            tt.No_Misi=Ta_Sasaran.No_Misi and
            tt.No_Tujuan=Ta_Sasaran.No_Tujuan and
            tt.Tahun=Ta_Sasaran.Tahun
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
            'Ta_Sasaran.Tahun' => $this->Tahun,
            'Ta_Sasaran.Kd_Urusan' => $this->Kd_Urusan,
            'Ta_Sasaran.Kd_Bidang' => $this->Kd_Bidang,
            'Ta_Sasaran.Kd_Unit' => $this->Kd_Unit,
            'Ta_Sasaran.Kd_Sub' => $this->Kd_Sub,
            // 'No_Misi' => $this->No_Misi,
            // 'No_Tujuan' => $this->No_Tujuan,
            // 'No_Sasaran' => $this->No_Sasaran,
        ]);

        $query->andFilterWhere(['like', 'Ur_Sasaran', $this->Ur_Sasaran])
            ->andFilterWhere(['like', 'tm.Ur_Misi', $this->urMisi])
            ->andFilterWhere(['like', 'tt.Ur_Tujuan', $this->urTujuan])
        ;

        return $dataProvider;
    }
}
