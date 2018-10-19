<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\userlevel\models\TaUserDapil]].
 *
 * @see \userlevel\models\TaUserDapil
 */
class TaDapilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \userlevel\models\TaUserDapil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \userlevel\models\TaUserDapil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
