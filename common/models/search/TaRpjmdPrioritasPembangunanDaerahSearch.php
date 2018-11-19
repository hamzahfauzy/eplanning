<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaRpjmdPrioritasPembangunanDaerah;

/**
 * TaRpjmdPrioritasPembangunanDaerahSearch represents the model behind the search form about `common\models\TaRpjmdPrioritasPembangunanDaerah`.
 */
class TaRpjmdPrioritasPembangunanDaerahSearch extends TaRpjmdPrioritasPembangunanDaerah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Prioritas_Pembangunan_Daerah'], 'safe'],
            [['No_Prioritas'], 'integer'],
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
        $query = TaRpjmdPrioritasPembangunanDaerah::find();

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
            'No_Prioritas' => $this->No_Prioritas,
        ]);

        $query->andFilterWhere(['like', 'Prioritas_Pembangunan_Daerah', $this->Prioritas_Pembangunan_Daerah]);

        return $dataProvider;
    }
}
