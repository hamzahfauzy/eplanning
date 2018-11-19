<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefRekAset5;

/**
 * RefRekAset5Search represents the model behind the search form about `common\models\RefRekAset5`.
 */
class RefRekAset5Search extends RefRekAset5
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Aset1', 'Kd_Aset2', 'Kd_Aset3', 'Kd_Aset4', 'Kd_Aset5'], 'integer'],
            [['Nm_Aset5'], 'safe'],
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
        $query = RefRekAset5::find();

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
            'Kd_Aset4' => $this->Kd_Aset4,
            'Kd_Aset5' => $this->Kd_Aset5,
        ]);

        $query->andFilterWhere(['like', 'Nm_Aset5', $this->Nm_Aset5]);

        return $dataProvider;
    }
}
