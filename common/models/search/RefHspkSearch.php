<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefHspk;

/**
 * RefHspkSearch represents the model behind the search form about `common\models\RefHspk`.
 */
class RefHspkSearch extends RefHspk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Hspk1', 'Kd_Hspk2', 'Kd_Hspk3', 'Kd_Hspk4', 'Kd_Satuan'], 'integer'],
            [['Uraian_Kegiatan'], 'safe'],
            [['Harga'], 'number'],
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
        $query = RefHspk::find();

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
            'Kd_Hspk1' => $this->Kd_Hspk1,
            'Kd_Hspk2' => $this->Kd_Hspk2,
            'Kd_Hspk3' => $this->Kd_Hspk3,
            'Kd_Hspk4' => $this->Kd_Hspk4,
            'Kd_Satuan' => $this->Kd_Satuan,
            'Harga' => $this->Harga,
        ]);

        $query->andFilterWhere(['like', 'Uraian_Kegiatan', $this->Uraian_Kegiatan]);

        return $dataProvider;
    }
}
