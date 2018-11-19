<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaTimAnggaran]].
 *
 * @see \backend\models\TaTimAnggaran
 */
class TaTimAnggaranQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaTimAnggaran[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaTimAnggaran|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
