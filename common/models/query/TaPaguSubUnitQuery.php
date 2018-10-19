<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaPaguSubUnit]].
 *
 * @see \common\models\TaPaguSubUnit
 */
class TaPaguSubUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaPaguSubUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaPaguSubUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
