<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaIndikatorArsip]].
 *
 * @see \backend\models\TaIndikatorArsip
 */
class TaIndikatorArsipQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaIndikatorArsip[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaIndikatorArsip|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
