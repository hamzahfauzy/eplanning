<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaSubUnit;

/**
 * TaSubUnitSearch represents the model behind the search form about `backend\models\TaSubUnit`.
 */
class TaSubUnitSearch extends TaSubUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['Nm_Pimpinan', 'Nip_Pimpinan', 'Jbt_Pimpinan', 'Alamat', 'Ur_Visi'], 'safe'],
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
        $query = TaSubUnit::find();

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Pimpinan', $this->Nm_Pimpinan])
            ->andFilterWhere(['like', 'Nip_Pimpinan', $this->Nip_Pimpinan])
            ->andFilterWhere(['like', 'Jbt_Pimpinan', $this->Jbt_Pimpinan])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Ur_Visi', $this->Ur_Visi]);

        return $dataProvider;
    }
}
