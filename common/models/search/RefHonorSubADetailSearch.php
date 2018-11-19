<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefHonorSubADetail;

/**
 * RefHonorSubADetailSearch represents the model behind the search form about `common\models\RefHonorSubADetail`.
 */
class RefHonorSubADetailSearch extends RefHonorSubADetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Honor', 'Kd_Honor_Sub', 'Kd_Honor_Sub_A', 'Kd_Honor_Sub_A_Detail'], 'integer'],
            [['Nm_Honor_Sub_A_Detail'], 'safe'],
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
        $query = RefHonorSubADetail::find();

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
            'Kd_Honor_Sub_A_Detail' => $this->Kd_Honor_Sub_A_Detail,
        ]);

        $query->andFilterWhere(['like', 'Nm_Honor_Sub_A_Detail', $this->Nm_Honor_Sub_A_Detail]);

        return $dataProvider;
    }
}
