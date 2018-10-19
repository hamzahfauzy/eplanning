<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaBelanjaRincSubProv]].
 *
 * @see \emusrenbang\models\TaBelanjaRincSubProv
 */
class TaBelanjaRincSubProvQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincSubProv[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincSubProv|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
