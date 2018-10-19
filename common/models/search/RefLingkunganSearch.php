<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefLingkungan;

/**
 * RefLingkunganSearch represents the model behind the search form about `common\models\RefLingkungan`.
 */
class RefLingkunganSearch extends RefLingkungan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan'], 'integer'],
            [['Nm_Lingkungan'], 'safe'],
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
        $query = RefLingkungan::find();

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
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
            'Kd_Kec' => $this->Kd_Kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_Kel' => $this->Kd_Urut_Kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Lingkungan', $this->Nm_Lingkungan]);

        return $dataProvider;
    }
	
	public function Zulsearch($params, $kec, $kel)
    {
        $query = RefLingkungan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        
		$this->load($params);
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		//$query->andWhere(['Kd_Prov' => '12', 'Kd_Kab' => '71', 'Kd_Kec' => $kec ,'Kd_Urut_Kel' => $kel]);
		
        $query->andFilterWhere([
            'Kd_Prov' => '12',
            'Kd_Kab' => '71',
            'Kd_Kec' => $kec,
            'Kd_Kel' => $this->Kd_Kel,
            'Kd_Urut_Kel' => $kel,
            'Kd_Lingkungan' => $this->Kd_Lingkungan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Lingkungan', $this->Nm_Lingkungan]);

        return $dataProvider;
    }
}
