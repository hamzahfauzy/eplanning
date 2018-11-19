<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKetBiaya;

/**
 * RefKetBiayaSearch represents the model behind the search form about `common\models\RefKetBiaya`.
 */
class RefKetBiayaSearch extends RefKetBiaya
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ket_Biaya'], 'integer'],
            [['Nm_Ket_Biaya'], 'safe'],
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
        $query = RefKetBiaya::find();

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
            'Kd_Ket_Biaya' => $this->Kd_Ket_Biaya,
        ]);

        $query->andFilterWhere(['like', 'Nm_Ket_Biaya', $this->Nm_Ket_Biaya]);

        return $dataProvider;
    }
}
