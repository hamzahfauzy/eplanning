<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAsb3;

/**
 * RefAsb3Search represents the model behind the search form about `common\models\RefAsb3`.
 */
class RefAsb3Search extends RefAsb3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3'], 'integer'],
            [['Nm_Asb3'], 'safe'],
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
        $query = RefAsb3::find();

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
            'Kd_Asb3' => $this->Kd_Asb3,
        ]);

        $query->andFilterWhere(['like', 'Nm_Asb3', $this->Nm_Asb3]);

        return $dataProvider;
    }
}
