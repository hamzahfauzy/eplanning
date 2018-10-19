<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefTahapan;

/**
 * RefTahapanSearch represents the model behind the search form about `common\models\RefTahapan`.
 */
class RefTahapanSearch extends RefTahapan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Tahapan', 'No_Urut'], 'integer'],
            [['Uraian'], 'safe'],
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
        $query = RefTahapan::find();

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
            'Kd_Tahapan' => $this->Kd_Tahapan,
            'No_Urut' => $this->No_Urut,
        ]);

        $query->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
