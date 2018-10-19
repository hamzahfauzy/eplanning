<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaMisi;

/**
 * TaMisiSearch represents the model behind the search form about `common\models\TaMisi`.
 */
class TaMisiSearch extends TaMisi
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


    public function Kd_User() {
        $user = Yii::$app->user->identity->id;
        return $user;
    }


    public function rules()
    {
        return [
            [['Tahun', 'Ur_Misi'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Misi'], 'integer'],
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

        $NASSkpdModel = $this->NASarraymap(Yii::$app->levelcomponent->getUnit());
        $Unit = $this->Unit();
        // $Jlh_Misi = TaMisi::find()->where($Unit)->count();
        $query = TaMisi::find()->where(['Tahun'=>2017, 'Kd_Urusan'=>$Unit, 'Kd_Bidang'=>$Unit,
                                        'Kd_Unit'=>$Unit, 'Kd_Sub'=>$Unit]);
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
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'No_Misi' => $this->No_Misi,
        ]);

        $query->andFilterWhere(['like', 'Ur_Misi', $this->Ur_Misi]);

        return $dataProvider;
    }
}
