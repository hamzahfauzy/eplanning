<?php

namespace eperencanaan\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use eperencanaan\models\MusrenbangSkpdMedia;

/**
 * TaMusrenbangKelurahanMediaSearch represents the model behind the search form of `eperencanaan\models\TaMusrenbangKelurahanMedia`.
 */
class MusrenbangSkpdMediaSearch extends MusrenbangSkpdMedia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Jenis_Dokumen'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub_Unit', 'Kd_Media'], 'integer'],
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
        $query = MusrenbangSkpdMedia::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub_Unit' => $this->Kd_Sub_Unit,
            'Kd_Media' => $this->Kd_Media,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Dokumen', $this->Jenis_Dokumen]);

        return $dataProvider;
    }
	
	public function SAMsearch($params, $data)
    {
        $query = MusrenbangSkpdMedia::find();

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
        $query->andWhere($data);
        // grid filtering conditions
        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub_Unit' => $this->Kd_Sub_Unit,
            'Kd_Media' => $this->Kd_Media,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Dokumen', $this->Jenis_Dokumen]);

        return $dataProvider;
    }
	
	public function ZULsearch($params, $data)
    {
        $query = MusrenbangSkpdMedia::find();

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
		$query->andWhere($data);
        // grid filtering conditions
        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub_Unit' => $this->Kd_Sub_Unit,
            'Kd_Media' => $this->Kd_Media,
        ]);

        $query->andFilterWhere(['like', 'Jenis_Dokumen', $this->Jenis_Dokumen]);

        return $dataProvider;
    }
}
