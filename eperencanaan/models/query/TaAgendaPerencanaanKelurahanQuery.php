<?php

namespace eperencanaan\models\query;

/**
 * This is the ActiveQuery class for [[\eperencanaan\models\TaAgendaPerencanaanKelurahan]].
 *
 * @see \eperencanaan\models\TaAgendaPerencanaanKelurahan
 */
class TaAgendaPerencanaanKelurahanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaAgendaPerencanaanKelurahan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \eperencanaan\models\TaAgendaPerencanaanKelurahan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
