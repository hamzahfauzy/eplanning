<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaPaguUnit]].
 *
 * @see \common\models\TaPaguUnit
 */
class TaPaguUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaPaguUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaPaguUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
