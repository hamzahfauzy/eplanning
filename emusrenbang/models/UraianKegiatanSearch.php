<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\UraianKegiatan;

/**
 * UraianKegiatanSearch represents the model behind the search form about `app\models\UraianKegiatan`.
 */
class UraianKegiatanSearch extends UraianKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'harga', 'jumlah', 'total'], 'integer'],
            [['kode_kegiatan', 'kode_skpd', 'tahun', 'jenis', 'uraian', 'volume', 'satuan', 'keterangan', 'save_status', 'username'], 'safe'],
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
        $query = UraianKegiatan::find();

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
            'harga' => $this->harga,
            'jumlah' => $this->jumlah,
            'total' => $this->total,
        ]);

        $query->andFilterWhere(['like', 'kode_kegiatan', $this->kode_kegiatan])
            ->andFilterWhere(['like', 'kode_skpd', $this->kode_skpd])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'uraian', $this->uraian])
            ->andFilterWhere(['like', 'volume', $this->volume])
            ->andFilterWhere(['like', 'satuan', $this->satuan])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan])
            ->andFilterWhere(['like', 'save_status', $this->save_status])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
