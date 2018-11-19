<?php

namespace userlevel\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AssignmentSearch represents the model behind the search form about Assignment.
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Assignment extends Model
{
    public $id;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'username' => Yii::t('rbac-admin', 'Username'),
            'name' => Yii::t('rbac-admin', 'Name'),
        ];
    }

    /**
     * Create data provider for Assignment model.
     * @param  array                        $params
     * @param  \yii\db\ActiveRecord         $class
     * @param  string                       $usernameField
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $class, $usernameField)
    {
    	$DNDataKelompok = Yii::$app->levelcomponent->getKelompok();
    	
        $query = $class::find()->leftJoin('Ta_User_Kelompok', 'Ta_User_Kelompok.Kd_User=user.id');
        
        if($DNDataKelompok['Kd_Kel']!=0){
        	$query->andFilterWhere([
        		'Ta_User_Kelompok.Kd_Prov' => $DNDataKelompok['Kd_Prov'],
        		'Ta_User_Kelompok.Kd_Kab' => $DNDataKelompok['Kd_Kab'],
        		'Ta_User_Kelompok.Kd_Kec' => $DNDataKelompok['Kd_Kec'],
        		'Ta_User_Kelompok.Kd_Kel' => $DNDataKelompok['Kd_Kel'],
        		'Ta_User_Kelompok.Kd_Urut_Kel' => $DNDataKelompok['Kd_Urut_Kel'],
        	]);
        }else{
        	$query->andFilterWhere([
        		'Ta_User_Kelompok.Kd_Prov' => $DNDataKelompok['Kd_Prov'],
        		'Ta_User_Kelompok.Kd_Kab' => $DNDataKelompok['Kd_Kab'],
        		'Ta_User_Kelompok.Kd_Kec' => $DNDataKelompok['Kd_Kec'],
        	]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        
        $query->andFilterWhere(['like', $usernameField, $this->username]);

        return $dataProvider;
    }
}
