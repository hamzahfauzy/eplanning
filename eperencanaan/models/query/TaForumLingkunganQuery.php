<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaForumLingkungan]].
 *
 * @see \eperencanaan\models\TaForumLingkungan
 */
class TaForumLingkunganQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaForumLingkungan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaForumLingkungan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
