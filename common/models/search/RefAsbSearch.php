<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAsb;

/**
 * RefAsbSearch represents the model behind the search form about `common\models\RefAsb`.
 */
class RefAsbSearch extends RefAsb
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Asb1', 'Kd_Asb2', 'Kd_Asb3', 'Kd_Asb4', 'Kd_Asb5', 'Kd_Satuan'], 'integer'],
            [['Jenis_Pekerjaan'], 'safe'],
            [['Harga'], 'number'],
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
        $query = RefAsb::find();

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
            'Kd_Asb1' => $this->Kd_Asb1,
            'Kd_Asb2' => $this->Kd_Asb2,
            'Kd_Asb3' => $this->Kd_Asb3,
            'Kd_Asb4' => $this->Kd_Asb4,
            'Kd_Asb5' => $this->Kd_Asb5,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga' => $this->Harga,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Pekerjaan', $this->Jenis_Pekerjaan]);

        return $dataProvider;
    }
}
