<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefSsh5]].
 *
 * @see \common\models\RefSsh5
 */
class RefSsh5Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefSsh5[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefSsh5|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
