<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\TaBelanjaLanjutan]].
 *
 * @see \backend\models\TaBelanjaLanjutan
 */
class TaBelanjaLanjutanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \backend\models\TaBelanjaLanjutan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \backend\models\TaBelanjaLanjutan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
