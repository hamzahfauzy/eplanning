<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaProgram;
use common\models\RefSubUnit;

/**
 * TaProgramSearch represents the model behind the search form of `eperencanaan\models\TaProgram`.
 */
class TaProgramSearch extends TaProgram
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
            [['Tahun', 'Ket_Prog', 'Tolak_Ukur', 'Target_Uraian'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Urusan1', 'Kd_Bidang1'], 'integer'],
            [['Target_Angka'], 'number'],
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
        $query = TaProgram::find();

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
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Target_Angka' => $this->Target_Angka,
            'Kd_Urusan1' => $this->Kd_Urusan1,
            'Kd_Bidang1' => $this->Kd_Bidang1,
        ]);

        $query->andFilterWhere(['like', 'Ket_Prog', $this->Ket_Prog])
            ->andFilterWhere(['like', 'Tolak_Ukur', $this->Tolak_Ukur])
            ->andFilterWhere(['like', 'Target_Uraian', $this->Target_Uraian]);

        return $dataProvider;
    }

    public function searchProgram($params)
    {   

        $NASSkpdModel = $this->NASarraymap(Yii::$app->levelcomponent->getUnit());
        $Unit = $this->Unit();

        $query = TaProgram::find()->where(['Kd_Urusan'=>$Unit, 'Kd_Bidang'=>$Unit]);

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

        $query->andFilterWhere(['like', 'Ket_Prog', $this->Ket_Prog]);

        return $dataProvider;
    }

    public function searchProgram2($params)
    {

        $unit = Yii::$app->levelcomponent->getUnit();
        $PosisiUnit = Yii::$app->levelcomponent->PosisiUnit();

        $query = TaProgram::find()->where($PosisiUnit);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // $query->andFilterWhere([
        //     'Kd_Urusan1' => $this->Kd_Urusan,
        //     'Kd_Bidang1' => $this->Kd_Bidang,
        //     'Kd_Prog' => $this->Kd_Prog,
        // ]);

        $query->andFilterWhere(['like', 'Ket_Prog', $this->Ket_Prog]);

        return $dataProvider;
    }

    public function searchPraRka($params, $skpd=null)
    {

        if (Yii::$app->levelcomponent->isRoles('Operator_Skpd')) {
            $query = TaProgram::find()
                ->where($this->Unit())
                ->orderBy([
                    'Kd_Urusan' => SORT_ASC,
                    'Kd_Bidang' => SORT_ASC,
                    'Kd_Unit' => SORT_ASC,
                    'Kd_Prog' => SORT_ASC
                ]);
        }
        else {
            $query = TaProgram::find();
            if (isset($skpd))
                $query = $query->where($skpd);

            $query = $query->orderBy([
                    'Kd_Urusan' => SORT_ASC,
                    'Kd_Bidang' => SORT_ASC,
                    'Kd_Unit' => SORT_ASC,
                    'Kd_Prog' => SORT_ASC
                ]);
        }

        // add conditions that should always apply here

        $dataProviderPraRka = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProviderPraRka;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Prog' => $this->Kd_Prog,
        ]);

        $query->andFilterWhere(['like', 'Ket_Prog', $this->Ket_Prog,]);

        return $dataProviderPraRka;
    }
}
