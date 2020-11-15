<?php
	//variabel koneksi
	//$koneksi = mysqli_connect("localhost","id14788998_admin","dZ@&4P&2SW4I3cLl","id14788998_digital_library");
	$koneksi = mysqli_connect("localhost","root","","digital_library");

	if(!$koneksi){
		echo "Koneksi Database Gagal...!!!";
	}
?>