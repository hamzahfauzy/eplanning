<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaProfile;

/**
 * TaProfileSearch represents the model behind the search form of `common\models\TaProfile`.
 */
class TaProfileSearch extends TaProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User'], 'integer'],
            [['Nm_Lengkap', 'Tgl_Lahir', 'Alamat', 'Telp', 'Mobile', 'Foto'], 'safe'],
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
        $query = TaProfile::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Kd_User' => $this->Kd_User,
            'Tgl_Lahir' => $this->Tgl_Lahir,
        ]);

        $query->andFilterWhere(['like', 'Nm_Lengkap', $this->Nm_Lengkap])
            ->andFilterWhere(['like', 'Alamat', $this->Alamat])
            ->andFilterWhere(['like', 'Telp', $this->Telp])
            ->andFilterWhere(['like', 'Mobile', $this->Mobile])
            ->andFilterWhere(['like', 'Foto', $this->Foto]);

        return $dataProvider;
    }
}
