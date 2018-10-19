<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefBenua as RefBenuaModel;

/**
 * RefBenua represents the model behind the search form about `common\models\RefBenua`.
 */
class RefBenua extends RefBenuaModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua'], 'integer'],
            [['Nm_Benua'], 'safe'],
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
        $query = RefBenuaModel::find();

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
            'Kd_Benua' => $this->Kd_Benua,
        ]);

        $query->andFilterWhere(['like', 'Nm_Benua', $this->Nm_Benua]);

        return $dataProvider;
    }
}
