<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaSubUnitJab;

/**
 * TaSubUnitJabSearch represents the model behind the search form about `backend\models\TaSubUnitJab`.
 */
class TaSubUnitJabSearch extends TaSubUnitJab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Jab', 'No_Urut'], 'integer'],
            [['Nama', 'Nip', 'Jabatan'], 'safe'],
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
        $query = TaSubUnitJab::find();

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
            'Kd_Jab' => $this->Kd_Jab,
            'No_Urut' => $this->No_Urut,
        ]);

        $query->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'Nip', $this->Nip])
            ->andFilterWhere(['like', 'Jabatan', $this->Jabatan]);

        return $dataProvider;
    }
}
