<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaBelanjaRincProv]].
 *
 * @see \emusrenbang\models\TaBelanjaRincProv
 */
class TaBelanjaRincApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincProv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincProv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
