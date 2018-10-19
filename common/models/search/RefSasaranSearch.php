<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSasaran;

/**
 * RefSasaranSearch represents the model behind the search form about `common\models\RefSasaran`.
 */
class RefSasaranSearch extends RefSasaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Sasaran'], 'integer'],
            [['Nm_Sasaran'], 'safe'],
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
        $query = RefSasaran::find();

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
            'Kd_Sasaran' => $this->Kd_Sasaran,
        ]);

        $query->andFilterWhere(['like', 'Nm_Sasaran', $this->Nm_Sasaran]);

        return $dataProvider;
    }
}
