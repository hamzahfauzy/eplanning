<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaRpjmdSasaran;

/**
 * TaRpjmdSasaranSearch represents the model behind the search form about `common\models\TaRpjmdSasaran`.
 */
class TaRpjmdSasaranSearch extends TaRpjmdSasaran
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Sasaran'], 'safe'],
            [['No_Misi', 'No_Tujuan', 'No_Sasaran'], 'integer'],
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
        $query = TaRpjmdSasaran::find();

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
            'No_Sasaran' => $this->No_Sasaran,
        ]);

        $query->andFilterWhere(['like', 'Sasaran', $this->Sasaran]);

        return $dataProvider;
    }
}
