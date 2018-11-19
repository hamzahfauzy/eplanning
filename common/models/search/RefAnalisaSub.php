<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAnalisaSub as RefAnalisaSubModel;

/**
 * RefAnalisaSub represents the model behind the search form about `common\models\RefAnalisaSub`.
 */
class RefAnalisaSub extends RefAnalisaSubModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa', 'Kd_Analisa_Sub'], 'integer'],
            [['Nm_Analisa_Sub'], 'safe'],
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
        $query = RefAnalisaSubModel::find();

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
            'Kd_Analisa' => $this->Kd_Analisa,
            'Kd_Analisa_Sub' => $this->Kd_Analisa_Sub,
        ]);

        $query->andFilterWhere(['like', 'Nm_Analisa_Sub', $this->Nm_Analisa_Sub]);

        return $dataProvider;
    }
}
