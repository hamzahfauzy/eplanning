<?php

namespace common\models;

use Yii;
use common\models\TaRpjmdSasaran;
/**
 * This is the model class for table "Ta_Rpjmd_Program_Prioritas".
 *
 * @property string $Tahun
 * @property integer $No_Misi
 * @property integer $No_Tujuan
 * @property integer $No_Sasaran
 * @property integer $No_Prioritas
 * @property integer $Kd_Prog
 *
 * @property RefKamusProgram $kdProg
 * @property TaRpjmdSasaran $tahun
 * @property TaRpjmdPrioritasPembangunanDaerah $tahun0
 */
class TaRpjmdProgramPrioritas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Rpjmd_Program_Prioritas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'No_Misi', 'No_Tujuan', 'No_Sasaran', 'No_Prioritas', 'Kd_Prog'], 'required'],
            [['Tahun'], 'safe'],
            [['No_Misi', 'No_Tujuan', 'No_Sasaran', 'No_Prioritas', 'Kd_Prog'], 'integer'],
            [['Kd_Prog'], 'exist', 'skipOnError' => true, 'targetClass' => RefKamusProgram::className(), 'targetAttribute' => ['Kd_Prog' => 'Kd_Program']],
            [['Tahun', 'No_Misi', 'No_Tujuan', 'No_Sasaran'], 'exist', 'skipOnError' => true, 'targetClass' => TaRpjmdSasaran::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']],
            [['Tahun', 'No_Prioritas'], 'exist', 'skipOnError' => true, 'targetClass' => TaRpjmdProgramPrioritas::className(), 'targetAttribute' => ['Tahun' => 'Tahun', 'No_Prioritas' => 'No_Prioritas']],
			[['No_Prioritas'], 'exist', 'skipOnError' => true, 'targetClass' => RefRPJMD2::className(), 'targetAttribute' => [ 'No_Prioritas'=> 'Kd_Prioritas_Pembangunan_Kota']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'No_Misi' => 'No  Misi',
            'No_Tujuan' => 'No  Tujuan',
            'No_Sasaran' => 'No  Sasaran',
            'No_Prioritas' => 'No  Prioritas',
            'Kd_Prog' => 'Kode  Program',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKamusProgram()
    {
        return $this->hasOne(RefKamusProgram::className(), ['Kd_Program' => 'Kd_Prog']);
    }

    public function getRefBidang()
    {
        return $this->hasOne(RefBidang::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang']);
    }

    public function getRefProgram()
    {
        return $this->hasOne(RefKamusProgram::className(), ['Kd_Program' => 'Kd_Prog']);
    }

    public function getProgram()
    {
        return $this->hasOne(RefProgram::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdMisi()
    {
        return $this->hasOne(TaRpjmdMisi::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi']);
    }

    public function getTaRpjmdTujuan()
    {
        return $this->hasOne(TaRpjmdTujuan::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    public function getTaRpjmdSasaran()
    {
        return $this->hasOne(TaRpjmdSasaran::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']);
    }

    public function getMe()
    {
        return 1;
    }

    public function getTaRpjmdSasaranMany()
    {
        return $this->hasMany(TaRpjmdSasaran::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaRpjmdPrioritasPembangunanDaerah()
    {
        return $this->hasOne(TaRpjmdPrioritasPembangunanDaerah::className(), ['Tahun' => 'Tahun', 'No_Prioritas' => 'No_Prioritas']);
    }
	public function getTaRpjmdProgramPrioritas()
    {
        return $this->hasOne(TaRpjmdProgramPrioritas::className(), ['Tahun' => 'Tahun', 'No_Prioritas' => 'No_Prioritas']);
    }
	public function getRefRPJMD2()
    {
        return $this->hasOne(RefRPJMD2::className(), ['Kd_Prioritas_Pembangunan_Kota' => 'No_Prioritas']);
    }
    
	public function getRefPrograms()
    {
        return $this->hasMany(RefProgram::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    public function getRefProgramMany()
    {
        return $this->hasMany(TaRpjmdProgramPrioritas::className(), ['Tahun' => 'Tahun', 'No_Misi' => 'No_Misi', 'No_Tujuan' => 'No_Tujuan', 'No_Sasaran' => 'No_Sasaran']);
    }

    public function getTaPrograms()
    {
        return $this->hasMany(TaProgram::className(), ['Kd_Prog' => 'Kd_Prog']);
    }
    public function getTaProgram()
    {
        return $this->hasOne(TaProgram::className(), ['Kd_Prog' => 'Kd_Prog']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaRpjmdProgramPrioritasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaRpjmdProgramPrioritasQuery(get_called_class());
    }
}
