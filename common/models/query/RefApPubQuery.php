<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefApPub]].
 *
 * @see \common\models\RefApPub
 */
class RefApPubQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefApPub[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefApPub|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
