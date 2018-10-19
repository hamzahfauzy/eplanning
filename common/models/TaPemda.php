<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "Ta_Pemda".
 *
 * @property string $Tahun
 * @property string $Nm_Pemda
 * @property string $Nm_PimpDaerah
 * @property string $Jab_PimpDaerah
 * @property string $Nm_Sekda
 * @property string $Nip_Sekda
 * @property string $Jbt_Sekda
 * @property string $Nm_Ka_Keu
 * @property string $Nip_Ka_Keu
 * @property string $Jbt_Ka_Keu
 * @property string $Nm_Ka_Anggaran
 * @property string $Nip_Ka_Anggaran
 * @property string $Jbt_Ka_Anggaran
 * @property string $Nm_Ka_Verifikasi
 * @property string $Nip_Ka_Verifikasi
 * @property string $Jbt_Ka_Verifikasi
 * @property string $Nm_Ka_Perbendaharaan
 * @property string $Nip_Ka_Perbendaharaan
 * @property string $Jbt_Ka_Perbendaharaan
 * @property string $Nm_Ka_BUD
 * @property string $Nip_Ka_BUD
 * @property string $Jbt_Ka_BUD
 * @property string $NPWP_BUD
 * @property string $K1
 * @property string $K2
 * @property string $K3
 * @property string $K4
 * @property string $Nm_Ka_Pembukuan
 * @property string $Nip_Ka_Pembukuan
 * @property string $Jbt_Ka_Pembukuan
 * @property string $Nm_Atasan_BUD
 * @property string $Nip_Atasan_BUD
 * @property string $Jbt_Atasan_BUD
 * @property string $Ibukota
 * @property string $Alamat
 * @property string $Logo
 * @property int $Kd_Prov
 * @property int $Kd_Kab
 * @property string $No_Telp
 * @property string $Email
 * @property string $Created_At
 * @property int $Status
 * @property string $Hostname
 * @property string $Ip_Public
 * @property string $Token
 *
 * @property TaSubUnit[] $taSubUnits
 * @property RefSubUnit[] $kdUrusans
 */
class TaPemda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ta_Pemda';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tahun', 'Kd_Prov', 'Kd_Kab', 'No_Telp', 'Email', 'Token'], 'required'],
            [['Tahun', 'Created_At'], 'safe'],
            [['Kd_Prov', 'Kd_Kab', 'Status'], 'integer'],
            [['Nm_Pemda', 'Nm_PimpDaerah', 'Logo', 'Hostname', 'Ip_Public', 'Token'], 'string', 'max' => 100],
            [['Jab_PimpDaerah', 'Nm_Sekda', 'Nm_Ka_Keu', 'Nm_Ka_Anggaran', 'Nm_Ka_Verifikasi', 'Nm_Ka_Perbendaharaan', 'Nm_Ka_BUD', 'Nm_Ka_Pembukuan', 'Nm_Atasan_BUD', 'Ibukota'], 'string', 'max' => 50],
            [['Nip_Sekda', 'Nip_Ka_Keu', 'Nip_Ka_Anggaran', 'Nip_Ka_Verifikasi', 'Nip_Ka_Perbendaharaan', 'Nip_Ka_BUD', 'Nip_Ka_Pembukuan', 'Nip_Atasan_BUD'], 'string', 'max' => 21],
            [['Jbt_Sekda', 'Jbt_Ka_Keu', 'Jbt_Ka_Anggaran', 'Jbt_Ka_Verifikasi', 'Jbt_Ka_Perbendaharaan', 'Jbt_Ka_BUD', 'Jbt_Ka_Pembukuan', 'Jbt_Atasan_BUD'], 'string', 'max' => 75],
            [['NPWP_BUD'], 'string', 'max' => 15],
            [['K1', 'K3'], 'string', 'max' => 2],
            [['K2'], 'string', 'max' => 6],
            [['K4', 'Alamat', 'No_Telp', 'Email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Nm_Pemda' => 'Pemda',
            'Nm_PimpDaerah' => 'Pimpinan Daerah',
            'Jab_PimpDaerah' => 'Jabatan  Pimpinan Daerah',
            'Nm_Sekda' => 'Sekda',
            'Nip_Sekda' => 'NIP  Sekda',
            'Jbt_Sekda' => 'Jabatan  Sekda',
            'Nm_Ka_Keu' => 'Kepala  Keuangan',
            'Nip_Ka_Keu' => 'NIP  Kepala  Keuangan',
            'Jbt_Ka_Keu' => 'Jabatn  Kepala  Keuangan',
            'Nm_Ka_Anggaran' => 'Kepala  Anggaran',
            'Nip_Ka_Anggaran' => 'NIP  Kepala  Anggaran',
            'Jbt_Ka_Anggaran' => 'Jabatan  Kepala  Anggaran',
            'Nm_Ka_Verifikasi' => 'Kepala  Verifikasi',
            'Nip_Ka_Verifikasi' => 'NIP  Kepala  Verifikasi',
            'Jbt_Ka_Verifikasi' => 'Jabatan  Kepala  Verifikasi',
            'Nm_Ka_Perbendaharaan' => 'Kepala  Perbendaharaan',
            'Nip_Ka_Perbendaharaan' => 'NIP  Kepala  Perbendaharaan',
            'Jbt_Ka_Perbendaharaan' => 'Jabatan  Kepala  Perbendaharaan',
            'Nm_Ka_BUD' => 'Nm  Ka  Bud',
            'Nip_Ka_BUD' => 'Nip  Ka  Bud',
            'Jbt_Ka_BUD' => 'Jbt  Ka  Bud',
            'NPWP_BUD' => 'Npwp  Bud',
            'K1' => 'K1',
            'K2' => 'K2',
            'K3' => 'K3',
            'K4' => 'K4',
            'Nm_Ka_Pembukuan' => 'Kepala  Pembukuan',
            'Nip_Ka_Pembukuan' => 'NIP  Kepala  Pembukuan',
            'Jbt_Ka_Pembukuan' => 'Jabatan  Kepala  Pembukuan',
            'Nm_Atasan_BUD' => 'Nm  Atasan  Bud',
            'Nip_Atasan_BUD' => 'Nip  Atasan  Bud',
            'Jbt_Atasan_BUD' => 'Jbt  Atasan  Bud',
            'Ibukota' => 'Ibukota',
            'Alamat' => 'Alamat',
            'Logo' => 'Logo',
            'Kd_Prov' => 'Kode  Provinsi',
            'Kd_Kab' => 'Kode  Kabupaten',
            'No_Telp' => 'No  Telp',
            'Email' => 'Email',
            'Created_At' => 'Created  At',
            'Status' => 'Status',
            'Hostname' => 'Hostname',
            'Ip_Public' => 'Ip  Public',
            'Token' => 'Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaSubUnits()
    {
        return $this->hasMany(TaSubUnit::className(), ['Tahun' => 'Tahun']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKdUrusans()
    {
        return $this->hasMany(RefSubUnit::className(), ['Kd_Urusan' => 'Kd_Urusan', 'Kd_Bidang' => 'Kd_Bidang', 'Kd_Unit' => 'Kd_Unit', 'Kd_Sub' => 'Kd_Sub'])->viaTable('Ta_Sub_Unit', ['Tahun' => 'Tahun']);
    }

    public function getRefProvinsi()
    {
        return $this->hasOne(RefProvinsi::className(), ['Kd_Prov' => 'Kd_Prov']);
    }

    public function getRefKabupaten()
    {
        return $this->hasOne(RefKabupaten::className(), ['Kd_Prov' => 'Kd_Prov', 'Kd_Kab' => 'Kd_Kab']);
    }

    /**
     * @inheritdoc
     * @return \common\models\query\TaPemdaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\TaPemdaQuery(get_called_class());
    }
}
