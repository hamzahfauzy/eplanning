<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKecamatanKriteriaPembobotan;

/**
 * RefKecamatanKriteriaPembobotanSearch represents the model behind the search form about `common\models\RefKecamatanKriteriaPembobotan`.
 */
class RefKecamatanKriteriaPembobotanSearch extends RefKecamatanKriteriaPembobotan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Kriteria', 'Bobot'], 'integer'],
            [['Kriteria', 'Keterangan_Kriteria'], 'safe'],
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
        $query = RefKecamatanKriteriaPembobotan::find();

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
            'Kd_Kriteria' => $this->Kd_Kriteria,
            'Bobot' => $this->Bobot,
        ]);

        $query->andFilterWhere(['like', 'Kriteria', $this->Kriteria])
            ->andFilterWhere(['like', 'Keterangan_Kriteria', $this->Keterangan_Kriteria]);

        return $dataProvider;
    }
}
