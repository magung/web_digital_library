<?php
//variabel koneksi
// $koneksi = mysqli_connect("sql304.epizy.com","epiz_26666079","EPujHojaFti","epiz_26666079_digital_library");
$koneksi = mysqli_connect("localhost","root","","digital_library");

if(!$koneksi){
	echo "Koneksi Database Gagal...!!!";
}
?>