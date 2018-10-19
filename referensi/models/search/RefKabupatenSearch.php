<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefKabupaten;

/**
 * RefKabupatenSearch represents the model behind the search form about `common\models\RefKabupaten`.
 */
class RefKabupatenSearch extends RefKabupaten
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Benua', 'Kd_Benua_Sub', 'Kd_Benua_Sub_Negara', 'Kd_Prov', 'Kd_Kab'], 'integer'],
            [['Nm_Kab'], 'safe'],
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
        $query = RefKabupaten::find();

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
            'Kd_Benua' => $this->Kd_Benua,
            'Kd_Benua_Sub' => $this->Kd_Benua_Sub,
            'Kd_Benua_Sub_Negara' => $this->Kd_Benua_Sub_Negara,
            'Kd_Prov' => $this->Kd_Prov,
            'Kd_Kab' => $this->Kd_Kab,
        ]);

        $query->andFilterWhere(['like', 'Nm_Kab', $this->Nm_Kab]);

        return $dataProvider;
    }
}
