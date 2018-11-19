<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefHspk3;

/**
 * RefHspk3Search represents the model behind the search form about `common\models\RefHspk3`.
 */
class RefHspk3Search extends RefHspk3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3'], 'integer'],
            [['Nm_Hspk3'], 'safe'],
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
        $query = RefHspk3::find();

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
            'Kd_Hspk1' => $this->Kd_Hspk1,
            'Kd_Hspk2' => $this->Kd_Hspk2,
            'Kd_Hspk3' => $this->Kd_Hspk3,
        ]);

        $query->andFilterWhere(['like', 'Nm_Hspk3', $this->Nm_Hspk3]);

        return $dataProvider;
    }
}
