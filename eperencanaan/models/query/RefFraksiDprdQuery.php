<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\RefFraksiDprd]].
 *
 * @see \eperencanaan\models\RefFraksiDprd
 */
class RefFraksiDprdQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefFraksiDprd[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\RefFraksiDprd|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
