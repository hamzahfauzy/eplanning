<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaProgramApbn]].
 *
 * @see \emusrenbang\models\TaProgramApbn
 */
class TaProgramApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaProgramApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaProgramApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
