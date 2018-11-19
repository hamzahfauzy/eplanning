<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefSsh5;

/**
 * RefSsh5Search represents the model behind the search form about `common\models\RefSsh5`.
 */
class RefSsh5Search extends RefSsh5
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Ssh1', 'Kd_Ssh2', 'Kd_Ssh3', 'Kd_Ssh4', 'Kd_Ssh5'], 'integer'],
            [['Nm_Ssh5'], 'safe'],
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
        $query = RefSsh5::find();

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
            'Kd_Ssh1' => $this->Kd_Ssh1,
            'Kd_Ssh2' => $this->Kd_Ssh2,
            'Kd_Ssh3' => $this->Kd_Ssh3,
            'Kd_Ssh4' => $this->Kd_Ssh4,
            'Kd_Ssh5' => $this->Kd_Ssh5,
        ]);

        $query->andFilterWhere(['like', 'Nm_Ssh5', $this->Nm_Ssh5]);

        return $dataProvider;
    }
}
