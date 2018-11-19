<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJenisSPM as RefJenisSPMModel;

/**
 * RefJenisSPM represents the model behind the search form about `common\models\RefJenisSPM`.
 */
class RefJenisSPM extends RefJenisSPMModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Jn_SPM'], 'integer'],
            [['Nm_Jn_SPM'], 'safe'],
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
        $query = RefJenisSPMModel::find();

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
            'Jn_SPM' => $this->Jn_SPM,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jn_SPM', $this->Nm_Jn_SPM]);

        return $dataProvider;
    }
}
