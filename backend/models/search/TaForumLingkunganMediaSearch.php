<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaForumLingkunganMedia;

/**
 * TaForumLingkunganMediaSearch represents the model behind the search form about `backend\models\TaForumLingkunganMedia`.
 */
class TaForumLingkunganMediaSearch extends TaForumLingkunganMedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Forum_Lingkungan'], 'integer'],
            [['Jenis_Media', 'Type_Media', 'Judul_Media', 'Nm_Media', 'Created_at'], 'safe'],
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
        $query = TaForumLingkunganMedia::find();

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
            'Kd_Forum_Lingkungan' => $this->Kd_Forum_Lingkungan,
            'Created_at' => $this->Created_at,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Media', $this->Jenis_Media])
            ->andFilterWhere(['like', 'Type_Media', $this->Type_Media])
            ->andFilterWhere(['like', 'Judul_Media', $this->Judul_Media])
            ->andFilterWhere(['like', 'Nm_Media', $this->Nm_Media]);

        return $dataProvider;
    }
}
