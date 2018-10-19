<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefEntry as RefEntryModel;

/**
 * RefEntry represents the model behind the search form about `common\models\RefEntry`.
 */
class RefEntry extends RefEntryModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Penandatangan'], 'integer'],
            [['Nm_Penandatangan', 'Nip_Penandatangan', 'Jbt_Penandatangan', 'Jns_Dokumen'], 'safe'],
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
        $query = RefEntryModel::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Penandatangan' => $this->Kd_Penandatangan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Penandatangan', $this->Nm_Penandatangan])
            ->andFilterWhere(['like', 'Nip_Penandatangan', $this->Nip_Penandatangan])
            ->andFilterWhere(['like', 'Jbt_Penandatangan', $this->Jbt_Penandatangan])
            ->andFilterWhere(['like', 'Jns_Dokumen', $this->Jns_Dokumen]);

        return $dataProvider;
    }
}
