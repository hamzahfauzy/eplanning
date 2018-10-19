<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaPaguProgram]].
 *
 * @see \backend\models\TaPaguProgram
 */
class TaPaguProgramQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaPaguProgram[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaPaguProgram|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
