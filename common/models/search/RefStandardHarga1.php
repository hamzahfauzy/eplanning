<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefStandardHarga1 as RefStandardHarga1Model;

/**
 * RefStandardHarga1 represents the model behind the search form about `common\models\RefStandardHarga1`.
 */
class RefStandardHarga1 extends RefStandardHarga1Model
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Uraian'], 'safe'],
            [['Kd_1'], 'integer'],
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
        $query = RefStandardHarga1Model::find();

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
            'Kd_1' => $this->Kd_1,
        ]);

        $query->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
