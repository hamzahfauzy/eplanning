<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefRekAset2;

/**
 * RefRekAset2Search represents the model behind the search form about `common\models\RefRekAset2`.
 */
class RefRekAset2Search extends RefRekAset2
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aset1', 'Kd_Aset2'], 'integer'],
            [['Nm_Aset2'], 'safe'],
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
        $query = RefRekAset2::find();

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
            'Kd_Aset1' => $this->Kd_Aset1,
            'Kd_Aset2' => $this->Kd_Aset2,
        ]);

        $query->andFilterWhere(['like', 'Nm_Aset2', $this->Nm_Aset2]);

        return $dataProvider;
    }
}
