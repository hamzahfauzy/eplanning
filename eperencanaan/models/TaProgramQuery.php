<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaProgram]].
 *
 * @see TaProgram
 */
class TaProgramQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaProgram[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaProgram|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
