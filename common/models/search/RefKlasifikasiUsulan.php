<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKlasifikasiUsulan as RefKlasifikasiUsulanModel;

/**
 * RefKlasifikasiUsulan represents the model behind the search form about `common\models\RefKlasifikasiUsulan`.
 */
class RefKlasifikasiUsulan extends RefKlasifikasiUsulanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Klasifikasi'], 'integer'],
            [['Nm_Klasifikasi'], 'safe'],
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
        $query = RefKlasifikasiUsulanModel::find();

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
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
        ]);

        $query->andFilterWhere(['like', 'Nm_Klasifikasi', $this->Nm_Klasifikasi]);

        return $dataProvider;
    }
}
