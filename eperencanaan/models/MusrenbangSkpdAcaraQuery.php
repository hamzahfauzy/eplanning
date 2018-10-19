<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaMusrenbangKecamatanAcara]].
 *
 * @see TaMusrenbangKecamatanAcara
 */
class MusrenbangSkpdAcaraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaMusrenbangKecamatanAcara[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaMusrenbangKecamatanAcara|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
