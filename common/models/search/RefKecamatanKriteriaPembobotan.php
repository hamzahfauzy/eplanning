<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKecamatanKriteriaPembobotan as RefKecamatanKriteriaPembobotanModel;

/**
 * RefKecamatanKriteriaPembobotan represents the model behind the search form of `common\models\RefKecamatanKriteriaPembobotan`.
 */
class RefKecamatanKriteriaPembobotan extends RefKecamatanKriteriaPembobotanModel
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
        $query = RefKecamatanKriteriaPembobotanModel::find();

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
            'Kd_Kriteria' => $this->Kd_Kriteria,
            'Bobot' => $this->Bobot,
        ]);

        $query->andFilterWhere(['like', 'Kriteria', $this->Kriteria])
            ->andFilterWhere(['like', 'Keterangan_Kriteria', $this->Keterangan_Kriteria]);

        return $dataProvider;
    }
}
