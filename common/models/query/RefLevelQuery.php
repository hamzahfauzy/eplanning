<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefLevel]].
 *
 * @see \common\models\RefLevel
 */
class RefLevelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefLevel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefLevel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
