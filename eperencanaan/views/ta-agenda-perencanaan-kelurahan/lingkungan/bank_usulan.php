<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Jabatans */

$this->title = 'Bank Usulan';
$this->params['subtitle'] = 'Usulan';

//$this->params['breadcrumbs'][] ='';
//$this->params['breadcrumbs'][] = ['label' => 'Jabatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="alert alert-info" role="alert">
		Penjelasan, pengumuman atau keterangan dapat diletakkan disini untuk memberikan informasi lengkap ke  user 
</div>
<div class="row">
	<div class="col-md-12">
        	<div class="box-widget widget-module">
			<div class="widget-container">
				<div class=" widget-block">
                    
                     <div class="section-header">
                         <h2>Data Bank Usulan Fisik  </h2> 
                            </div>
                   
                        
                    <button type="submit" class="btn btn-success">+ Tambah Bank Usulan </button>
	<table class="table dt-table-export table-hover table-bordered matmix-dt bg-hc-border">
					<thead>
					<tr>
						<th>
							No
						</th>
						<th>
							Usulan Kegiatan
						</th>
						<th width="30%">
							Defenisi Operasional
						</th>
                        <th>
							Keterangan
						</th>
						<th>
							Harga Satuan
						</th>
                        <th>
							Satuan
						</th>
						<th>
							Keluaran
						</th>
                         
						<th class="tc-center">
							Hasil
						</th>
                        <th>
							Usulkan
						</th>
					</tr>
					</thead>
					<tfoot>
                        <tr>
						<th>
							No
						</th>
						<th>
							Usulan Kegiatan
						</th>
						<th>
							Defenisi Operasional
						</th>
                        <th>
							Keterangan
						</th>
						<th>
							Harga Satuan
						</th>
                        <th>
							Satuan
						</th>

						

						<th>
							Keluaran
						</th>
						<th class="tc-center">
							Hasil
						</th>
                        <th>
							Usulkan
						</th>
					</tr>
					</tfoot>
					<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							Pembangunan atau Peningkatan Pencahayaan Kota pada Jalan Lingkungan
                            
						</td>
						<td>
							Jarak antar tiang 33 M; harga satuan sesuai dengan Ebudgeting: - 1.08.24.01.06.002.127 atau Armature LED untuk Jalan Lingkungan (Max 90 Watt) Rp. 8.171.200 dan; - 3.02.03.01.046 atau 1 Titik Pembangunan PJU Lingkungan Dengan Tiang PJU Rp. 5.605.65837
						</td>
                        <td>
						
						</td>
                        <td>
						Rp. 13.776.858
						</td>
						<td>
							Titik
						</td>
						<td > 
							Terpasangnya Lampu Penerangan Jalan Lingkungan
						</td>
						<td >
							Terteranginya Jalan Lingkungan
						</td>
                        <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							2
						</td>
						<td>
							Pelatihan Keterampilan Tenaga Kerja Kejuruan Tata Graha
						</td>
						<td>
							Pelatihan ini diperuntukan bagi Calon Tenaga Kerja dari kalangan masyarakat. Kebutuhan Pelatihan : Bahan Percontohan honor instruktur non PNS konsumsi modul pelatihan ATK. Pelatihan dilaksanakan selama 2 bula 
						</td>
                        <td>
						
						</td>
                        <td>
							Rp. 6.000.000
						</td>
                        <td>
							Orang
						</td>
						<td>
						Terlaksananya pelatihan keterampilan ketenagakerjaan
						</td>
						<td > 
							Meningkatnya jumlah pekerja terampil
						</td>
                       <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
					</tr>
                    <tr>
						<td>
							3
						</td>
						<td>
							Pembangunan saluran (tepi jalan)
						</td>
						<td>
							Pembangunan baru saluran tepi jalan di saluran berada di Daerah milik jalan (DAMIJA) - Penggantian saluran tepi jalan yang rusak parah. Harga satuan ASB merupakan: - 1m pemasangan saluran U-Ditch 80-80 cm pabrikasi termasuk angkutan dengan truk crane kapasitas min 3ton - 1m pemasangan saluran tutup u-ditch ld. uk. 80 - 60 cm pabrikasi - 1m3 beton jepit uk 10/30 cm - 1m3 pekerjaan galian tanah dan pembuangan - 1m3 pekerjaan pengurugan pasir urug
						</td>
                        <td>
						Acuan Harga Satuan: Sudin Bina Marga - JAKBAR, Kegiatan Perbaikan Jalan Lingkungan / Orang / Saluran di Wilayah Kec. Tambora termasuk PPN
						</td>
                        <td>
							Rp. 2.243.787
						</td>
                        <td>
							m'
						</td>
						<td>
						Terlaksananya pembangunan saluran lingkungan air
						</td>
						<td > 
						Meningkatnya kuantitas saluran lingkungan air
						</td>
                       <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
						
					</tr>
                   
					
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    
    <div class="col-md-12">
        	<div class="box-widget widget-module">
			<div class="widget-container">
				<div class=" widget-block">
                    
                     <div class="section-header">
                         <h2>Data Kamus Usulan Non Fisik  </h2> 
                            </div>
                   
                        
                    <button type="submit" class="btn btn-success">+ Tambah Kamus Usulan </button>
	<table class="table dt-table-export table-hover table-bordered matmix-dt bg-hc-border">
					<thead>
					<tr>
						<th>
							No
						</th>
						<th>
							Usulan Kegiatan
						</th>
						<th width="30%">
							Defenisi Operasional
						</th>
                        <th>
							Keterangan
						</th>
						<th>
							Harga Satuan
						</th>
                        <th>
							Satuan
						</th>
						<th>
							Keluaran
						</th>
                         
						<th class="tc-center">
							Hasil
						</th>
                        <th>
							Usulkan
						</th>
					</tr>
					</thead>
					<tfoot>
                        <tr>
						<th>
							No
						</th>
						<th>
							Usulan Kegiatan
						</th>
						<th>
							Defenisi Operasional
						</th>
                        <th>
							Keterangan
						</th>
						<th>
							Harga Satuan
						</th>
                        <th>
							Satuan
						</th>
						<th>
							Keluaran
						</th>
						<th class="tc-center">
							Hasil
						</th>
                        <th>
							Usulkan
						</th>
					</tr>
					</tfoot>
					<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							Pelatihan Keterampilan Tenaga Kerja Kejuruan Operator Komputer
                            
						</td>
						<td>
							Pelatihan ini diperuntukan bagi Calon Tenaga Kerja dari kalangan masyarakat. Kebutuhan Pelatihan : Bahan Percontohan honor instruktur non PNS konsumsi modul pelatihan ATK. Pelatihan dilaksanakan selama 2 bulan
						</td>
                        <td>
						
						</td>
                        <td>
						Rp. 6.000.000
						</td>
						<td>
							Orang
						</td>
						<td > 
							Terlaksananya pelatihan keterampilan ketenagakerjaan
						</td>
						<td >
							Meningkatnya jumlah pekerja terampil
						</td>
                        <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							2
						</td>
						<td>
								Pelatihan Keterampilan Tenaga Kerja Kejuruan Bahasa Jepang
						</td>
						<td>
							Pelatihan ini diperuntukan bagi Calon Tenaga Kerja dari kalangan masyarakat. Kebutuhan Pelatihan : Bahan Percontohan honor instruktur non PNS konsumsi modul pelatihan ATK. Pelatihan dilaksanakan selama 2 bulan 
						</td>
                        <td>
						
						</td>
                        <td>
							Rp. 6.000.000
						</td>
                        <td>
							Orang
						</td>
						<td>
						Terlaksananya pelatihan keterampilan ketenagakerjaan
						</td>
						<td > 
							Meningkatnya jumlah pekerja terampil
						</td>
                       <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
					</tr>
                    <tr>
						<td>
							3
						</td>
						<td>
							Pelatihan Guru PAUD
						</td>
						<td>
							Pelatihan Tenaga Pendidik PAUD diselenggarakan oleh UPT Pusat Pelatihan dan Pengembangan Pendidikan Anak Usia Dini, Nonformal dan Informal (P3PAUDNI) selama 5 hari (40 jam)
						</td>
                        <td>
						
						</td>
                        <td>
							Rp. 1.631.080
						</td>
                        <td>
							orang
						</td>
						<td>
						Terlatihnya tenaga pendidik PAUD
						</td>
						<td > 
						Meningkatnya kualitas peserta didik PAUD
						</td>
                       <td class="tc-center">
							<div class="btn-toolbar" role="toolbar">
								<div class="btn-group" role="group">
                                      <a href="#" class="btn btn-info btn-sm m-user-delete">Usulkan</a>
								</div>
							</div>
						</td>
						
					</tr>
                   
					
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
    
   

</div>