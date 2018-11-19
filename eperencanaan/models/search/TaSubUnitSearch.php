<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaSubUnit;

/**
 * TaSubUnitSearch represents the model behind the search form of `common\models\TaSubUnit`.
 */
class TaSubUnitSearch extends TaSubUnit
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
            [['Tahun', 'Nm_Pimpinan', 'Nip_Pimpinan', 'Jbt_Pimpinan', 'Alamat', 'Ur_Visi'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
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
        $query = TaSubUnit::find()->where(['Tahun'=>2017, 'Kd_Urusan'=>$Unit, 'Kd_Bidang'=>$Unit,
                                        'Kd_Unit'=>$Unit, 'Kd_Sub'=>$Unit]);;

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Pimpinan', $this->Nm_Pimpinan])
            ->andFilterWhere(['like', 'Nip_Pimpinan', $this->Nip_Pimpinan])
            ->andFilterWhere(['like', 'Jbt_Pimpinan', $this->Jbt_Pimpinan])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Ur_Visi', $this->Ur_Visi]);

        return $dataProvider;
    }
}
