<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefHonorSubA;

/**
 * RefHonorSubASearch represents the model behind the search form about `common\models\RefHonorSubA`.
 */
class RefHonorSubASearch extends RefHonorSubA
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A'], 'integer'],
            [['Nm_Honor_Sub_A'], 'safe'],
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
        $query = RefHonorSubA::find();

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
            'Kd_Honor_Sub' => $this->Kd_Honor_Sub,
            'Kd_Honor_Sub_A' => $this->Kd_Honor_Sub_A,
        ]);

        $query->andFilterWhere(['like', 'Nm_Honor_Sub_A', $this->Nm_Honor_Sub_A]);

        return $dataProvider;
    }
}
