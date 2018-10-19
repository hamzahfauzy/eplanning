<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RefJenisUsulan;

/**
 * RefJenisUsulanSearch represents the model behind the search form about `common\models\RefJenisUsulan`.
 */
class RefJenisUsulanSearch extends RefJenisUsulan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Prog', 'Kd_Keg', 'Kd_Klasifikasi'], 'integer'],
            [['Nm_Jenis_Usulan'], 'safe'],
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
        $query = RefJenisUsulan::find();

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
            'Kd_Urusan' => $this->Kd_Urusan,
            'Kd_Bidang' => $this->Kd_Bidang,
            'Kd_Prog' => $this->Kd_Prog,
            'Kd_Keg' => $this->Kd_Keg,
            'Kd_Klasifikasi' => $this->Kd_Klasifikasi,
        ]);

        $query->andFilterWhere(['like', 'Nm_Jenis_Usulan', $this->Nm_Jenis_Usulan]);

        return $dataProvider;
    }
}
