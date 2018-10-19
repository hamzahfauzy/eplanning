<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaRpjmdProgramPrioritas;

/**
 * TaRpjmdProgramPrioritasSearch represents the model behind the search form about `common\models\TaRpjmdProgramPrioritas`.
 */
class TaRpjmdProgramPrioritasSearch extends TaRpjmdProgramPrioritas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['No_Misi', 'No_Tujuan', 'No_Sasaran', 'No_Prioritas', 'Kd_Prog'], 'integer'],
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
        $query = TaRpjmdProgramPrioritas::find();

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
            'No_Prioritas' => $this->No_Prioritas,
            'Kd_Prog' => $this->Kd_Prog,
        ]);

        return $dataProvider;
    }
}
