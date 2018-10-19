<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefBenuaSub;

/**
 * RefBenuaSubSearch represents the model behind the search form about `common\models\RefBenuaSub`.
 */
class RefBenuaSubSearch extends RefBenuaSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua', 'Kd_Benua_Sub'], 'integer'],
            [['Nm_Benua_Sub'], 'safe'],
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
        $query = RefBenuaSub::find();

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
            'Kd_Benua_Sub' => $this->Kd_Benua_Sub,
        ]);

        $query->andFilterWhere(['like', 'Nm_Benua_Sub', $this->Nm_Benua_Sub]);

        return $dataProvider;
    }
}
