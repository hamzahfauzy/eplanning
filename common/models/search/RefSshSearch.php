<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSsh;

/**
 * RefSshSearch represents the model behind the search form about `common\models\RefSsh`.
 */
class RefSshSearch extends RefSsh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5', 'Kd_Ssh6', 'Kd_Satuan'], 'integer'],
            [['Nama_Barang'], 'safe'],
            [['Harga_Satuan'], 'number'],
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
        $query = RefSsh::find();

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
            'Kd_Ssh1' => $this->Kd_Ssh1,
            'Kd_Ssh2' => $this->Kd_Ssh2,
            'Kd_Ssh3' => $this->Kd_Ssh3,
            'Kd_Ssh4' => $this->Kd_Ssh4,
            'Kd_Ssh5' => $this->Kd_Ssh5,
            'Kd_Ssh6' => $this->Kd_Ssh6,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga_Satuan' => $this->Harga_Satuan,
        ]);

        $query->andFilterWhere(['like', 'Nama_Barang', $this->Nama_Barang]);

        return $dataProvider;
    }
}
