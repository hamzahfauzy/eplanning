<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJalan;

/**
 * RefJalanSearch represents the model behind the search form about `common\models\RefJalan`.
 */
class RefJalanSearch extends RefJalan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Unit', 'Kd_Sub_Unit', 'Kd_Lingkungan', 'Kd_Jalan'], 'integer'],
            [['Nm_Jalan'], 'safe'],
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
        $query = RefJalan::find();

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
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub_Unit' => $this->Kd_Sub_Unit,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jalan', $this->Nm_Jalan]);

        return $dataProvider;
    }
}
