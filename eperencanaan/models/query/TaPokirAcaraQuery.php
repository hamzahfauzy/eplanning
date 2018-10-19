<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaPokirAcara]].
 *
 * @see \eperencanaan\models\TaPokirAcara
 */
class TaPokirAcaraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaPokirAcara[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaPokirAcara|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
