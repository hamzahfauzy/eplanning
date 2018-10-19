<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefKomisiDprd]].
 *
 * @see \common\models\RefKomisiDprd
 */
class RefKomisiDprdQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefKomisiDprd[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefKomisiDprd|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
