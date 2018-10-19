<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefHonor;

/**
 * RefHonorSearch represents the model behind the search form about `common\models\RefHonor`.
 */
class RefHonorSearch extends RefHonor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor'], 'integer'],
            [['Nm_Honor'], 'safe'],
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
        $query = RefHonor::find();

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
            'Kd_Honor' => $this->Kd_Honor,
        ]);

        $query->andFilterWhere(['like', 'Nm_Honor', $this->Nm_Honor]);

        return $dataProvider;
    }
}
