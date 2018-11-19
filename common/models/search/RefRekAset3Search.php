<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefRekAset3;

/**
 * RefRekAset3Search represents the model behind the search form about `common\models\RefRekAset3`.
 */
class RefRekAset3Search extends RefRekAset3
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3'], 'integer'],
            [['Nm_Aset3'], 'safe'],
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
        $query = RefRekAset3::find();

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
            'Kd_Aset1' => $this->Kd_Aset1,
            'Kd_Aset2' => $this->Kd_Aset2,
            'Kd_Aset3' => $this->Kd_Aset3,
        ]);

        $query->andFilterWhere(['like', 'Nm_Aset3', $this->Nm_Aset3]);

        return $dataProvider;
    }
}
