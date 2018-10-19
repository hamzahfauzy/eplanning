<div style="text-align:justify;padding-left:50px;padding-right:50px;">
	<p align="center">
		BERITA ACARA<br>
		KESEPAKATAN HASIL FORUM OPD............ <br>
		KABUPATEN/KOTA ................. <br><br>
	</p>
	<p>
		Pada  hari.........tanggal  ……sampai  dengan  hari……tanggal…….  bulan  ……  tahun  …………  telah diselenggarakan  forum  OPD  ...........kabupaten/kota  ..........  yang  dihadiri  pemangku  kepentingan  sesuai dengan daftar hadir sebagaimana tercantum dalam LAMPIRAN I berita acara ini.
	</p>
	<p>
		Setelah memperhatikan, mendengar dan mempertimbangkan :
	</p>
	<ol>
		<li style="padding-bottom:10px">
			Pemaparan materi (disesuaikan  dengan materi dan nama pejabat yang menyampaikan)
		</li>
		<li>
			Tanggapan dan saran dari seluruh peserta forum OPD kabupaten/kota terhadap materi yang dipaparkan oleh masing-masing ketua kelompok diskusi sebagaimana telah dirangkum menjadi hasil keputusan kelompok diskusi, maka pada: 
			<p>
				<table>
					<tr>
						<td>Hari dan Tanggal </td>
							<?php 
								$tanggal = explode('-', $nilai['tanggal']); 
								$bulan = ["Januari","Februari","Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober", "November","Desember"];
							?>
						<td> :  &emsp;<?=$tanggal[2]." ".$bulan[$tanggal[1]-1]." ".$tanggal[0]?> </td>
					</tr>
					<tr>
						<td> Jam  </td>
						<td> :  &emsp;<?=$nilai['waktu']?> </td>
					</tr>
					<tr>
						<td>Tempat  </td>
						<td> :  &emsp;<?=$nilai['tempat']?> </td>
					</tr>
				</table>
			</p>
		</li>
	</ol>
	<p style="padding-left:70px;">Forum OPD ................Kabupaten/kota*) ….....Tahun....... :</p>
	<p align="center" style="padding:10px;">MENYEPAKATI</p>
	<table style="text-align:justify;">
		<tr>
			<td valign="top" style="padding-right:30px;"><p>KESATU </p></td><td valign="top" ><p> :&emsp;</p></td>
			<td style="padding-bottom:10px"><p>Menyepakati program dan kegiatan prioritas, dan indikator kinerja yang disertai target dan kebutuhan pendanaan, yang telah diselaraskan dengan usulan kegiatan prioritas dari musrenbang RKPD kabupaten/kota di kecamatan;</p></td>
		</tr>
		<tr>
			<td valign="top" ><p>KEDUA </p></td><td valign="top" ><p> :&emsp;</p></td>
			<td style="padding-bottom:10px"><p>Menyepakati rancangan Renja OPD …… kabupaten/kota ...*) Tahun .... sebagaimana tercantum dalam LAMPIRAN II berita acara ini..</p></td>
		</tr>
		<tr>
			<td valign="top" ><p>KETIGA  </p></td><td valign="top" ><p> :&emsp;</p></td>
			<td style="padding-bottom:10px"><p>Menyepakati daftar usulan program dan kegiatan lintas OPD dan lintas wilayah sebagaimana tercantum dalam LAMPIRAN II berita acara ini.</p></td>
		</tr>
		<tr>
			<td valign="top" ><p>KEEMPAT  </p></td><td valign="top" ><p> :&emsp;</p></td>
			<td style="padding-bottom:10px"><p>Menyepakati berita acara ini beserta lampirannya (LAMPIRAN I,II,III), merupakan satu kesatuan dan merupakan bagian yang tidak terpisahkan dari berita acara hasil kesepakatan forum OPD …. kabupaten/kota *).... ini</p></td>
		</tr>
		<tr>
			<td valign="top" ><p>KELIMA  </p></td><td valign="top" ><p> :&emsp;</p></td>
			<td style="padding-bottom:10px"><p>Berita acara ini beserta lampirannya dijadikan sebagai bahan penyempurnaan rancangan RKPD kabupaten/kota *) Tahun ….</p></td>
		</tr>
	</table>
	<br>
	<p align="center">Demikian berita acara ini dibuat dan disahkan untuk digunakan sebagaimana mestinya. </p>
	<table width="100%">
		<tr>
			<td width="60%"></td>
			<td width="40%" align="center">
				<p>
			Tanggal <?=date('j')." ".$bulan[date('n')-1]." ".date('Y')?><br>
				Pimpinan Sidang <br>
				( <?=$nilai['jabatan']?> ) <br><br><br>
				Tanda tangan <br>
				( <?=$nilai['nama']?> ) <br>
				</p>
			</td>
		</tr>
	</table>
	<p align="center"><br>Menyetujui, <br>
	Wakil Peserta Forum OPD Kabupaten/Kota <br><br><br><br><br><br><br>
	</p>
	<table width="100%" border="1">
		<tr>
			<th align="center" style="padding-bottom:5px;padding-top:5px;">NO</th>
			<th align="center">Nama</th>
			<th align="center">Unsur Perwakilan</th>
			<th align="center">Alamat</th>
			<th align="center">Tanda Tangan</th>
		</tr>
		<tr>
			<td align="center" style="padding-left:5px;padding-bottom:5px;padding-top:5px;">1</td>
			<td style="padding-left:5px;padding-bottom:5px;padding-top:5px;"></td>
			<td style="padding-left:5px;padding-bottom:5px;padding-top:5px;"></td>
			<td style="padding-left:5px;padding-bottom:5px;padding-top:5px;"></td>
			<td style="padding-left:5px;padding-bottom:5px;padding-top:5px;"></td>
		</tr>
	</table>
	<br>
 
</div>