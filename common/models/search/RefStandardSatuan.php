<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefStandardSatuan as RefStandardSatuanModel;

/**
 * RefStandardSatuan represents the model behind the search form about `common\models\RefStandardSatuan`.
 */
class RefStandardSatuan extends RefStandardSatuanModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Satuan'], 'integer'],
            [['Uraian'], 'safe'],
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
        $query = RefStandardSatuanModel::find();

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
            'Kd_Satuan' => $this->Kd_Satuan,
        ]);

        $query->andFilterWhere(['like', 'Uraian', $this->Uraian]);

        return $dataProvider;
    }
}
