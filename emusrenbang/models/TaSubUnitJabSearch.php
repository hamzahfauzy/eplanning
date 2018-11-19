<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\TaSubUnitJab;

/**
 * TaSubUnitJabSearch represents the model behind the search form about `app\models\TaSubUnitJab`.
 */
class TaSubUnitJabSearch extends TaSubUnitJab
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Jab', 'No_Urut'], 'integer'],
            [['Nama', 'Nip', 'Jabatan'], 'safe'],
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
        $query = TaSubUnitJab::find();

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

        if(Yii::$app->user->identity->id_level!==1){
            $identity=Yii::$app->user->identity;
            $this->Kd_Urusan=$identity->id_urusan;
            $this->Kd_Bidang=$identity->id_bidang;
            $this->Kd_Unit=$identity->id_skpd;
            $this->Kd_Sub=$identity->id_subunit;
        }
        if(!isset($this->Tahun) or $this->Tahun==''){
            $this->Tahun= ( date('Y') + 1 );
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'Kd_Jab' => $this->Kd_Jab,
            'No_Urut' => $this->No_Urut,
        ]);

        $query->andFilterWhere(['like', 'Nama', $this->Nama])
            ->andFilterWhere(['like', 'Nip', $this->Nip])
            ->andFilterWhere(['like', 'Jabatan', $this->Jabatan]);

        return $dataProvider;
    }
}
