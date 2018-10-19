<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefGolonganRuang;

/**
 * RefGolonganRuangSearch represents the model behind the search form about `common\models\RefGolonganRuang`.
 */
class RefGolonganRuangSearch extends RefGolonganRuang
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Golongan', 'Kd_Golongan_Ruang'], 'integer'],
            [['Nm_Golongan_Ruang'], 'safe'],
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
        $query = RefGolonganRuang::find();

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Golongan_Ruang', $this->Nm_Golongan_Ruang]);

        return $dataProvider;
    }
}
