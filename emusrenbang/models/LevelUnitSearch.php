<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LevelUnit;

/**
 * LevelUnitSearch represents the model behind the search form about `app\models\LevelUnit`.
 */
class LevelUnitSearch extends LevelUnit
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub'], 'integer'],
            [['username', 'Nm_Urusan', 'Nm_Bidang', 'Nm_Unit', 'Nm_Sub_Unit'], 'safe'],
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
        $query = LevelUnit::find();
        $query->select(['level_unit.*', 'Ref_Urusan.Nm_Urusan', 'Ref_Bidang.Nm_Bidang', 'Ref_Unit.Nm_Unit', 'Ref_Sub_Unit.Nm_Sub_Unit']);
        $query->leftJoin('Ref_Urusan' ,'Ref_Urusan.Kd_Urusan=level_unit.Kd_Urusan')
            ->leftJoin('Ref_Bidang', 'Ref_Bidang.Kd_Urusan=level_unit.Kd_Urusan and Ref_Bidang.Kd_Bidang=level_unit.Kd_Bidang')
            ->leftJoin('Ref_Unit', 'Ref_Unit.Kd_Urusan=level_unit.Kd_Urusan and Ref_Unit.Kd_Bidang=level_unit.Kd_Bidang and Ref_Unit.Kd_Unit=level_unit.Kd_Unit')
            ->leftJoin('Ref_Sub_Unit', 'Ref_Sub_Unit.Kd_Urusan=level_unit.Kd_Urusan and Ref_Sub_Unit.Kd_Bidang=level_unit.Kd_Bidang and
             Ref_Sub_Unit.Kd_Unit=level_unit.Kd_Unit and Ref_Sub_Unit.Kd_Sub=level_unit.Kd_Sub')
            ;

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
            'id' => $this->id,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'Nm_Urusan', $this->Nm_Urusan])
            ->andFilterWhere(['like', 'Nm_Bidang', $this->Nm_Bidang])
            ->andFilterWhere(['like', 'Nm_Unit', $this->Nm_Unit])
            ->andFilterWhere(['like', 'Nm_Sub_Unit', $this->Nm_Sub_Unit])
            ;

        return $dataProvider;
    }
}
