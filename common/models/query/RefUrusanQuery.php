<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefUrusan]].
 *
 * @see \common\models\RefUrusan
 */
class RefUrusanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefUrusan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefUrusan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
