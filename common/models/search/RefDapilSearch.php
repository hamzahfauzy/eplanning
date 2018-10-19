<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefDapil;

/**
 * RefDapilSearch represents the model behind the search form about `common\models\RefDapil`.
 */
class RefDapilSearch extends RefDapil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Dapil'], 'safe'],
            [['Kd_Dapil'], 'integer'],
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
        $query = RefDapil::find();

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
            'Tahun' => $this->Tahun,
            'Kd_Dapil' => $this->Kd_Dapil,
        ]);

        $query->andFilterWhere(['like', 'Nm_Dapil', $this->Nm_Dapil]);

        return $dataProvider;
    }
}
