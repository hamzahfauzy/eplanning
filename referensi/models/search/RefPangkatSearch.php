<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefPangkat;

/**
 * RefPangkatSearch represents the model behind the search form about `common\models\RefPangkat`.
 */
class RefPangkatSearch extends RefPangkat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Golongan', 'Kd_Golongan_Ruang', 'Kd_Pangkat'], 'integer'],
            [['Nm_Pangkat'], 'safe'],
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
        $query = RefPangkat::find();

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
            'Kd_Golongan' => $this->Kd_Golongan,
            'Kd_Golongan_Ruang' => $this->Kd_Golongan_Ruang,
            'Kd_Pangkat' => $this->Kd_Pangkat,
        ]);

        $query->andFilterWhere(['like', 'Nm_Pangkat', $this->Nm_Pangkat]);

        return $dataProvider;
    }
}
