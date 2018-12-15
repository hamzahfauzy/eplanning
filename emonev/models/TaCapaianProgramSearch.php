<?php

namespace emonev\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emonev\models\TaCapaianProgram;

/**
 * TaCapaianProgramSearch represents the model behind the search form about `app\models\TaCapaianProgram`.
 */
class TaCapaianProgramSearch extends TaCapaianProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'No_ID'], 'integer'],
            [['Tolak_Ukur', 'Target_Uraian'], 'safe'],
            [['Target_Angka'], 'number'],
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
        $query = TaCapaianProgram::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'No_ID' => $this->No_ID,
            'Target_Angka' => $this->Target_Angka,
        ]);

        $query->andFilterWhere(['like', 'Tolak_Ukur', $this->Tolak_Ukur])
            ->andFilterWhere(['like', 'Target_Uraian', $this->Target_Uraian]);

        return $dataProvider;
    }
}
