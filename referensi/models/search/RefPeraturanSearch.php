<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPeraturan;

/**
 * RefPeraturanSearch represents the model behind the search form about `common\models\RefPeraturan`.
 */
class RefPeraturanSearch extends RefPeraturan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Peraturan'], 'integer'],
            [['Nm_Peraturan'], 'safe'],
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
        $query = RefPeraturan::find();

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
            'Kd_Peraturan' => $this->Kd_Peraturan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Peraturan', $this->Nm_Peraturan]);

        return $dataProvider;
    }
}
