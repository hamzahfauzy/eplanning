<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefSsh2]].
 *
 * @see \common\models\RefSsh2
 */
class RefSsh2Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefSsh2[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefSsh2|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
