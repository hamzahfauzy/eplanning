<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKodeTim;

/**
 * RefKodeTimSearch represents the model behind the search form about `common\models\RefKodeTim`.
 */
class RefKodeTimSearch extends RefKodeTim
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Tim'], 'integer'],
            [['Nm_Tim'], 'safe'],
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
        $query = RefKodeTim::find();

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
            'Kd_Tim' => $this->Kd_Tim,
        ]);

        $query->andFilterWhere(['like', 'Nm_Tim', $this->Nm_Tim]);

        return $dataProvider;
    }
}
