<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaMusrenbangKelurahanMedia;

/**
 * TaMusrenbangKelurahanMediaSearch represents the model behind the search form of `common\models\TaMusrenbangKelurahanMedia`.
 */
class TaMusrenbangKelurahanMediaSearch extends TaMusrenbangKelurahanMedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Musrenbang_Kelurahan', 'Kd_Media'], 'integer'],
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
    public function search($params, $id)
    {
        $query = TaMusrenbangKelurahanMedia::find();

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
		
		$query->andWhere(['Kd_Musrenbang_Kelurahan' => $id]);

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_Musrenbang_Kelurahan' => $this->Kd_Musrenbang_Kelurahan,
            'Kd_Media' => $this->Kd_Media,
        ]);

        return $dataProvider;
    }
}
