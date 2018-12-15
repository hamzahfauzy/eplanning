<?php

namespace emonev\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\ProgramNasional;

/**
 * ProgramNasionalSearch represents the model behind the search form about `app\models\ProgramNasional`.
 */
class ProgramNasionalSearch extends ProgramNasional
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
            'namaPrioritas',
            'namaNawacita',
            'namaMisi',
            'namaUrusan',
            'id_prioritas',
            'id_nawacita',
            'id_urusan',
            'id_misi',
            'misi', 'urusan', 'bidang', 'id_program', 'created_at', 'updated_at', 'username', 'tahun'], 'safe'],
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
        $query = ProgramNasional::find();
        $query->select(['program_nasional.*',
         'pn.prioritas_nasional namaPrioritas',
         'nc.nawacita namaNawacita',
         'm.misi namaMisi',
         'ur.urusan namaUrusan']);
        $query->leftJoin('prioritas_nasional pn', 'pn.id=program_nasional.id_prioritas')
              ->leftJoin('nawacita nc', 'nc.id=program_nasional.id_nawacita')
              ->leftJoin('misi m', 'm.id=program_nasional.id_misi')
              ->leftJoin('urusan ur', 'ur.id=program_nasional.id_urusan')
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'prioritas_nasional', $this->namaPrioritas])
            ->andFilterWhere(['like', 'nawacita', $this->namaNawacita])
            ->andFilterWhere(['like', 'misi', $this->namaMisi])
            ->andFilterWhere(['like', 'ur.urusan', $this->namaUrusan])
            ;

        return $dataProvider;
    }
}
