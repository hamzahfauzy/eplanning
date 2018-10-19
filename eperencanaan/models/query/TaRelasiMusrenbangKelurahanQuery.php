<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaRelasiMusrenbangKelurahan]].
 *
 * @see \eperencanaan\models\TaRelasiMusrenbangKelurahan
 */
class TaRelasiMusrenbangKelurahanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaRelasiMusrenbangKelurahan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaRelasiMusrenbangKelurahan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
