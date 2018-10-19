<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAsb2;

/**
 * RefAsb2Search represents the model behind the search form about `common\models\RefAsb2`.
 */
class RefAsb2Search extends RefAsb2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2'], 'integer'],
            [['Nm_Asb2'], 'safe'],
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
        $query = RefAsb2::find();

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
            'Kd_Asb1' => $this->Kd_Asb1,
            'Kd_Asb2' => $this->Kd_Asb2,
        ]);

        $query->andFilterWhere(['like', 'Nm_Asb2', $this->Nm_Asb2]);

        return $dataProvider;
    }
}
