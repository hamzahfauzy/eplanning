<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefAnalisaSubA as RefAnalisaSubAModel;

/**
 * RefAnalisaSubA represents the model behind the search form about `common\models\RefAnalisaSubA`.
 */
class RefAnalisaSubA extends RefAnalisaSubAModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Analisa', 'Kd_Analisa_Sub', 'Kd_Analisa_Sub_A'], 'integer'],
            [['Nm_Analisa_Sub_A'], 'safe'],
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
        $query = RefAnalisaSubAModel::find();

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
            'Kd_Analisa_Sub_A' => $this->Kd_Analisa_Sub_A,
        ]);

        $query->andFilterWhere(['like', 'Nm_Analisa_Sub_A', $this->Nm_Analisa_Sub_A]);

        return $dataProvider;
    }
}
