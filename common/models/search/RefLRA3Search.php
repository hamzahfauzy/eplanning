<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefLRA3;

/**
 * RefLRA3Search represents the model behind the search form about `common\models\RefLRA3`.
 */
class RefLRA3Search extends RefLRA3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3'], 'integer'],
            [['Nm_Rek_3'], 'safe'],
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
        $query = RefLRA3::find();

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
            'Kd_Rek_1' => $this->Kd_Rek_1,
            'Kd_Rek_2' => $this->Kd_Rek_2,
            'Kd_Rek_3' => $this->Kd_Rek_3,
        ]);

        $query->andFilterWhere(['like', 'Nm_Rek_3', $this->Nm_Rek_3]);

        return $dataProvider;
    }
}
