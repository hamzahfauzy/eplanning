<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaForumLingkunganRiwayat]].
 *
 * @see \eperencanaan\models\TaForumLingkunganRiwayat
 */
class TaForumLingkunganRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaForumLingkunganRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaForumLingkunganRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
