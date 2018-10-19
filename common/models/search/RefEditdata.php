<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefEditdata as RefEditdataModel;

/**
 * RefEditdata represents the model behind the search form about `common\models\RefEditdata`.
 */
class RefEditdata extends RefEditdataModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Edit'], 'integer'],
            [['Nm_Edit'], 'safe'],
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
        $query = RefEditdataModel::find();

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
            'Kd_Edit' => $this->Kd_Edit,
        ]);

        $query->andFilterWhere(['like', 'Nm_Edit', $this->Nm_Edit]);

        return $dataProvider;
    }
}
