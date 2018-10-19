<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefUrusan as RefUrusanModel;

/**
 * RefUrusan represents the model behind the search form of `common\models\RefUrusan`.
 */
class RefUrusan extends RefUrusanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan'], 'integer'],
            [['Nm_Urusan'], 'safe'],
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
        $query = RefUrusanModel::find();

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
        $query->andFilterWhere([
            'Kd_Urusan' => $this->Kd_Urusan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan]);

        return $dataProvider;
    }
}
