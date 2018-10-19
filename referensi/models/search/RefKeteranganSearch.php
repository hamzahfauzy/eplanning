<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKeterangan;

/**
 * RefKeteranganSearch represents the model behind the search form about `common\models\RefKeterangan`.
 */
class RefKeteranganSearch extends RefKeterangan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Keterangan'], 'integer'],
            [['Nm_Keterangan'], 'safe'],
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
        $query = RefKeterangan::find();

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
            'Kd_Keterangan' => $this->Kd_Keterangan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Keterangan', $this->Nm_Keterangan]);

        return $dataProvider;
    }
}
