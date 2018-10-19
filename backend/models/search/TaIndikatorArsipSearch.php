<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaIndikatorArsip;

/**
 * TaIndikatorArsipSearch represents the model behind the search form about `backend\models\TaIndikatorArsip`.
 */
class TaIndikatorArsipSearch extends TaIndikatorArsip
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Perubahan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Indikator', 'No_ID'], 'integer'],
            [['Tolak_Ukur', 'Target_Uraian', 'DateCreate'], 'safe'],
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
        $query = TaIndikatorArsip::find();

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
            'Kd_Perubahan' => $this->Kd_Perubahan,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Indikator' => $this->Kd_Indikator,
            'No_ID' => $this->No_ID,
            'Target_Angka' => $this->Target_Angka,
            'DateCreate' => $this->DateCreate,
        ]);

        $query->andFilterWhere(['like', 'Tolak_Ukur', $this->Tolak_Ukur])
            ->andFilterWhere(['like', 'Target_Uraian', $this->Target_Uraian]);

        return $dataProvider;
    }
}
