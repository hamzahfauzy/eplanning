<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAkrual1 as RefAkrual1Model;

/**
 * RefAkrual1 represents the model behind the search form about `common\models\RefAkrual1`.
 */
class RefAkrual1 extends RefAkrual1Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1'], 'integer'],
            [['Nm_Akrual_1'], 'safe'],
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
        $query = RefAkrual1Model::find();

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
            'Kd_Akrual_1' => $this->Kd_Akrual_1,
        ]);

        $query->andFilterWhere(['like', 'Nm_Akrual_1', $this->Nm_Akrual_1]);

        return $dataProvider;
    }
}
