<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailProgram;

/**
 * DetailProgramSearch represents the model behind the search form about `app\models\DetailProgram`.
 */
class DetailProgramSearch extends DetailProgram
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pagu', 'prakiraan_pagu'], 'integer'],
            [['kode_program', 'tahun', 'lokasi', 'target', 'sumber', 'catatan', 'prakiraan_target'], 'safe'],
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
        $query = DetailProgram::find();

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
            'id' => $this->id,
            'pagu' => $this->pagu,
            'prakiraan_pagu' => $this->prakiraan_pagu,
        ]);

        $query->andFilterWhere(['like', 'kode_program', $this->kode_program])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'sumber', $this->sumber])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'prakiraan_target', $this->prakiraan_target]);

        return $dataProvider;
    }
}
