<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAkrual5;

/**
 * RefAkrual5Search represents the model behind the search form about `common\models\RefAkrual5`.
 */
class RefAkrual5Search extends RefAkrual5
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Akrual_1', 'Kd_Akrual_2', 'Kd_Akrual_3', 'Kd_Akrual_4', 'Kd_Akrual_5'], 'integer'],
            [['Nm_Akrual_5', 'Peraturan'], 'safe'],
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
        $query = RefAkrual5::find();

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
            'Kd_Akrual_1' => $this->Kd_Akrual_1,
            'Kd_Akrual_2' => $this->Kd_Akrual_2,
            'Kd_Akrual_3' => $this->Kd_Akrual_3,
            'Kd_Akrual_4' => $this->Kd_Akrual_4,
            'Kd_Akrual_5' => $this->Kd_Akrual_5,
        ]);

        $query->andFilterWhere(['like', 'Nm_Akrual_5', $this->Nm_Akrual_5])
            ->andFilterWhere(['like', 'Peraturan', $this->Peraturan]);

        return $dataProvider;
    }
}
