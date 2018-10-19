<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaUserDapil;

/**
 * TaUserDapilSearch represents the model behind the search form about `common\models\TaUserDapil`.
 */
class TaUserDapilSearch extends TaUserDapil
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['Kd_User', 'Kd_Dapil'], 'integer'],
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
        $query = TaUserDapil::find();

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
            'Kd_User' => $this->Kd_User,
            'Kd_Dapil' => $this->Kd_Dapil,
        ]);

        return $dataProvider;
    }
}
