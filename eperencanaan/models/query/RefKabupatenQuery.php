<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\RefKabupaten]].
 *
 * @see \eperencanaan\models\RefKabupaten
 */
class RefKabupatenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefKabupaten[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefKabupaten|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
