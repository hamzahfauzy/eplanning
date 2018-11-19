<?php

namespace eperencanaan\models;

/**
 * This is the ActiveQuery class for [[TaForumLingkunganRiwayat]].
 *
 * @see TaForumLingkunganRiwayat
 */
class TaForumLingkunganRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaForumLingkunganRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaForumLingkunganRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
