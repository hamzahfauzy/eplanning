<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSsh2;

/**
 * RefSsh2Search represents the model behind the search form about `common\models\RefSsh2`.
 */
class RefSsh2Search extends RefSsh2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2'], 'integer'],
            [['Nm_Ssh2'], 'safe'],
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
        $query = RefSsh2::find();

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
            'Kd_Ssh1' => $this->Kd_Ssh1,
            'Kd_Ssh2' => $this->Kd_Ssh2,
        ]);

        $query->andFilterWhere(['like', 'Nm_Ssh2', $this->Nm_Ssh2]);

        return $dataProvider;
    }
}
