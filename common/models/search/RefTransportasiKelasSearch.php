<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefTransportasiKelas;

/**
 * RefTransportasiKelasSearch represents the model behind the search form about `common\models\RefTransportasiKelas`.
 */
class RefTransportasiKelasSearch extends RefTransportasiKelas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Transportasi', 'Kd_Kelas'], 'integer'],
            [['Nm_Kelas'], 'safe'],
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
        $query = RefTransportasiKelas::find();

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
            'Kd_Kelas' => $this->Kd_Kelas,
        ]);

        $query->andFilterWhere(['like', 'Nm_Kelas', $this->Nm_Kelas]);

        return $dataProvider;
    }
}
