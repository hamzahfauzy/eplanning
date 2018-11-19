<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSetting as RefSettingModel;

/**
 * RefSetting represents the model behind the search form about `common\models\RefSetting`.
 */
class RefSetting extends RefSettingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Pembayaran'], 'integer'],
            [['SistemKuitansi', 'StandardHarga', 'Kontrol_Angg_SPD', 'Kontrol_SPD_SPP', 'Kontrol_SPP_SPM', 'LastDBAplVer', 'PFK', 'SP2DFormat', 'Prognosis'], 'safe'],
            [['Locked', 'DefaultPaper', 'SPDKegiatan', 'Peny_SPJ', 'SP2DPre', 'KunciPagu', 'Akrual'], 'boolean'],
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
        $query = RefSettingModel::find();

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
            'Tahun' => $this->Tahun,
            'Locked' => $this->Locked,
            'DefaultPaper' => $this->DefaultPaper,
            'SPDKegiatan' => $this->SPDKegiatan,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Pembayaran' => $this->Kd_Pembayaran,
            'Peny_SPJ' => $this->Peny_SPJ,
            'SP2DPre' => $this->SP2DPre,
            'KunciPagu' => $this->KunciPagu,
            'Akrual' => $this->Akrual,
        ]);

        $query->andFilterWhere(['like', 'SistemKuitansi', $this->SistemKuitansi])
            ->andFilterWhere(['like', 'StandardHarga', $this->StandardHarga])
            ->andFilterWhere(['like', 'Kontrol_Angg_SPD', $this->Kontrol_Angg_SPD])
            ->andFilterWhere(['like', 'Kontrol_SPD_SPP', $this->Kontrol_SPD_SPP])
            ->andFilterWhere(['like', 'Kontrol_SPP_SPM', $this->Kontrol_SPP_SPM])
            ->andFilterWhere(['like', 'LastDBAplVer', $this->LastDBAplVer])
            ->andFilterWhere(['like', 'PFK', $this->PFK])
            ->andFilterWhere(['like', 'SP2DFormat', $this->SP2DFormat])
            ->andFilterWhere(['like', 'Prognosis', $this->Prognosis]);

        return $dataProvider;
    }
}
