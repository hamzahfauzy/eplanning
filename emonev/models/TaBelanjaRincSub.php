<?php

namespace emonev\models;

use Yii;
use common\models\RefProgram;
use common\models\RefRek1;
use common\models\RefRek2;
use common\models\RefRek3;
use common\models\RefRek4;
use common\models\RefRek5;
use common\models\RefUrusan;
use common\models\RefBidang;
use common\models\RefSubUnit;
use common\models\RefUnit;
use common\models\TaProgram;
use common\models\TaKegiatan;
/**
 * This is the model class for table "Ta_Belanja_Rinc_Sub".
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
 * @property int $No_ID
 * @property string $Sat_1
 * @property double $Nilai_1
 * @property string $Sat_2
 * @property double $Nilai_2
 * @property string $Sat_3
 * @property double $Nilai_3
 * @property string $Satuan123
 * @property double $Jml_Satuan
 * @property double $Nilai_Rp
 * @property double $Total
 * @property string $Keterangan
 * @property string $Asal_Biaya 1. ssh, 2. hspk, 3. asb
 * @property string $Uraian_Asal_Biaya serialize dari ssh atau asb
 * @property string $Ref_Usulan_Rincian dari usulan mana obyek di ambil. 1. lingkungan, 2. kelurahan, 3. kecamatan, 4. skpd, 5. pokir, 6. skpd, 7. musrenbang kota
 * @property string $Uraian_Ref_Usulan serialize dari asal obyek 
 * @property string $Lokasi
 *
 * @property TaBelanjaRinc $tahun
 */
class TaBelanjaRincSub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $jumlah;

    public static function tableName()
    {
        return 'Ta_Belanja_Rinc_Sub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'No_ID', 'Satuan123', 'Jml_Satuan', 'Nilai_Rp', 'Total', 'Asal_Biaya','Judul'], 'required'],
            [['Tahun'], 'safe'],
            [['Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'ID_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc', 'No_ID'], 'integer'],
            [['Nilai_1', 'Nilai_2', 'Nilai_3', 'Jml_Satuan', 'Nilai_Rp', 'Total'], 'number'],
            [['Asal_Biaya', 'Uraian_Asal_Biaya', 'Ref_Usulan_Rincian', 'Uraian_Ref_Usulan','Judul'], 'string'],
            [['Sat_1', 'Sat_2', 'Sat_3'], 'string', 'max' => 10],
            [['Satuan123'], 'string', 'max' => 50],
            [['Keterangan', 'Lokasi'], 'string', 'max' => 255],
            [['Tahun', 'Kd_Urusan', 'Kd_Bidang', 'Kd_Unit', 'Kd_Sub', 'Kd_Prog', 'Kd_Keg', 'Kd_Rek_1', 'Kd_Rek_2', 'Kd_Rek_3', 'Kd_Rek_4', 'Kd_Rek_5', 'No_Rinc'], 'exist', 'skipOnError' => true, 'targetClass' => TaBelanjaRinc::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']],
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
            'No_ID' => 'No  ID',
            'Sat_1' => 'Sat 1',
            'Nilai_1' => 'Nilai 1',
            'Sat_2' => 'Sat 2',
            'Nilai_2' => 'Nilai 2',
            'Sat_3' => 'Sat 3',
            'Nilai_3' => 'Nilai 3',
            'Satuan123' => 'Satuan123',
            'Jml_Satuan' => 'Jml  Satuan',
            'Nilai_Rp' => 'Nilai  Rp',
            'Total' => 'Total',
            'Keterangan' => 'Keterangan',
            'Asal_Biaya' => 'Asal  Biaya',
            'Uraian_Asal_Biaya' => 'Uraian  Asal  Biaya',
            'Ref_Usulan_Rincian' => 'Ref  Usulan  Rincian',
            'Uraian_Ref_Usulan' => 'Uraian  Ref  Usulan',
            'Lokasi' => 'Lokasi',
			'Judul' => 'Judul Asal',
        ];
    }
/**
     * @return \yii\db\ActiveQuery
     */
    public function getTahun()
    {
        return $this->hasOne(TaBelanjaRinc::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }

    public function getUrusan()
    {
        return $this->hasOne(RefUrusan::className(), ['Kd_Urusan' => 'Kd_Urusan']);
    }

    public function getSubUnit()
    {
        return $this->hasOne(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub']);
    }

    public function getUnit()
    {
        return $this->hasOne(RefUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit']);
    }

    public function getBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan','Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getTaProgram()
    {
        return $this->hasOne(TaProgram::classname(),['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }

    public function getTaPrograms()
    {
        return $this->hasMany(TaProgram::classname(),['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog']);
    }


    public function getKegiatan()

    {

        return $this->hasOne(TaKegiatan::classname(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']
            );

    }

    public function getKegiatans()

    {

        return $this->hasMany(TaKegiatan::classname(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']
            );

    }


    public function getRefProgram()

    {

        return $this->hasOne(RefProgram::classname(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang',
            'Kd_Prog' => 'Kd_Prog']
            );

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

    public function getTaBelanjaRinc()
    {
        return $this->hasOne(TaBelanjaRinc::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }  

    public function getKdRek1s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg']);
    }

    public function getKdRek2s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1']);
    }

    public function getKdRek3s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2']);
    }

    public function getKdRek4s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3']);
    }

    public function getKdRek5s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4']);
    }

    public function getKdRek6s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5']);
    }

    public function getKdRek7s() {
        return $this->hasMany(TaBelanjaRincSub::className(), ['Tahun' => 'Tahun', 'Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub', 'Kd_Prog' => 'Kd_Prog', 'Kd_Keg' => 'Kd_Keg', 'Kd_Rek_1' => 'Kd_Rek_1', 'Kd_Rek_2' => 'Kd_Rek_2', 'Kd_Rek_3' => 'Kd_Rek_3', 'Kd_Rek_4' => 'Kd_Rek_4', 'Kd_Rek_5' => 'Kd_Rek_5', 'No_Rinc' => 'No_Rinc']);
    }


    /**
     * @inheritdoc
     * @return \emusrenbang\models\query\TaBelanjaRincSubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \emusrenbang\models\query\TaBelanjaRincSubQuery(get_called_class());
    }

    // public function afterSave()
    // {
    //     $log = new Savelog();
    //     $pesan = '';
    //     $kegiatan = '';
    //     $tabel = $this->tableName();
    //     //if (Yii::$app->controller->action->id == 'tambah-rincian-sub-proses') {
    //     if(strpos(Yii::$app->controller->action->id, 'tambah') !== false){
    //         $pesan = 'tambah rincian objek kegiatan berhasil';
    //         $kegiatan = 'tambah rincian objek kegiatan';
    //     }
    //     else {
    //         $pesan = 'ubah rincian objek kegiatan berhasil';
    //         $kegiatan = 'ubah rincian objek kegiatan';
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
                $pesan = 'tambah rincian objek kegiatan berhasil';
                $kegiatan = 'tambah rincian objek kegiatan';
            }
            else {
                $pesan = 'ubah rincian objek kegiatan berhasil';
                $kegiatan = 'ubah rincian objek kegiatan';
            }

            $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
            return true;
        } 
    }

    public function afterDelete()
    {
        $log = new Savelog();
        $tabel = $this->tableName();
        $pesan = 'hapus rincian objek kegiatan berhasil';
        $kegiatan = 'hapus rincian objek kegiatan';

        $log->save($pesan, $kegiatan, $tabel, ''); //pesan, kegiatan, tabel, id dari tabel
    }
}
