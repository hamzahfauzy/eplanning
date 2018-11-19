<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Ta_Pemda".
 *
 * @property integer $Tahun
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
            [['Tahun'], 'required'],
            [['Tahun'], 'integer'],
            [['Nm_Pemda', 'Nm_PimpDaerah', 'Logo'], 'string', 'max' => 100],
            [['Jab_PimpDaerah', 'Nm_Sekda', 'Nm_Ka_Keu', 'Nm_Ka_Anggaran', 'Nm_Ka_Verifikasi', 'Nm_Ka_Perbendaharaan', 'Nm_Ka_BUD', 'Nm_Ka_Pembukuan', 'Nm_Atasan_BUD', 'Ibukota'], 'string', 'max' => 50],
            [['Nip_Sekda', 'Nip_Ka_Keu', 'Nip_Ka_Anggaran', 'Nip_Ka_Verifikasi', 'Nip_Ka_Perbendaharaan', 'Nip_Ka_BUD', 'Nip_Ka_Pembukuan', 'Nip_Atasan_BUD'], 'string', 'max' => 21],
            [['Jbt_Sekda', 'Jbt_Ka_Keu', 'Jbt_Ka_Anggaran', 'Jbt_Ka_Verifikasi', 'Jbt_Ka_Perbendaharaan', 'Jbt_Ka_BUD', 'Jbt_Ka_Pembukuan', 'Jbt_Atasan_BUD'], 'string', 'max' => 75],
            [['NPWP_BUD'], 'string', 'max' => 15],
            [['K1', 'K3'], 'string', 'max' => 2],
            [['K2'], 'string', 'max' => 6],
            [['K4', 'Alamat'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Tahun' => 'Tahun',
            'Nm_Pemda' => 'Nm  Pemda',
            'Nm_PimpDaerah' => 'Nm  Pimp Daerah',
            'Jab_PimpDaerah' => 'Jab  Pimp Daerah',
            'Nm_Sekda' => 'Nm  Sekda',
            'Nip_Sekda' => 'Nip  Sekda',
            'Jbt_Sekda' => 'Jbt  Sekda',
            'Nm_Ka_Keu' => 'Nm  Ka  Keu',
            'Nip_Ka_Keu' => 'Nip  Ka  Keu',
            'Jbt_Ka_Keu' => 'Jbt  Ka  Keu',
            'Nm_Ka_Anggaran' => 'Nm  Ka  Anggaran',
            'Nip_Ka_Anggaran' => 'Nip  Ka  Anggaran',
            'Jbt_Ka_Anggaran' => 'Jbt  Ka  Anggaran',
            'Nm_Ka_Verifikasi' => 'Nm  Ka  Verifikasi',
            'Nip_Ka_Verifikasi' => 'Nip  Ka  Verifikasi',
            'Jbt_Ka_Verifikasi' => 'Jbt  Ka  Verifikasi',
            'Nm_Ka_Perbendaharaan' => 'Nm  Ka  Perbendaharaan',
            'Nip_Ka_Perbendaharaan' => 'Nip  Ka  Perbendaharaan',
            'Jbt_Ka_Perbendaharaan' => 'Jbt  Ka  Perbendaharaan',
            'Nm_Ka_BUD' => 'Nm  Ka  Bud',
            'Nip_Ka_BUD' => 'Nip  Ka  Bud',
            'Jbt_Ka_BUD' => 'Jbt  Ka  Bud',
            'NPWP_BUD' => 'Npwp  Bud',
            'K1' => 'K1',
            'K2' => 'K2',
            'K3' => 'K3',
            'K4' => 'K4',
            'Nm_Ka_Pembukuan' => 'Nm  Ka  Pembukuan',
            'Nip_Ka_Pembukuan' => 'Nip  Ka  Pembukuan',
            'Jbt_Ka_Pembukuan' => 'Jbt  Ka  Pembukuan',
            'Nm_Atasan_BUD' => 'Nm  Atasan  Bud',
            'Nip_Atasan_BUD' => 'Nip  Atasan  Bud',
            'Jbt_Atasan_BUD' => 'Jbt  Atasan  Bud',
            'Ibukota' => 'Ibukota',
            'Alamat' => 'Alamat',
            'Logo' => 'Logo',
        ];
    }

    /**
     * @inheritdoc
     * @return \backend\models\query\TaPemdaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \backend\models\query\TaPemdaQuery(get_called_class());
    }
}
