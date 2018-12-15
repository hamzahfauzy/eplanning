<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MenuAssignmentLevel;

/**
 * MenuAssignmentLevelSearch represents the model behind the search form about `app\models\MenuAssignmentLevel`.
 */
class MenuAssignmentLevelSearch extends MenuAssignmentLevel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level'], 'safe'],
            [['id_menu'], 'integer'],
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
        $query = MenuAssignmentLevel::find();
        
        $query->select(['levels.id as level', 'levels.level as NmLevel']);
        $query->leftJoin('levels', 'levels.id=menu_assignment_level.level');
        	//->leftJoin('menu', 'menu.id=menu_assignment_level.

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
            'id_menu' => $this->id_menu,
        ]);

        $query->andFilterWhere(['like', 'level', $this->level]);

        return $dataProvider;
    }
}
