<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaSshHspk]].
 *
 * @see \common\models\TaSshHspk
 */
class TaSshHspkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaSshHspk[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaSshHspk|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
