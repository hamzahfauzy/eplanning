<?php

namespace emonev\models;

use Yii;
use common\models\RefSumberDana;
use common\models\RefApPub;
use common\models\RefRek5;
use common\models\RefRek4;
use common\models\RefRek3;
use common\models\RefRek2;
use common\models\RefRek1;
/**
 * This is the model class for table "Ta_Belanja".
 *
 * @property string $Tahun
 * @property int $Kd_Urusan
 * @property int $Kd_Bidang
 * @property int $Kd_Unit
 * @property int $Kd_Sub
 * @property int $Kd_Prog
 * @property int $ID_Prog
 * @property int $Kd_Keg
 * @property int $Kd_Rek_1
 * @property int $Kd_Rek_2
 * @property int $Kd_Rek_3
 * @property int $Kd_Rek_4
 * @property int $Kd_Rek_5
 * @property int $Kd_Ap_Pub
 * @property int $Kd_Sumber
 *
 * @property TaKegiatan $tahun
 * @property RefSumberDana $kdSumber
 * @property RefApPub $kdApPub
 * @property TaBelanjaHistory $taBelanjaHistory
 * @property TaBelanjaRinc[] $taBelanjaRincs
 */
class TaBelanjaRancanganAkhir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Rancangan_Akhir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'Kd_Ap_Pub', 'Kd_Sumber'], 'integer'],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg'], 'exist', 'skipOnError' => true, 'targetClass' => TaKegiatan::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']],
            [['Kd_Sumber'], 'exist', 'skipOnError' => true, 'targetClass' => RefSumberDana::className(), 'targetAttribute' => ['Kd_Sumber' => 'Kd_Sumber']],
            [['Kd_Ap_Pub'], 'exist', 'skipOnError' => true, 'targetClass' => RefApPub::className(), 'targetAttribute' => ['Kd_Ap_Pub' => 'Kd_Ap_Pub']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Urusan',
            'Kd_Bidang' => 'Bidang',
            'Kd_Unit' => 'Unit',
            'Kd_Sub' => 'Sub Unit',
            'Kd_Prog' => 'Program',
            'ID_Prog' => 'Id  Program',
            'Kd_Keg' => 'Kode Kegiatan',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'Kd_Ap_Pub' => 'Aparatur/Publik',
            'Kd_Sumber' => 'Sumber Dana',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(\common\models\RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getBidang()
    {
        return $this->hasOne(\common\models\RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getUnit()
    {
        return $this->hasOne(\common\models\RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getSub()
    {
        return $this->hasOne(\common\models\RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getProgram() 
    {
        return $this->hasOne(\common\models\RefProgram::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Prog' => 'Kd_Prog']);
    } 

    public function getKegiatan()
    {
        return $this->hasOne(\common\models\TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdSumber()
    {
        return $this->hasOne(RefSumberDana::className(), ['Kd_Sumber' => 'Kd_Sumber']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdApPub()
    {
        return $this->hasOne(RefApPub::className(), ['Kd_Ap_Pub' => 'Kd_Ap_Pub']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaHistory()
    {
        return $this->hasOne(TaBelanjaHistory::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaRincs()
    {
        return $this->hasMany(TaBelanjaRincRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    public function getTaBelanjaRinc()
    {
        return $this->hasOne(TaBelanjaRincRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    public function getTaBelanjaRincSubs()
    {
        return $this->hasmany(TaBelanjaRincSubRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    public function getKdRek5()
    {
        return $this->hasOne(RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    public function getRefRek1()
    {
        return $this->hasOne(RefRek1::className(), ['Kd_Rek_1' => 'Kd_Rek_1']);
    }

    public function getRefRek2()
    {
        return $this->hasOne(RefRek2::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']);
    }

    public function getRefRek3()
    {
        return $this->hasOne(RefRek3::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']);
    }

    public function getRefRek4()
    {
        return $this->hasOne(RefRek4::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4']);
    }

    public function getRefRek5()
    {
        return $this->hasOne(RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaQuery(get_called_class());
    }

    // public function afterSave()
    // {
    //     $log = new Savelog();
    //     $pesan = '';
    //     $kegiatan = '';
    //     $tabel = $this->tableName();

    //     // if ($this->isNewRecord) {
    //     if(strpos(Yii::$app->controller->action->id, 'tambah') !== false){
    //         $pesan = 'tambah rincian kegiatan berhasil';
    //         $kegiatan = 'tambah rincian kegiatan';
    //     }
    //     else{
    //         $pesan = 'ubah rincian kegiatan berhasil';
    //         $kegiatan = 'ubah rincian kegiatan';
    //     }

    //     $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
    //     // parent::beforeSave();
    //     // return true;
    // }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $log = new Savelog();
            $pesan = '';
            $kegiatan = '';
            $tabel = $this->tableName();

            // if ($this->isNewRecord) {
            if(strpos(Yii::$app->controller->action->id, 'tambah') !== false){
                $pesan = 'tambah rincian kegiatan berhasil';
                $kegiatan = 'tambah rincian kegiatan';
            }
            else{
                $pesan = 'ubah rincian kegiatan berhasil';
                $kegiatan = 'ubah rincian kegiatan';
            }

            $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
            return true;
        } 
    }

    public function afterDelete()
    {
        $log = new Savelog();
        $tabel = $this->tableName();
        $pesan = 'hapus rincian kegiatan berhasil';
        $kegiatan = 'hapus rincian kegiatan';

        $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
    }
}
