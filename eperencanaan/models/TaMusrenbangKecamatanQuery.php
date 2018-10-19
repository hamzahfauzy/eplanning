<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaMusrenbangKecamatan]].
 *
 * @see TaMusrenbangKecamatan
 */
class TaMusrenbangKecamatanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaMusrenbangKecamatan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaMusrenbangKecamatan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
