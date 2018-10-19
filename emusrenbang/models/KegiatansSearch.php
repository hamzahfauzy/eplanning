<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kegiatans;

/**
 * KegiatansSearch represents the model behind the search form about `app\models\Kegiatans`.
 */
class KegiatansSearch extends Kegiatans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['kode_kegiatan', 'nama_program', 'kode_program', 'nama_kegiatan', 'indikator', 'status', 'aktif', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Kegiatans::find()->select('kegiatans.*, programs.nama_program')->leftJoin('programs', '`programs`.id=kegiatans.kode_program');
        

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'kode_kegiatan', $this->kode_kegiatan])
            ->andFilterWhere(['like', 'kode_program', $this->kode_program])
            ->andFilterWhere(['like', 'nama_kegiatan', $this->nama_kegiatan])
            ->andFilterWhere(['like', 'indikator', $this->indikator])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'programs.nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'aktif', $this->aktif]);

        return $dataProvider;
        
       
    }
}
