<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAnalisa;

/**
 * RefAnalisaSearch represents the model behind the search form about `common\models\RefAnalisa`.
 */
class RefAnalisaSearch extends RefAnalisa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa'], 'integer'],
            [['Nm_Analisa'], 'safe'],
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
        $query = RefAnalisa::find();

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
            'Kd_Analisa' => $this->Kd_Analisa,
        ]);

        $query->andFilterWhere(['like', 'Nm_Analisa', $this->Nm_Analisa]);

        return $dataProvider;
    }
}
