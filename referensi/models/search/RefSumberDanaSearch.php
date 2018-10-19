<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSumberDana;

/**
 * RefSumberDanaSearch represents the model behind the search form about `common\models\RefSumberDana`.
 */
class RefSumberDanaSearch extends RefSumberDana
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Sumber'], 'integer'],
            [['Nm_Sumber'], 'safe'],
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
        $query = RefSumberDana::find();

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
            'Kd_Sumber' => $this->Kd_Sumber,
        ]);

        $query->andFilterWhere(['like', 'Nm_Sumber', $this->Nm_Sumber]);

        return $dataProvider;
    }
}
