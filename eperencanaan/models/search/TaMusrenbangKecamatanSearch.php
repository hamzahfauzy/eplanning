<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\TaMusrenbangKecamatan;

/**
 * TaMusrenbangKecamatanSearch represents the model behind the search form of `eperencanaan\models\TaMusrenbangKecamatan`.
 */
class TaMusrenbangKecamatanSearch extends TaMusrenbangKecamatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Permasalahan', 'Volume'], 'safe'],
            [['Kd_Musrenbang_Kecamatan', 'Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara', 'Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_kel', 'Kd_Lingkungan', 'Kd_Jalan', 'Kd_Usulan', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi', 'Kd_Satuan', 'Kd_Sasaran', 'Kd_Status'], 'integer'],
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
        $query = TaMusrenbangKecamatan::find();

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
            'Tahun' => $this->Tahun,
            'Kd_Musrenbang_Kecamatan' => $this->Kd_Musrenbang_Kecamatan,
            'Kd_Benua' => $this->Kd_Benua,
            'Kd_Benua_Sub' => $this->Kd_Benua_Sub,
            'Kd_Benua_Sub_Negara' => $this->Kd_Benua_Sub_Negara,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_kel' => $this->Kd_Urut_kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
            'Kd_Jalan' => $this->Kd_Jalan,
            'Kd_Usulan' => $this->Kd_Usulan,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Kd_Sasaran' => $this->Kd_Sasaran,
            'Kd_Status' => $this->Kd_Status,
        ]);

        $query->andFilterWhere(['like', 'Nm_Permasalahan', $this->Nm_Permasalahan])
            ->andFilterWhere(['like', 'Volume', $this->Volume]);

        return $dataProvider;
    }
}
