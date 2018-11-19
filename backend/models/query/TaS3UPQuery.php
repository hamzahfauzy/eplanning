<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaS3UP]].
 *
 * @see \backend\models\TaS3UP
 */
class TaS3UPQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaS3UP[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaS3UP|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
