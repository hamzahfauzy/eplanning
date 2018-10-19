<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaSubUnit;

/**
 * TaSubUnitSearch represents the model behind the search form about `common\models\TaSubUnit`.
 */
class TaSubUnitSearch extends TaSubUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Nm_Pimpinan', 'Nip_Pimpinan', 'Jbt_Pimpinan', 'Alamat', 'Ur_Visi'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
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
        $query = TaSubUnit::find();

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Pimpinan', $this->Nm_Pimpinan])
            ->andFilterWhere(['like', 'Nip_Pimpinan', $this->Nip_Pimpinan])
            ->andFilterWhere(['like', 'Jbt_Pimpinan', $this->Jbt_Pimpinan])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Ur_Visi', $this->Ur_Visi]);

        return $dataProvider;
    }

    public function searchUnit($params)
    {

        $unit = Yii::$app->levelcomponent->getUnit();

        $query = TaSubUnit::find()->where(['Tahun' => date('Y'), 'Kd_Urusan'=>$unit->Kd_Urusan, 'Kd_Bidang'=>$unit->Kd_Bidang, 'Kd_Unit'=>$unit->Kd_Unit, 'Kd_Sub'=>$unit->Kd_Sub_Unit]);

        // $query = TaSubUnit::find()->where([]);

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
        ]);

        $query->andFilterWhere(['like', 'Nm_Pimpinan', $this->Nm_Pimpinan])
            ->andFilterWhere(['like', 'Nip_Pimpinan', $this->Nip_Pimpinan])
            ->andFilterWhere(['like', 'Jbt_Pimpinan', $this->Jbt_Pimpinan])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Ur_Visi', $this->Ur_Visi]);

        return $dataProvider;
    }
}
