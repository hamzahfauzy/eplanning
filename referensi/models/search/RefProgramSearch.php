<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefProgram;

/**
 * RefProgramSearch represents the model behind the search form about `common\models\RefProgram`.
 */
class RefProgramSearch extends RefProgram
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
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog'], 'integer'],
            [['Ket_Program'], 'safe'],
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
    // ----- DEFAULT ------ //
    // public function search($params)
    // {
    //     $query = RefProgram::find();

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //     ]);

    //     $this->load($params);

    //     if (!$this->validate()) {
    //         // uncomment the following line if you do not want to return any records when validation fails
    //         // $query->where('0=1');
    //         return $dataProvider;
    //     }

    //     $query->andFilterWhere([
    //         'Kd_Urusan' => $this->Kd_Urusan,
    //         'Kd_Bidang' => $this->Kd_Bidang,
    //         'Kd_Prog' => $this->Kd_Prog,
    //     ]);

    //     $query->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program]);

    //     return $dataProvider;
    // }

    //----- DEFAULT --- //

    public function search($params)
    {   

        $NASSkpdModel = $this->NASarraymap(Yii::$app->levelcomponent->getUnit());
        $Unit = $this->Unit();

        $query = RefProgram::find()->where(['Kd_Urusan'=>$Unit, 'Kd_Bidang'=>$Unit]);

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
        ]);

        $query->andFilterWhere(['like', 'Ket_Program', $this->Ket_Program]);

        return $dataProvider;
    }
}
