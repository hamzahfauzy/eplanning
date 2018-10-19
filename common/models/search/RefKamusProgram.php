<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKamusProgram as RefKamusProgramModel;

/**
 * RefKamusProgram represents the model behind the search form about `common\models\RefKamusProgram`.
 */
class RefKamusProgram extends RefKamusProgramModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Program', 'Status'], 'integer'],
            [['Nm_Program'], 'safe'],
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
        $query = RefKamusProgramModel::find();

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
            'Kd_Program' => $this->Kd_Program,
            'Status' => $this->Status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Program', $this->Nm_Program]);

        return $dataProvider;
    }
}