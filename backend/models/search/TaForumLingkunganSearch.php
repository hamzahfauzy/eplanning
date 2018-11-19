<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaForumLingkungan;

/**
 * TaForumLingkunganSearch represents the model behind the search form about `backend\models\TaForumLingkungan`.
 */
class TaForumLingkunganSearch extends TaForumLingkungan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Forum_Lingkungan', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Program', 'Kd_Kegiatan', 'Kd_Klasifikasi', 'Kd_Jenis_Usulan', 'Kd_Satuan'], 'integer'],
            [['Nm_Permasalahan', 'Volume'], 'safe'],
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
        $query = TaForumLingkungan::find();

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
            'Kd_Forum_Lingkungan' => $this->Kd_Forum_Lingkungan,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub_Unit' => $this->Kd_Sub_Unit,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
            'Kd_Program' => $this->Kd_Program,
            'Kd_Kegiatan' => $this->Kd_Kegiatan,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Kd_Jenis_Usulan' => $this->Kd_Jenis_Usulan,
            'Kd_Satuan' => $this->Kd_Satuan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Volume', $this->Volume]);

        return $dataProvider;
    }
}
