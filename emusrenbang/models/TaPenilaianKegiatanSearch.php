<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TaPenilaianKegiatan;

/**
 * TaPenilaianKegiatanSearch represents the model behind the search form about `app\models\TaPenilaianKegiatan`.
 */
class TaPenilaianKegiatanSearch extends TaPenilaianKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'Kd_Unit', 'Kd_Kegiatan', 'created_at', 'updated_at', 'username', 'created_status', 'updated_status', 'status_by'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Program', 'ID_Penilaian', 'status'], 'integer'],
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
        $query = TaPenilaianKegiatan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Program' => $this->Kd_Program,
            'ID_Penilaian' => $this->ID_Penilaian,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'created_status' => $this->created_status,
            'updated_status' => $this->updated_status,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'Kd_Unit', $this->Kd_Unit])
            ->andFilterWhere(['like', 'Kd_Kegiatan', $this->Kd_Kegiatan])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'status_by', $this->status_by]);

        return $dataProvider;
    }
}
