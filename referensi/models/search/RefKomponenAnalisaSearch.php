<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKomponenAnalisa;

/**
 * RefKomponenAnalisaSearch represents the model behind the search form about `common\models\RefKomponenAnalisa`.
 */
class RefKomponenAnalisaSearch extends RefKomponenAnalisa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Komponen'], 'integer'],
            [['Nm_Komponen'], 'safe'],
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
        $query = RefKomponenAnalisa::find();

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
            'Kd_Komponen' => $this->Kd_Komponen,
        ]);

        $query->andFilterWhere(['like', 'Nm_Komponen', $this->Nm_Komponen]);

        return $dataProvider;
    }
}
