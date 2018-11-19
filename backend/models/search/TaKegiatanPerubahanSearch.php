<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaKegiatanPerubahan;

/**
 * TaKegiatanPerubahanSearch represents the model behind the search form about `backend\models\TaKegiatanPerubahan`.
 */
class TaKegiatanPerubahanSearch extends TaKegiatanPerubahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg'], 'integer'],
            [['Keterangan', 'Keterangan_1', 'Keterangan_31', 'Keterangan_32'], 'safe'],
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
        $query = TaKegiatanPerubahan::find();

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
            'Kd_Prog' => $this->Kd_Prog,
            'ID_Prog' => $this->ID_Prog,
            'Kd_Keg' => $this->Kd_Keg,
        ]);

        $query->andFilterWhere(['like', 'Keterangan', $this->Keterangan])
            ->andFilterWhere(['like', 'Keterangan_1', $this->Keterangan_1])
            ->andFilterWhere(['like', 'Keterangan_31', $this->Keterangan_31])
            ->andFilterWhere(['like', 'Keterangan_32', $this->Keterangan_32]);

        return $dataProvider;
    }
}
