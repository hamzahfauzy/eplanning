<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefUsulan as RefUsulanModel;

/**
 * RefUsulan represents the model behind the search form about `common\models\RefUsulan`.
 */
class RefUsulanSearch extends RefUsulanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Usulan', 'Kd_Klasifikasi'], 'integer'],
            [['Nm_Usulan'], 'safe'],
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
        $query = RefUsulanModel::find();

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
            'Kd_Usulan' => $this->Kd_Usulan,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
        ]);

        $query->andFilterWhere(['like', 'Nm_Usulan', $this->Nm_Usulan]);

        return $dataProvider;
    }
}
