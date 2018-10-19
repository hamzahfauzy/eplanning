<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJabatanStruktural as RefJabatanStrukturalModel;

/**
 * RefJabatanStruktural represents the model behind the search form about `common\models\RefJabatanStruktural`.
 */
class RefJabatanStruktural extends RefJabatanStrukturalModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Eselon', 'Kd_Jabatan'], 'integer'],
            [['Nm_Jabatan'], 'safe'],
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
        $query = RefJabatanStrukturalModel::find();

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
            'Kd_Eselon' => $this->Kd_Eselon,
            'Kd_Jabatan' => $this->Kd_Jabatan,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jabatan', $this->Nm_Jabatan]);

        return $dataProvider;
    }
}
