<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJurnal;

/**
 * RefJurnalSearch represents the model behind the search form about `common\models\RefJurnal`.
 */
class RefJurnalSearch extends RefJurnal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Jurnal'], 'integer'],
            [['Nm_Jurnal'], 'safe'],
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
        $query = RefJurnal::find();

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
            'Kd_Jurnal' => $this->Kd_Jurnal,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jurnal', $this->Nm_Jurnal]);

        return $dataProvider;
    }
}
