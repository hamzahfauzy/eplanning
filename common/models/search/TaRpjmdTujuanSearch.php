<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaRpjmdTujuan;

/**
 * TaRpjmdTujuanSearch represents the model behind the search form about `common\models\TaRpjmdTujuan`.
 */
class TaRpjmdTujuanSearch extends TaRpjmdTujuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Tujuan'], 'safe'],
            [['No_Misi', 'No_Tujuan'], 'integer'],
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
        $query = TaRpjmdTujuan::find();

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
            'No_Misi' => $this->No_Misi,
            'No_Tujuan' => $this->No_Tujuan,
        ]);

        $query->andFilterWhere(['like', 'Tujuan', $this->Tujuan]);

        return $dataProvider;
    }
}
