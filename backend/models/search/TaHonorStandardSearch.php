<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaHonorStandard;

/**
 * TaHonorStandardSearch represents the model behind the search form about `backend\models\TaHonorStandard`.
 */
class TaHonorStandardSearch extends TaHonorStandard
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Standard', 'Kd_Honor_Sub_Jabatan', 'Nilai', 'Kd_Satuan'], 'integer'],
            [['Tahun'], 'safe'],
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
        $query = TaHonorStandard::find();

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
            'Kd_Standard' => $this->Kd_Standard,
            'Tahun' => $this->Tahun,
            'Kd_Honor_Sub_Jabatan' => $this->Kd_Honor_Sub_Jabatan,
            'Nilai' => $this->Nilai,
            'Kd_Satuan' => $this->Kd_Satuan,
        ]);

        return $dataProvider;
    }
}
