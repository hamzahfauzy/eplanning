<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\RefUnitApbn]].
 *
 * @see \emusrenbang\models\RefUnitApbn
 */
class RefUnitApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\RefUnitApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\RefUnitApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
