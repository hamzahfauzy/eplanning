<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefStatusUsulan as RefStatusUsulanModel;

/**
 * RefStatusUsulan represents the model behind the search form about `common\models\RefStatusUsulan`.
 */
class RefStatusUsulan extends RefStatusUsulanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Status'], 'integer'],
            [['Nm_Status'], 'safe'],
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
        $query = RefStatusUsulanModel::find();

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
            'Kd_Status' => $this->Kd_Status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Status', $this->Nm_Status]);

        return $dataProvider;
    }
}
