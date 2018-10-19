<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaIdentitas;

/**
 * TaIdentitasSearch represents the model behind the search form about `common\models\TaIdentitas`.
 */
class TaIdentitasSearch extends TaIdentitas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Id', 'Status'], 'integer'],
            [['Hostname', 'Ip_Public', 'Logo', 'Nm_Instansi', 'Created_At', 'Email'], 'safe'],
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
        $query = TaIdentitas::find();

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
            'Id' => $this->Id,
            'Created_At' => $this->Created_At,
            'Status' => $this->Status,
        ]);

        $query->andFilterWhere(['like', 'Hostname', $this->Hostname])
            ->andFilterWhere(['like', 'Ip_Public', $this->Ip_Public])
            ->andFilterWhere(['like', 'Logo', $this->Logo])
            ->andFilterWhere(['like', 'Nm_Instansi', $this->Nm_Instansi])
            ->andFilterWhere(['like', 'Email', $this->Email]);

        return $dataProvider;
    }
}
