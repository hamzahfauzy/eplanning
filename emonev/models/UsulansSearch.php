<?php

namespace emonev\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emonev\models\Usulans;

/**
 * UsulansSearch represents the model behind the search form about `app\models\Usulans`.
 */
class UsulansSearch extends Usulans
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_program', 'id_satuan', 'id_skpd', 'id_kegiatan', 'jenis', 'harga', 'id_user'], 'integer'],
            [['indikator', 'target', 'keterangan', 'date', 'time', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = Usulans::find();

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
            'id_program' => $this->id_program,
            'id_satuan' => $this->id_satuan,
            'id_skpd' => $this->id_skpd,
            'id_kegiatan' => $this->id_kegiatan,
            'jenis' => $this->jenis,
            'harga' => $this->harga,
            'id_user' => $this->id_user,
            'date' => $this->date,
            'time' => $this->time,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'indikator', $this->indikator])
            ->andFilterWhere(['like', 'target', $this->target])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
