<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefLevel as RefLevelModel;

/**
 * RefLevel represents the model behind the search form about `common\models\RefLevel`.
 */
class RefLevel extends RefLevelModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Level'], 'integer'],
            [['Nm_Level'], 'safe'],
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
        $query = RefLevelModel::find();

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
            'Kd_Level' => $this->Kd_Level,
        ]);

        $query->andFilterWhere(['like', 'Nm_Level', $this->Nm_Level]);

        return $dataProvider;
    }
}
