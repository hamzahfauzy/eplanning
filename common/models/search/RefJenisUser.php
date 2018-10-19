<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJenisUser as RefJenisUserModel;

/**
 * RefJenisUser represents the model behind the search form about `common\models\RefJenisUser`.
 */
class RefJenisUser extends RefJenisUserModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jenis_User'], 'integer'],
            [['Nm_Jenis_User'], 'safe'],
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
        $query = RefJenisUserModel::find();

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
            'Kd_Jenis_User' => $this->Kd_Jenis_User,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jenis_User', $this->Nm_Jenis_User]);

        return $dataProvider;
    }
}
