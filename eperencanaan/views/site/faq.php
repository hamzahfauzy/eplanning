<style type="text/css">
    .panel-group .panel-heading{
        /*background: rgb(48, 64, 86);*/
        /*background: #07325f;*/
        background: #04192f;
        color: white;
    }
    .panel-group .panel-heading:hover{
        /*background: #04192f;*/
        background: #07325f;
        /*background: rgb(48, 64, 86);*/
        /*color: #FFD700;*/
    }

    .panel-group .panel-heading a{
        text-decoration: none;
    }
    .panel-group .panel-collapse{
        /*background: #E6FFD9;*/     
        background: #E8FFE0;
        text-align: justify;
    }
    #title p{
        text-align: center;
    }
</style>
<html>
<body>
<?php
    use yii\bootstrap\Collapse;
    // use yii\bootstrap\Collapse;
    $this->title = 'Frequently Asked Questions';
    // echo "<pre>";
    // $Rembuk_warga = array(
    //     '1. Apa saja yang boleh di usulkan pada saat Rembuk Warga?' 
    //         => 'Semua hal yang bertujuan untuk kebaikan lingkungan dapat di usulkan pada Rembuk Warga.'
    //     );
    // print_r($Rembuk_warga);
    // echo "</pre>";
    // echo "</br>";
    echo "<h3><b>Rembuk Warga</b></h3>";
    echo Collapse::widget([
        'items' => [
            [
                'label' => '1.  Apa itu Rembuk Warga?',
                'content' => 'Suatu wadah yang mempertemukan seluruh elemen dan anggota yang ada di dusun/lingkungan, yang difasilitasi oleh Kepala Lingkungan/Kepala Dusun untuk mendiskusikan berbagai masalah, potensi, dan usulan kegiatan dari masyarakat.',
            ],
            [
                'label' => '2. Bagaimana proses Melakukan Rembuk Warga?',
                'content' => 'Kepala lingkungan/dusun dapat melihat panduan setelah melakukan Login pada <a target=blank href="http://eplanning.asahankab.go.id"><b>eplanning.asahankab.go.id</b></a> dengan memilih menu Rembuk Warga.',
            ],
            [
                'label' => '3. Bagaimana jika absensi yang sudah di unduh hilang?',
                'content' => 'Kepala Lingkungan/Dusun dapat mengunduh ulang Absensi pada menu Dokumen dan pilih <b>Unduh Ulang Absensi</b>',
            ],
            [
                'label' => '4. Apa saja yang boleh di usulkan pada saat Rembuk Warga?',
                'content' => 'Semua hal yang bertujuan untuk kebaikan lingkungan dapat di usulkan pada <b>Rembuk Warga.</b>',
            ],
            [
                'label' => '5.  Apa yang terjadi jika Rembuk Warga tidak dilaksanakan?',
                'content' => '<b>Musrenbang Kelurahan, Musrenbang Kecamatan</b> dan selanjutnya tidak dapat dilaksanakan',
            ],
            [
                'label' => '6. Bagaimana bila tidak ada pemukiman pada lingkungan/dusun terkait? Sehingga Rembuk Warga tidak dapat dilaksanakan!',
                'content' => 'Rembuk Warga tetap dilaksanakan oleh <b>Kepala Lingkungan/Dusun</b> meskipun usulan lingkungan/dusun tidak ada (Nihil).',
            ],  
            [
                'label' => '7. Apakah usulan yang disampaikan melalui Rembuk Warga akan diterima semua?',
                'content' => 'Semua usulan yang telah disampaikan pada Rembuk Warga akan disaring lagi pada tingkat lebih lanjut. Seperti, <b>Musrenbang Kelurahan, Musrenbang Kecamatan</b> dan selanjutnya.',
            ],
            [
                'label' => '8. Apakah yang menentukan usulan diterima atau ditolak?',
                'content' => 'Usulan akan diterima disaring melalui tingkat 4 Prioritas Bidang Pembangunan. Yaitu Infrastuktur, Pendidikan, Kesehatan, Pertanian.',
            ],
            [
                'label' => '9. Berapakah batas maksimum file upload yang diizinkan?',
                'content' => 'Batas file upload untuk <b>Photo</b> dan <b>Video</b> adalah 100Mb.',
            ],
            [
                'label' => '10. Berapakah batas maksimum time-upload?',
                'content' => 'Batas <b>time-upload</b> adalah 2 menit. Jika proses upload melebihi 2 menit dikarenakan koneksi internet yang lambat, maka system akan memberikan pesan gagal upload.',
            ],
            [
                'label' => '11. Saat tombol kirim ke-Kelurahan di klik. Apakah masih bisa mengedit ulusan?',
                'content' => 'Tidak bisa.',
            ],
            [
                'label' => '12. Bagaimana jika ada usulan yang belum di input, sementara tombol kirim ke-Kelurahan/Desa sudah di klik?',
                'content' => 'Usulan yang belum di input dapat di usulkan kembali pada saat <b>Musrenbang Kelurahan</b>',
            ],
            [
                'label' => '13. Apakah kepala lingkungan/dusun dapat mengedit atau menghapus usulan?',
                'content' => 'Bisa, Kepala Lingkungan/Dusun dapat melakukannya di menu <b>Rekapitulasi Usulan.</b>',
            ],
            [
                'label' => '14. Bagaimana cara agar operator bisa mengedit usulan jika sudah terlanjur kirim ke-kelurahan ?',
                'content' => 'Operator harus melaporkan ke kelurahan dengan melampirkan <b>surat berita acara</b> perubahan usulan.',
            ],
            [
                'label' => '15. Apakah semua berkas yang akan di upload dalam bentuk file gambar?',
                'content' => 'Tidak, harus di ubah dalam bentuk <b>pdf</b> (Berkas Absen, Berkas Berita Acara, Berkas Berita Undangan, Berkas Tanda Terima).',
            ],
            [
                'label' => '16. Apakah yang dimaksud dengan Berkas Tanda Terima?',
                'content' => '<b>Berkas Tanda Terima</b> adalah bukti Rembuk Warga telah mengundang unsur-unsur terkait untuk hadir di <b>Rembuk Warga.</b>',
            ]                         
        ]
    ]);

    echo "<h3><b>Musrenbang Desa/Kelurahan</b></h3>";
    echo Collapse::widget([
        'items' => [
            [
                'label' => '1. Bagaimana proses Melakukan Musrenbang Desa/Kelurahan?',
                'content' => 'Operator Kelurahan dapat melihat panduan setelah melakkan Login pada <a target=bank; href=http://eplanning.asahankab.go.id><b>eplanning.asahankab.go.id</b></a> dengan memilih Musrenbang Desa/Kelurahan.',
            ],
            [
                'label' => '2. Apa yang menyebabkan tidak bisa unduh Absensi?',
                'content' => 'Ada Lingkungan/Dusun yang belum menyelesaikan <b>Rembuk Warga</b>',
            ],
            [
                'label' => '3. Bagaimana jika koneksi internet lambat? sehingga sulit melaksanakan Musrenbang Desa/Kelurahan.',
                'content' => 'Pihak Kelurahan dapat melaksanakan Musrenbang Desa/Kelurahan secara offline dengan cara men-cetak semua usulan lingkungan pada menu <b>Cetak Usulan Lingkungan/Dusun</b>',
            ],
            [
                'label' => '4. Bagaimana cara melihat usulan yang sudah di verifikasi dan belum diverifikasi?',
                'content' => 'Pada menu <b>Pantau Usulan</b> Operator Desa/Kelurahan dapat melihat semua usulan yang sudah dan belum terverifikasi.',
            ],
            [
                'label' => '5. Bagaimana jika Absensi hilang? apakah bisa di download ulang?',
                'content' => 'pada menu <b>Dokumen</b> Operator Desa/Kelurahan dapat mengunduh ulang absensi.',
            ],
            [
                'label' => '6. Mengapa tombol Selesai Verifikasi pada menu Rekapitulasi Usulan Lingkungan tidak bisa di klik?',
                'content' => 'Tombol <b>Selesai Verifikasi</b> dapat di klik setelah semua usulan dari setiap Desa/Lingkungan telah di verifikasi',
            ],
            [
                'label' => '7. Apakah usulan yang telah diterima dapat di tolak? ataupun sebaliknya?',
                'content' => 'Bisa',
            ],
            [
                'label' => '8. Apakah Desa/Kelurahan dapat menambahkan usulan?',
                'content' => 'Desa/Keluarahan dapat menambahkan usulan pada menu <b>Tambah Usulan Lingkungan/Dusun</b>',
            ],
            [
                'label' => '9. Mengapa usulan harus di kompilasi?',
                'content' => 'Untuk menggabungkan usulan yang sama pada lingkungan/dusun menjadi satu <b>Usulan Desa/Kelurahan</b>.',
            ],
            [
                'label' => '10. Bagaimana jika tidak ada usulan yang sama? sehingga tidak bisa dilakukan kompilasi!',
                'content' => '<b>Kompilasi</b> harus tetap dilakukan, dengan hanya memilih satu usulan.',
            ],
            [
                'label' => '11. Apakah Desa/Kelurahan dapat menambahkan Usulan Desa/Kelurahan?',
                'content' => 'Kelurahan dapat menambahkan Usulan Desa/Kelurahan pada menu Kompilasi di form <b>Usulan.</b>',
            ],
            [
                'label' => '12. Kapan kah tombol Kirim ke Kecamatan aktif?',
                'content' => 'Jika semua <b>Usulan Desa/Kelurahan</b> sudah semua di Kompilasi.',
            ],
            [
                'label' => '13. Berapa ukuran maksimal video yang harus di upload?',
                'content' => 'Ukuran maksimal file yang dapat di upload adalah <b>100MB.</b>',
            ],
            [
                'label' => '14. Apakah semua berkas yang akan di upload dalam bentuk file gambar?',
                'content' => 'Tidak, harus di ubah dalam bentuk <b>pdf</b> (Berkas Absen, Berkas Berita Acara, Berkas Berita Undangan, Berkas Tanda Terima).',
            ],
            [
                'label' => '15. Apakah yang dimaksud dengan Berkas Tanda Terima?',
                'content' => '<b>Berkas Tanda Terima</b> adalah bukti Desa/Kelurahan telah mengundang unsur-unsur terkait untuk hadir di <b>Musrenbang Desa/Kelurahan.</b>',
            ],
            [
                'label' => '16. Kapan menu Cetak Berita Acara aktif?',
                'content' => 'Menu <b>Cetak Berita Acara</b> akan aktif jika semua Usulan Desa/Kelurahan sudah di kirim ke Kecamatan.',
            ]
            

        ]
    ]);

    echo "<h3><b>Musrenbang Kecamatan</b></h3>";
    echo Collapse::widget([
        'items' => [
            [
                'label' => '1. Bagaimana proses melakukan Musrenbang Kecamatan?',
                'content' => 'Operator Kecamatan dapat melihat panduan setelah melakkan Login pada <a target=bank; href=http://eplanning.asahankab.go.id><b>eplanning.asahankab.go.id</b></a> dengan memilih Musrenbang Kecamatan.',
            ],
            [
                'label' => '2. Apa yang menyebabkan tidak bisa Unduh Absensi?',
                'content' => 'Ada Kelurahan yang belum menyelesaikan <b>Musrenbang Desa/Kelurahan</b>',
            ],
            [
                'label' => '3. Bagaimana jika koneksi internet lambat? Sehingga sulit melaksanakan Musrenbang Kecamatan.',
                'content' => 'Pihak Kelurahan dapat melaksanakan <b>Musrenbang Kecamatan</b> secara offline dengan cara men-cetak semua usulan Kelurahan pada menu <b>Cetak Usulan Desa/Kelurahan.</b>',
            ],
            [
                'label' => '4. Apa yang menyebabkan tidak bisa Ambil (Load Data) Usulan Kelurahan dan Usulan Dusun/Lingkungan yang disetujui Desa/Kelurahan?',
                'content' => 'Ada Kelurahan Yang Belum <b>Menginput Data</b> dan <b>Mengirimkan ke Kecamatan.</b>',
            ],
            [
                'label' => '5. Apakah Kecamatan dapat menambahkan Usulan?',
                'content' => 'Kecamatan dapat menambahkan usulan pada menu Usulan Kecamatan di Form <b>Tambah Usulan.</b>',
            ],
            [
                'label' => '6. Bagaimana melihat usulan yang ditambahkan dari pihak Kecamatan?',
                'content' => 'Dari menu <b>Usulan Kecamatan</b> di Form Usulan Kecamatan.',
            ],
            [
                'label' => '7. Apakah usulan yang sudah di Skoring masih bisa diubah?',
                'content' => '<b>Bisa</b>, jika usulan yang sudah di Skoring belum dikirim ke OPD',
            ],
            [
                'label' => '8. Bagaimana melihat Usulan Prioritas yang sudah di Skoring?',
                'content' => 'Dari menu <b>Hasil Skoring</b> di Form <b>Usulan Prioritas.</b>',
            ],
            [
                'label' => '9. Apakah semua Usulan Lingkungan yang tidak masuk dalam 10.3.3 di Skoring juga?',
                'content' => 'Semua Usulan yang masuk di Kecamatan harus di Skoring. Diluar 10.3.3 merupakan <b>Usulan Cadangan</b>.',
            ],
            [
                'label' => '10. Apakah yang 10.3.3 saja yang dilakukan pembobotan?',
                'content' => 'Semua usulan selain non prioritas di Skoring, dan akan terpilah sendiri sesuai 10.3.3 (menjadi <b>Usulan Prioritas</b>), sisanya masuk <b>Usulan Cadangan</b>. Pemilahan sesuai dengan skor yang dihasilkan.',
            ],
            [
                'label' => '11. Apakah usulan non prioritas di lanjut ke OPD dan Pembobotan?',
                'content' => 'Usulan <b>Non Prioritas</b> tidak akan diteruskan (dianggap ditolak oleh kecamatan).',
            ],
            [
                'label' => '12. Bagaimana jika Absensi hilang? Apakah bisa di download ulang?',
                'content' => 'Bisa. Pada menu Dokumen Operator Kecamatan dapat mengunduh ulang <b>Absensi</b>.',
            ],
            [
                'label' => '13. Berapa ukuran maksimal vidio yang harus di upload?',
                'content' => 'Ukuran maksimal file yang dapat di upload adalah <b>100MB</b>.',
            ],
            [
                'label' => '14. Kapan menu Cetak Berita Acara aktif?',
                'content' => 'Menu <b>Cetak Berita</b> Acara akan aktif jika semua Usulan Kecamatan sudah di kirim ke OPD.',
            ],
            [
                'label' => '15. Apakah yang dimaksud dengan Berkas Tanda Terima?',
                'content' => '<b>Berkas Tanda Terima</b> adalah bukti Kecamatan telah mengundang unsur - unsur terkait untuk hadir di <b>Musrenbang Kecamatan</b>.',
            ]
        ]
    ]);

    echo "<h3><b>Musrenbang Forum OPD</b></h3>";
    echo Collapse::widget([
        'items' => [
            [
                'label' => '1. Bagaimana proses melakukan Rencana Kerja Pemerintah Daerah (RKPD)?',
                'content' => 'Kepala OPD dapat melihat panduan setelah melakukan login pada <a target=bank; href=http://eplanning.asahankab.go.id/eperencanaan/eperencanaan/web/><b>eplanning.asahankab.go.id/eperencanaan/eperencanaan/web/</b></a>',
            ],
            [
                'label' => '2. Apa yang terjadi jika tidak dilaksanakan Rencana Kerja Pemerintah Daerah?',
                'content' => 'Yang terjadi adalah <b>Pemerintah Daerah melanggar undang – undang</b> dan <b>melanggar Peraturan</b>',
            ],
            [
                'label' => '3. Username dan Password sudah sesuai, apa yang terjadi ketika berulang – ulang dicoba tidak dapat login?',
                'content' => 'Jika terjadi 3x gagal login, <b>username akan disable secara otomatis</b>, untuk menghindari percobaan login oleh orang – orang yang tidak bertanggung jawab.',
            ],
            [
                'label' => '4. Bagaimana memperbaiki yang kita buat salah dan harus diubah?',
                'content' => 'Pilih <b>simbol pensil</b> (edit) pada kegiatan yang akan di edit.',
            ],
            [
                'label' => '5. Bagaimana caranya men download Rencana Kerja (Pra RKA) dari kecamatan?',
                'content' => '',
            ],
            [
                'label' => '6. Apa yang dimaksud dengan Keluaran N+1?',
                'content' => '<b>Untuk yang akan datang</b> / Pagu anggaran untuk Tahun depan.',
            ],
            [
                'label' => '7. Bagaimana cara memasukkan pagu untuk belanja kegiatan?',
                'content' => 'Dari <b>tombol SSH</b>, search biaya yang dicari',
            ],
            [
                'label' => '8. Bagaimana jika rincian belanja tidak tersedia?',
                'content' => 'Jika tidak tersedia, <b>bisa diusulkan untuk ditambahkan</b> item beserta harganya. Tetapi harus disertai dengan surat opd.',
            ],
            [
                'label' => '9. Apakah program yang tidak ada di e-perencanaan bisa ditambah, jika bisa bagaimana caranya?',
                'content' => '<b>Bisa</b>. Dan untuk penambahan program harus melalui bappeda dengan tembusan bpkad. Program yang ditambahkan juga harus tercantum dalam RPJMD.',
            ],
            [
                'label' => '10. Bagaimana dengan belanja yang tidak tau pasti biayanya berapa? Seperti rekening air, listrik dan telfon.',
                'content' => 'Dengan cara <b>cek rekening</b> PDAM berapa m3 pemakaian air PDAM perbulannya.',
            ],
            [
                'label' => '11. Bagaimana mencetak hasil yang sudah diinput?',
                'content' => 'Dari menu <b>Laporan OPD</b>, dikolom OPD. Klik tombol <b>Download</b> pada Rumusan Rencana Program dan Kegiatan OPD.',
            ],
            [
                'label' => '12. Apakah password masih dapat diubah. Dan bagaimana cara mengubahnya?',
                'content' => 'Dapat. Klik menu <b>Pengaturan</b> pilih Ganti Password.',
            ]
        ]
    ]);
?>

</body>
</html>