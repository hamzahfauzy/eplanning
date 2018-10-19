<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefTransportasi;

/**
 * RefTransportasiSearch represents the model behind the search form about `common\models\RefTransportasi`.
 */
class RefTransportasiSearch extends RefTransportasi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Transportasi'], 'integer'],
            [['Nm_Transportasi'], 'safe'],
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
        $query = RefTransportasi::find();

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
            'Kd_Transportasi' => $this->Kd_Transportasi,
        ]);

        $query->andFilterWhere(['like', 'Nm_Transportasi', $this->Nm_Transportasi]);

        return $dataProvider;
    }
}
