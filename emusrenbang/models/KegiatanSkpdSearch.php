<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KegiatanSkpd;

/**
 * KegiatanSkpdSearch represents the model behind the search form about `app\models\KegiatanSkpd`.
 */
class KegiatanSkpdSearch extends KegiatanSkpd
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tahun', 'Kd_Unit', 'Kd_Kegiatan', 'created_at', 'updated_at', 'username'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Program'], 'integer'],
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
        $query = KegiatanSkpd::find();

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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'Kd_Unit', $this->Kd_Unit])
            ->andFilterWhere(['like', 'Kd_Kegiatan', $this->Kd_Kegiatan])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
