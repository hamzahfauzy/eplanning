<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJabatan;

/**
 * RefJabatanSearch represents the model behind the search form about `common\models\RefJabatan`.
 */
class RefJabatanSearch extends RefJabatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jab'], 'integer'],
            [['Nm_Jab'], 'safe'],
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
        $query = RefJabatan::find();

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
            'Kd_Jab' => $this->Kd_Jab,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jab', $this->Nm_Jab]);

        return $dataProvider;
    }
}
