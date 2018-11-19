<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaKegiatan]].
 *
 * @see TaKegiatan
 */
class TaKegiatanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaKegiatan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaKegiatan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
