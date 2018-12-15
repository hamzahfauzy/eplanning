<?php

namespace emonev\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\RefUrusanApbn]].
 *
 * @see \emusrenbang\models\RefUrusanApbn
 */
class RefUrusanApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\RefUrusanApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\RefUrusanApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
