<?php

namespace userlevel\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use userlevel\models\User;

/**
 * UserSearch represents the model behind the search form of `frontend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key', 'password_hash', 'password_reset_token', 'email'], 'safe'],
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
    	$DNDataKelompok = Yii::$app->levelcomponent->getKelompok();
    	
    	$DNDataLevel = Yii::$app->levelcomponent->getLevel();
    	
        $query = User::find()->leftJoin('Ta_User_Kelompok', 'Ta_User_Kelompok.Kd_User=user.id');

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
        if($DNDataKelompok['Kd_Kel']!=0){
        	$query->andFilterWhere([
        		'Ta_User_Kelompok.Kd_Prov' => $DNDataKelompok['Kd_Prov'],
        		'Ta_User_Kelompok.Kd_Kab' => $DNDataKelompok['Kd_Kab'],
        		'Ta_User_Kelompok.Kd_Kec' => $DNDataKelompok['Kd_Kec'],
        		'Ta_User_Kelompok.Kd_Kel' => $DNDataKelompok['Kd_Kel'],
        		'Ta_User_Kelompok.Kd_Urut_Kel' => $DNDataKelompok['Kd_Urut_Kel'],
            	'id' => $this->id,
            	'status' => $this->status,
            	'created_at' => $this->created_at,
            	'updated_at' => $this->updated_at,
        	]);
        }else{
        	$query->andFilterWhere([
        		'Ta_User_Kelompok.Kd_Prov' => $DNDataKelompok['Kd_Prov'],
        		'Ta_User_Kelompok.Kd_Kab' => $DNDataKelompok['Kd_Kab'],
        		'Ta_User_Kelompok.Kd_Kec' => $DNDataKelompok['Kd_Kec'],
            	'id' => $this->id,
            	'status' => $this->status,
            	'created_at' => $this->created_at,
            	'updated_at' => $this->updated_at,
        	]);
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
