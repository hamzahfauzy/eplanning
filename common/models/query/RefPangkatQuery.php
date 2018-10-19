<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefPangkat]].
 *
 * @see \common\models\RefPangkat
 */
class RefPangkatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefPangkat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefPangkat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
