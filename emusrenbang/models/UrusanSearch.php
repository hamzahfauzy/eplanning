<?php

namespace emusrenbang\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emusrenbang\models\Urusan;

/**
 * UrusanSearch represents the model behind the search form about `app\models\Urusan`.
 */
class UrusanSearch extends Urusan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'idMisi'], 'integer'],
            [[
                'urusan',
                'namaMisi'
            ], 'safe'],
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
        $query = Urusan::find();
        $query->select(['urusan.*',
            'm.misi namaMisi'
        ]);
            $query->leftJoin('misi m', 'm.id=urusan.idMisi')
        ;

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => false
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
            'idMisi' => $this->idMisi,
        ]);

        $query->andFilterWhere(['like', 'urusan', $this->urusan])
            ->andFilterWhere(['like', 'm.misi', $this->namaMisi])
        ;

        return $dataProvider;
    }
}
