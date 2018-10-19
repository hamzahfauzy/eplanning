<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaUsulanKelurahanMedia]].
 *
 * @see \eperencanaan\models\TaUsulanKelurahanMedia
 */
class TaUsulanKelurahanMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaUsulanKelurahanMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaUsulanKelurahanMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
