<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefBelanjaWajib]].
 *
 * @see \common\models\RefBelanjaWajib
 */
class RefBelanjaWajibQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefBelanjaWajib[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefBelanjaWajib|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
