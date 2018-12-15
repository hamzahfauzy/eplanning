<?php

namespace emonev\models;

use Yii;
use common\models\RefSumberDana;
use common\models\RefApPub;
use common\models\RefRek5;
use common\models\TaPaguSubUnit;

use emonev\models\Savelog;


/**
 * This is the model class for table "Ta_Belanja_Rinc".
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
 * @property int $No_Rinc
 * @property string $Keterangan
 * @property int $Kd_Sumber
 *
 * @property TaBelanjaLanjutan[] $taBelanjaLanjutans
 * @property RefSumberDana $kdSumber
 * @property TaBelanja $tahun
 * @property TaBelanjaRincSub[] $taBelanjaRincSubs
 */
class TaBelanjaRincRancangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Belanja_Rinc_Rancangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Keterangan'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'Kd_Sumber'], 'integer'],
            [['Keterangan'], 'string', 'max' => 255],
            [['Kd_Sumber'], 'exist', 'skipOnError' => true, 'targetClass' => RefSumberDana::className(), 'targetAttribute' => ['Kd_Sumber' => 'Kd_Sumber']],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5'], 'exist', 'skipOnError' => true, 'targetClass' => TaBelanja::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Kd_Urusan' => 'Kd  Urusan',
            'Kd_Bidang' => 'Kd  Bidang',
            'Kd_Unit' => 'Kd  Unit',
            'Kd_Sub' => 'Kd  Sub',
            'Kd_Prog' => 'Kd  Prog',
            'ID_Prog' => 'Id  Prog',
            'Kd_Keg' => 'Kd  Keg',
            'Kd_Rek_1' => 'Kd  Rek 1',
            'Kd_Rek_2' => 'Kd  Rek 2',
            'Kd_Rek_3' => 'Kd  Rek 3',
            'Kd_Rek_4' => 'Kd  Rek 4',
            'Kd_Rek_5' => 'Kd  Rek 5',
            'No_Rinc' => 'No  Rinc',
            'Keterangan' => 'Keterangan',
            'Kd_Sumber' => 'Kd  Sumber',
        ];
    }

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
        return $this->hasOne(\common\models\TaKegiatanRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getKdRek5()
    {
        return $this->hasOne(\common\models\RefRek5::className(), ['Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaLanjutans()
    {
        return $this->hasMany(TaBelanjaLanjutan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
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
    // public function getKegiatan()
    // {
    //     return $this->hasOne(TaKegiatan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    // }

    public function getBelanja()
    {
        return $this->hasOne(TaBelanjaRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaBelanjaRincSubs()
    {
        return $this->hasMany(TaBelanjaRincSubRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }

    public function getTaPaguSubUnit()
    {
        return $this->hasOne(TaPaguSubUnit::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getJlhBelanjaRincSubUnits()
    {
        return $this->hasMany(TaBelanjaRincSubRancangan::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaRincQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaRincQuery(get_called_class());
    }

    // public function afterSave()
    // {
    //     $log = new Savelog();
    //     $pesan = '';
    //     $kegiatan = '';
    //     $tabel = $this->tableName();
    //     //if (Yii::$app->controller->action->id == 'tambah-rincian-sub-proses') {
    //     if(strpos(Yii::$app->controller->action->id, 'tambah') !== false){
    //         $pesan = 'tambah rincian sub kegiatan berhasil';
    //         $kegiatan = 'tambah rincian sub kegiatan';
    //     }
    //     else {
    //         $pesan = 'ubah rincian sub kegiatan berhasil';
    //         $kegiatan = 'ubah rincian sub kegiatan';
    //     }

    //     $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
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
                $pesan = 'tambah rincian sub kegiatan berhasil';
                $kegiatan = 'tambah rincian sub kegiatan';
            }
            else {
                $pesan = 'ubah rincian sub kegiatan berhasil';
                $kegiatan = 'ubah rincian sub kegiatan';
            }

            $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
            return true;
        } 
    }

    public function afterDelete()
    {
        $log = new Savelog();
        $tabel = $this->tableName();
        $pesan = 'hapus rincian sub kegiatan berhasil';
        $kegiatan = 'hapus rincian sub kegiatan';

        $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
    }
}
