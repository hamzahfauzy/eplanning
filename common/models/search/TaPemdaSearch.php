<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaPemda;

/**
 * TaPemdaSearch represents the model behind the search form of `common\models\TaPemda`.
 */
class TaPemdaSearch extends TaPemda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Pemda', 'Nm_PimpDaerah', 'Jab_PimpDaerah', 'Nm_Sekda', 'Nip_Sekda', 'Jbt_Sekda', 'Nm_Ka_Keu', 'Nip_Ka_Keu', 'Jbt_Ka_Keu', 'Nm_Ka_Anggaran', 'Nip_Ka_Anggaran', 'Jbt_Ka_Anggaran', 'Nm_Ka_Verifikasi', 'Nip_Ka_Verifikasi', 'Jbt_Ka_Verifikasi', 'Nm_Ka_Perbendaharaan', 'Nip_Ka_Perbendaharaan', 'Jbt_Ka_Perbendaharaan', 'Nm_Ka_BUD', 'Nip_Ka_BUD', 'Jbt_Ka_BUD', 'NPWP_BUD', 'K1', 'K2', 'K3', 'K4', 'Nm_Ka_Pembukuan', 'Nip_Ka_Pembukuan', 'Jbt_Ka_Pembukuan', 'Nm_Atasan_BUD', 'Nip_Atasan_BUD', 'Jbt_Atasan_BUD', 'Ibukota', 'Alamat', 'Logo'], 'safe'],
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
        $query = TaPemda::find();

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Pemda', $this->Nm_Pemda])
            ->andFilterWhere(['like', 'Nm_PimpDaerah', $this->Nm_PimpDaerah])
            ->andFilterWhere(['like', 'Jab_PimpDaerah', $this->Jab_PimpDaerah])
            ->andFilterWhere(['like', 'Nm_Sekda', $this->Nm_Sekda])
            ->andFilterWhere(['like', 'Nip_Sekda', $this->Nip_Sekda])
            ->andFilterWhere(['like', 'Jbt_Sekda', $this->Jbt_Sekda])
            ->andFilterWhere(['like', 'Nm_Ka_Keu', $this->Nm_Ka_Keu])
            ->andFilterWhere(['like', 'Nip_Ka_Keu', $this->Nip_Ka_Keu])
            ->andFilterWhere(['like', 'Jbt_Ka_Keu', $this->Jbt_Ka_Keu])
            ->andFilterWhere(['like', 'Nm_Ka_Anggaran', $this->Nm_Ka_Anggaran])
            ->andFilterWhere(['like', 'Nip_Ka_Anggaran', $this->Nip_Ka_Anggaran])
            ->andFilterWhere(['like', 'Jbt_Ka_Anggaran', $this->Jbt_Ka_Anggaran])
            ->andFilterWhere(['like', 'Nm_Ka_Verifikasi', $this->Nm_Ka_Verifikasi])
            ->andFilterWhere(['like', 'Nip_Ka_Verifikasi', $this->Nip_Ka_Verifikasi])
            ->andFilterWhere(['like', 'Jbt_Ka_Verifikasi', $this->Jbt_Ka_Verifikasi])
            ->andFilterWhere(['like', 'Nm_Ka_Perbendaharaan', $this->Nm_Ka_Perbendaharaan])
            ->andFilterWhere(['like', 'Nip_Ka_Perbendaharaan', $this->Nip_Ka_Perbendaharaan])
            ->andFilterWhere(['like', 'Jbt_Ka_Perbendaharaan', $this->Jbt_Ka_Perbendaharaan])
            ->andFilterWhere(['like', 'Nm_Ka_BUD', $this->Nm_Ka_BUD])
            ->andFilterWhere(['like', 'Nip_Ka_BUD', $this->Nip_Ka_BUD])
            ->andFilterWhere(['like', 'Jbt_Ka_BUD', $this->Jbt_Ka_BUD])
            ->andFilterWhere(['like', 'NPWP_BUD', $this->NPWP_BUD])
            ->andFilterWhere(['like', 'K1', $this->K1])
            ->andFilterWhere(['like', 'K2', $this->K2])
            ->andFilterWhere(['like', 'K3', $this->K3])
            ->andFilterWhere(['like', 'K4', $this->K4])
            ->andFilterWhere(['like', 'Nm_Ka_Pembukuan', $this->Nm_Ka_Pembukuan])
            ->andFilterWhere(['like', 'Nip_Ka_Pembukuan', $this->Nip_Ka_Pembukuan])
            ->andFilterWhere(['like', 'Jbt_Ka_Pembukuan', $this->Jbt_Ka_Pembukuan])
            ->andFilterWhere(['like', 'Nm_Atasan_BUD', $this->Nm_Atasan_BUD])
            ->andFilterWhere(['like', 'Nip_Atasan_BUD', $this->Nip_Atasan_BUD])
            ->andFilterWhere(['like', 'Jbt_Atasan_BUD', $this->Jbt_Atasan_BUD])
            ->andFilterWhere(['like', 'Ibukota', $this->Ibukota])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Logo', $this->Logo]);

        return $dataProvider;
    }
}
