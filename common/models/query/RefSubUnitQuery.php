<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefSubUnit]].
 *
 * @see \common\models\RefSubUnit
 */
class RefSubUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefSubUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefSubUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
