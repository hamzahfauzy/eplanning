<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaDASK;

/**
 * TaDASKSearch represents the model behind the search form about `backend\models\TaDASK`.
 */
class TaDASKSearch extends TaDASK
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['No_DPA', 'Tgl_DPA', 'No_DPPA', 'Tgl_DPPA'], 'safe'],
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
        $query = TaDASK::find();

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
            'Tgl_DPA' => $this->Tgl_DPA,
            'Tgl_DPPA' => $this->Tgl_DPPA,
        ]);

        $query->andFilterWhere(['like', 'No_DPA', $this->No_DPA])
            ->andFilterWhere(['like', 'No_DPPA', $this->No_DPPA]);

        return $dataProvider;
    }
}
