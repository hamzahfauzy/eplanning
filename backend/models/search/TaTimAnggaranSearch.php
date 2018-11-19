<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaTimAnggaran;

/**
 * TaTimAnggaranSearch represents the model behind the search form about `backend\models\TaTimAnggaran`.
 */
class TaTimAnggaranSearch extends TaTimAnggaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Tim', 'No_Urut'], 'integer'],
            [['Nama', 'NIP', 'Jabatan'], 'safe'],
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
        $query = TaTimAnggaran::find();

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
            'Kd_Tim' => $this->Kd_Tim,
            'No_Urut' => $this->No_Urut,
        ]);

        $query->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'NIP', $this->NIP])
            ->andFilterWhere(['like', 'Jabatan', $this->Jabatan]);

        return $dataProvider;
    }
}
