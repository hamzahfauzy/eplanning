<?php

namespace eperencanaan\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaLingkunganPaguIndikatif;

/**
 * TaLingkunganPaguIndikatifSearch represents the model behind the search form of `eperencanaan\models\TaLingkunganPaguIndikatif`.
 */
class TaLingkunganPaguIndikatifSearch extends TaLingkunganPaguIndikatif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'], 'integer'],
            [['Pagu_Indikatif'], 'number'],
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
        $query = TaLingkunganPaguIndikatif::find();

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
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Pagu_Indikatif' => $this->Pagu_Indikatif,
        ]);

        return $dataProvider;
    }
}
