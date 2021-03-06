<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use emonev\models\TaTupok;

/**
 * TaTupokSearch represents the model behind the search form about `app\models\TaTupok`.
 */
class TaTupokSearch extends TaTupok
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'No_Tupok'], 'integer'],
            [['Ur_Tupok'], 'safe'],
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
        $query = TaTupok::find();

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
        $identity=Yii::$app->user->identity;
        if($identity){
            $this->Kd_Urusan=$identity->id_urusan;
            $this->Kd_Bidang=$identity->id_bidang;
            $this->Kd_Unit=$identity->id_skpd;
            $this->Kd_Sub=$identity->id_subunit;
        }

        if(!isset($this->Tahun) or $this->Tahun==''){
            $this->Tahun= ( date('Y') + 1 );
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Tahun' => $this->Tahun,
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Unit' => $this->Kd_Unit,
            'Kd_Sub' => $this->Kd_Sub,
            'No_Tupok' => $this->No_Tupok,
        ]);

        $query->andFilterWhere(['like', 'Ur_Tupok', $this->Ur_Tupok]);

        return $dataProvider;
    }
}
