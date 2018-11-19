<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefMedia;

/**
 * RefMediaSearch represents the model behind the search form of `common\models\RefMedia`.
 */
class RefMediaSearch extends RefMedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Media'], 'integer'],
            [['Jenis_Media', 'Type_Media', 'Judul_Media', 'Nm_Media', 'Created_At'], 'safe'],
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
        $query = RefMedia::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Media' => $this->Kd_Media,
            'Created_At' => $this->Created_At,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Media', $this->Jenis_Media])
            ->andFilterWhere(['like', 'Type_Media', $this->Type_Media])
            ->andFilterWhere(['like', 'Judul_Media', $this->Judul_Media])
            ->andFilterWhere(['like', 'Nm_Media', $this->Nm_Media]);

        return $dataProvider;
    }
}
