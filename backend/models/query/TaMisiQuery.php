<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaMisi]].
 *
 * @see \backend\models\TaMisi
 */
class TaMisiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaMisi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaMisi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
