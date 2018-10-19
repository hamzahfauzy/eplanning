<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaSasaran]].
 *
 * @see TaSasaran
 */
class TaSasaranQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaSasaran[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaSasaran|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
