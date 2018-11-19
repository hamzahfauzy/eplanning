<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaHargaSatuanPokokKegiatan;

/**
 * TaHargaSatuanPokokKegiatanSearch represents the model behind the search form of `common\models\TaHargaSatuanPokokKegiatan`.
 */
class TaHargaSatuanPokokKegiatanSearch extends TaHargaSatuanPokokKegiatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'safe'],
            [['Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara', 'Kd_Prov', 'Kd_Kab', 'Kd_Klasifikasi', 'Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Kd_Aset4', 'Kd_Aset5', 'Kd_1', 'Kd_2', 'Kd_3', 'Kd_Satuan'], 'integer'],
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
        $query = TaHargaSatuanPokokKegiatan::find();

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
            'Kd_Benua' => $this->Kd_Benua,
            'Kd_Benua_Sub' => $this->Kd_Benua_Sub,
            'Kd_Benua_Sub_Negara' => $this->Kd_Benua_Sub_Negara,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
            'Kd_Aset1' => $this->Kd_Aset1,
            'Kd_Aset2' => $this->Kd_Aset2,
            'Kd_Aset3' => $this->Kd_Aset3,
            'Kd_Aset4' => $this->Kd_Aset4,
            'Kd_Aset5' => $this->Kd_Aset5,
            'Kd_1' => $this->Kd_1,
            'Kd_2' => $this->Kd_2,
            'Kd_3' => $this->Kd_3,
            'Kd_Satuan' => $this->Kd_Satuan,
        ]);

        return $dataProvider;
    }
}
