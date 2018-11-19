<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaLingkunganPaguIndikatif]].
 *
 * @see \eperencanaan\models\TaLingkunganPaguIndikatif
 */
class TaLingkunganPaguIndikatifQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaLingkunganPaguIndikatif[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaLingkunganPaguIndikatif|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
