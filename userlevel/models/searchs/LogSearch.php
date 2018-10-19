<?php

namespace userlevel\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Log as LogModel;

/**
 * User represents the model behind the search form about `mdm\admin\models\User`.
 */
class LogSearch extends LogModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Kd_User'], 'integer'],
            [['created_at'], 'safe'],
            [['pesan', 'id_tabel'], 'string'],
            [['username', 'controller', 'action', 'ip', 'kegiatan', 'tabel'], 'string', 'max' => 100],
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
        $user_id = $params['user_id'];
        $query = LogModel::find()->where(['Kd_User' => $user_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $this->load($params);
        if (!$this->validate()) {
            // $query->where('1=0');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'username' => $this->username,
            'kegiatan' => $this->kegiatan,
        ]);

        $query->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }
}
