<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefUrusan;

/**
 * RefUrusanSearch represents the model behind the search form about `common\models\RefUrusan`.
 */
class RefUrusanSearch extends RefUrusan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan'], 'integer'],
            [['Nm_Urusan'], 'safe'],
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
        $query = RefUrusan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan]);

        return $dataProvider;
    }
}
