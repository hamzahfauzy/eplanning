<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaUserAplikasi;

/**
 * TaUserAplikasiSearch represents the model behind the search form of `common\models\TaUserAplikasi`.
 */
class TaUserAplikasiSearch extends TaUserAplikasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User'], 'integer'],
            [['Kd_Aplikasi'], 'safe'],
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
        $query = TaUserAplikasi::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        //print_r($params['id']);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        if($params['id']){
        	$query->andFilterWhere([
            	'Kd_User' => $params['id'],
        	]);
        }else{
        	$query->andFilterWhere([
            	'Kd_User' => $this->Kd_User,
        	]);
        }

        $query->andFilterWhere(['like', 'Kd_Aplikasi', $this->Kd_Aplikasi]);

        return $dataProvider;
    }
}
