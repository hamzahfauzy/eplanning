<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaUraianKegiatan]].
 *
 * @see \backend\models\TaUraianKegiatan
 */
class TaUraianKegiatanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaUraianKegiatan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaUraianKegiatan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
