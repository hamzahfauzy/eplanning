<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaHargaSatuanPokokKegiatan]].
 *
 * @see \common\models\TaHargaSatuanPokokKegiatan
 */
class TaHargaSatuanPokokKegiatanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaHargaSatuanPokokKegiatan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaHargaSatuanPokokKegiatan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
