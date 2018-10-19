<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJalan as RefJalanModel;

/**
 * RefJalan represents the model behind the search form about `common\models\RefJalan`.
 */
class RefJalan extends RefJalanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Prov', 'Kd_Kab', 'Kd_Kec', 'Kd_Kel', 'Kd_Urut_Kel', 'Kd_Lingkungan', 'Kd_Jalan'], 'integer'],
            [['Nm_Jalan'], 'safe'],
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
        $query = RefJalanModel::find();

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
            'Kd_Jalan' => $this->Kd_Jalan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jalan', $this->Nm_Jalan]);

        return $dataProvider;
    }
}
