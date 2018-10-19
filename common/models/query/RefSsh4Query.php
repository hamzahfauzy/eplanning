<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefSsh4]].
 *
 * @see \common\models\RefSsh4
 */
class RefSsh4Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefSsh4[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefSsh4|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
