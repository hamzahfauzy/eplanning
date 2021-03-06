<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJarak as RefJarakModel;

/**
 * RefJarak represents the model behind the search form about `common\models\RefJarak`.
 */
class RefJarak extends RefJarakModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jarak'], 'integer'],
            [['Nm_Jarak'], 'safe'],
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
        $query = RefJarakModel::find();

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
            'Kd_Jarak' => $this->Kd_Jarak,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jarak', $this->Nm_Jarak]);

        return $dataProvider;
    }
}
