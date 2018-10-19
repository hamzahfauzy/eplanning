<?php
namespace userlevel\models;

use Yii;
use yii\base\Model;
use common\models\User;
use common\models\RefKecamatan;
use userlevel\models\User as IdUser;
use yii\helpers\ArrayHelper;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $jenis_user;
    public $level;
    public $kec;
    public $urutkel;
    public $kel;
    public $ling;
    public $skpd;
    public $dapil;
    public $dewan;
    public $fraksi;
    public $komisi;
    public $akses;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['kec', 'urutkel', 'ling', 'skpd', 'dapil', 'dewan', 'komisi', 'fraksi'], 'default'],
            ['akses','string']
        ];
    }

    public function attributeLabels(){
        return [
            'kec' => 'Kecamatan',
            'urutkel' => 'Kelurahan',
            'ling' => 'Lingkungan',
            'skpd' => 'SKPD',
            'jenis_user' => 'Jenis User',
            'level' => 'Level',
            'akses' => 'Hak Akses',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */

    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            $user->save(false);
            return $user;
        }

        return null;
    }

    public function getAkses() {
        return $akses = $this->akses;
    }

    public function getSkpd() {
        return $skpd = $this->skpd;
    }

    public function getKec() {
        return $kec = $this->kec;
    }

    public function getUrutKel() {
        return $urutkel = $this->urutkel;
    }

    public function getLing() {
        return $ling = $this->ling;
    }

    public function getUrusan() {
        return $urusan = $this->urusan;
    }

    public function getBidang() {
        return $bidang = $this->bidang;
    }

    public function getDapil() {
        return $dapil = $this->dapil;
    }

    public function getDewan() {
        return $dewan = $this->dewan;
    }

    public function getFraksi() {
        return $fraksi = $this->fraksi;
    }

    public function getKomisi() {
        return $komisi = $this->komisi;
    }

    public function getUnit() {
        return $unit = $this->unit;
    }

    public function getSubUnit() {
        return $subunit = $this->subunit;
    }

    public function getJenisUser() {
        return $jenis_user = $this->jenis_user;
    }

    public function getLevel() {
        return $level = $this->level;
    }
	
	public function getId() {
		$user  = new IdUser();
		return $user->find()->where(['username' => $this->username])->one()->id;
	}
}
