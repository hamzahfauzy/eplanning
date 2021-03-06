<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaPembiayaanRinc;

/**
 * TaPembiayaanRincSearch represents the model behind the search form about `backend\models\TaPembiayaanRinc`.
 */
class TaPembiayaanRincSearch extends TaPembiayaanRinc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_ID'], 'integer'],
            [['Sat_1', 'Sat_2', 'Sat_3', 'Satuan123', 'Keterangan'], 'safe'],
            [['Nilai_1', 'Nilai_2', 'Nilai_3', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'number'],
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
        $query = TaPembiayaanRinc::find();

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
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Rek_1' => $this->Kd_Rek_1,
            'Kd_Rek_2' => $this->Kd_Rek_2,
            'Kd_Rek_3' => $this->Kd_Rek_3,
            'Kd_Rek_4' => $this->Kd_Rek_4,
            'Kd_Rek_5' => $this->Kd_Rek_5,
            'No_ID' => $this->No_ID,
            'Nilai_1' => $this->Nilai_1,
            'Nilai_2' => $this->Nilai_2,
            'Nilai_3' => $this->Nilai_3,
            'Jml_Satuan' => $this->Jml_Satuan,
            'Nilai_Rp' => $this->Nilai_Rp,
            'Total' => $this->Total,
        ]);

        $query->andFilterWhere(['like', 'Sat_1', $this->Sat_1])
            ->andFilterWhere(['like', 'Sat_2', $this->Sat_2])
            ->andFilterWhere(['like', 'Sat_3', $this->Sat_3])
            ->andFilterWhere(['like', 'Satuan123', $this->Satuan123])
            ->andFilterWhere(['like', 'Keterangan', $this->Keterangan]);

        return $dataProvider;
    }
}
