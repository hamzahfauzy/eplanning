<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefHspk1]].
 *
 * @see \common\models\RefHspk1
 */
class RefHspk1Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefHspk1[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefHspk1|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
