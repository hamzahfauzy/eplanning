<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\RefLingkungan]].
 *
 * @see \eperencanaan\models\RefLingkungan
 */
class RefLingkunganQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefLingkungan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefLingkungan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
