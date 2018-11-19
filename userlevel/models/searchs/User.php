<?php

namespace userlevel\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use userlevel\models\User as UserModel;

/**
 * User represents the model behind the search form about `mdm\admin\models\User`.
 */
class User extends UserModel
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
        $query = UserModel::find()
            ->select(['user.*'])
            ->leftJoin('Ta_User_Unit tau', 'tau.Kd_User=user.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            $query->where('1=0');
            return $dataProvider;
        }

        /*if(Yii::$app->user->identity){
            $query->andFilterWhere([
                'Kd_Urusan' => Yii::$app->user->identity->Kd_Urusan,
                'Kd_Bidang' => Yii::$app->user->identity->Kd_Bidang,
                'Kd_Unit'   => Yii::$app->user->identity->Kd_Unit,
                'Kd_Sub_Unit' => Yii::$app->user->identity->Kd_Sub_Unit,
            ]);
        }*/

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
