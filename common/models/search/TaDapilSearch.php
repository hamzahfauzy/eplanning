<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaDapil;

/**
 * TaDapilSearch represents the model behind the search form about `common\models\TaDapil`.
 */
class TaDapilSearch extends TaDapil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['Kd_Dapil', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec'], 'integer'],
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
        $query = TaDapil::find();

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
            'Tahun' => $this->Tahun,
            'Kd_Dapil' => $this->Kd_Dapil,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
        ]);

        return $dataProvider;
    }
}
