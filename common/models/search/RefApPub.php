<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefApPub as RefApPubModel;

/**
 * RefApPub represents the model behind the search form about `common\models\RefApPub`.
 */
class RefApPub extends RefApPubModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ap_Pub'], 'integer'],
            [['Nm_Ap_Pub'], 'safe'],
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
        $query = RefApPubModel::find();

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
            'Kd_Ap_Pub' => $this->Kd_Ap_Pub,
        ]);

        $query->andFilterWhere(['like', 'Nm_Ap_Pub', $this->Nm_Ap_Pub]);

        return $dataProvider;
    }
}
