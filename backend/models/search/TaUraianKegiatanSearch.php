<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaUraianKegiatan;

/**
 * TaUraianKegiatanSearch represents the model behind the search form about `backend\models\TaUraianKegiatan`.
 */
class TaUraianKegiatanSearch extends TaUraianKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'lokasi_Kegiatan', 'kelompok_sasaran', 'waktu_pelaksanaan', 'status_kegiatan', 'sumber_dana', 'DAK', 'created_at', 'updated_at', 'username'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Prog', 'Kd_Keg'], 'integer'],
            [['pagu'], 'number'],
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
        $query = TaUraianKegiatan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'pagu' => $this->pagu,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'lokasi_Kegiatan', $this->lokasi_Kegiatan])
            ->andFilterWhere(['like', 'kelompok_sasaran', $this->kelompok_sasaran])
            ->andFilterWhere(['like', 'waktu_pelaksanaan', $this->waktu_pelaksanaan])
            ->andFilterWhere(['like', 'status_kegiatan', $this->status_kegiatan])
            ->andFilterWhere(['like', 'sumber_dana', $this->sumber_dana])
            ->andFilterWhere(['like', 'DAK', $this->DAK])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
