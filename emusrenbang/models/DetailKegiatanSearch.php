<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DetailKegiatan;

/**
 * DetailKegiatanSearch represents the model behind the search form about `app\models\DetailKegiatan`.
 */
class DetailKegiatanSearch extends DetailKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pagu', 'prakiraan_pagu'], 'integer'],
            [['kode_kegiatan', 'tahun', 'lokasi', 'target', 'sumber', 'catatan', 'prakiraan_target', 'username', 'kode_skpd', 'create_at', 'save_status', 'kategori', 'file', 'map'], 'safe'],
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
        $skpd=Yii::$app->user->skpd;
        $query = DetailKegiatan::find()->select('kegiatans.nama_kegiatan, detail_kegiatan.*')
            ->leftJoin('kegiatans', 'kegiatans.id=detail_kegiatan.kode_kegiatan');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $dataProvider->setSort(['attributes' => [
                'tahun',
                'lokasi',
                'target',
                'pagu',
                'nama_kegiatan' => [
                'asc' => ['kegiatans.nama_kegiatan' => SORT_ASC],
                'desc' => ['kegiatans.nama_kegiatan' => SORT_DESC],
                'label' => 'Nama Kegiatan'
            ]
         ]
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
            'create_at' => $this->create_at,
            'kode_skpd' => $skpd,
        ]);

        $query->andFilterWhere(['like', 'kode_kegiatan', $this->kode_kegiatan])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'sumber', $this->sumber])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'prakiraan_target', $this->prakiraan_target])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'kode_skpd', $this->kode_skpd])
            ->andFilterWhere(['like', 'save_status', $this->save_status])
            ->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'file', $this->file])
            ->andFilterWhere(['like', 'map', $this->map])
            ->andFilterWhere(['like', 'nama_kegiatan', $this->nama_kegiatan]);

        return $dataProvider;
    }
}
