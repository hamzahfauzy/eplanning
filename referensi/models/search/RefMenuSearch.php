<?php

namespace referensi\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefMenu;

/**
 * RefMenuSearch represents the model behind the search form about `common\models\RefMenu`.
 */
class RefMenuSearch extends RefMenu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun'], 'integer'],
            [['User_ID', 'ID_Menu', 'Otoritas'], 'safe'],
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
        $query = RefMenu::find();

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
            'Tahun' => $this->Tahun,
        ]);

        $query->andFilterWhere(['like', 'User_ID', $this->User_ID])
            ->andFilterWhere(['like', 'ID_Menu', $this->ID_Menu])
            ->andFilterWhere(['like', 'Otoritas', $this->Otoritas]);

        return $dataProvider;
    }
}
