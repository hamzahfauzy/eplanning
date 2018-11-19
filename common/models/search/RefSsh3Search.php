<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSsh3;

/**
 * RefSsh3Search represents the model behind the search form about `common\models\RefSsh3`.
 */
class RefSsh3Search extends RefSsh3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3'], 'integer'],
            [['Nm_Ssh3'], 'safe'],
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
        $query = RefSsh3::find();

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
            'Kd_Ssh3' => $this->Kd_Ssh3,
        ]);

        $query->andFilterWhere(['like', 'Nm_Ssh3', $this->Nm_Ssh3]);

        return $dataProvider;
    }
}
