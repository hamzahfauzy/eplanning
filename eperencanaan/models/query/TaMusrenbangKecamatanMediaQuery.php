<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaMusrenbangKecamatanMedia]].
 *
 * @see \eperencanaan\models\TaMusrenbangKecamatanMedia
 */
class TaMusrenbangKecamatanMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaMusrenbangKecamatanMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaMusrenbangKecamatanMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
