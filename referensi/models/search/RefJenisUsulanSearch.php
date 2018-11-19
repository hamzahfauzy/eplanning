<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJenisUsulan;

/**
 * RefJenisUsulanSearch represents the model behind the search form about `common\models\RefJenisUsulan`.
 */
class RefJenisUsulanSearch extends RefJenisUsulan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Program', 'Kd_Kegiatan', 'Kd_Klasifikasi', 'Kd_Jenis_Usulan'], 'integer'],
            [['Nm_Jenis_Usulan'], 'safe'],
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
        $query = RefJenisUsulan::find();

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
            'Kd_Program' => $this->Kd_Program,
            'Kd_Kegiatan' => $this->Kd_Kegiatan,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Kd_Jenis_Usulan' => $this->Kd_Jenis_Usulan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jenis_Usulan', $this->Nm_Jenis_Usulan]);

        return $dataProvider;
    }
}
