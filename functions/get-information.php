<?php

$getinstagram = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'instagram'");
$getyoutube = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'youtube'");
$gettwitter = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'twitter'");
$getfacebook = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'facebook'");
$getmarquee = query("SELECT * FROM informasi_bappeda WHERE jenis_informasi ='marquee'");
$getalamat = query("SELECT * FROM informasi_bappeda WHERE nama_data ='Alamat'");
$getemail = query("SELECT * FROM informasi_bappeda WHERE nama_data ='Email'");
$gettelp = query("SELECT * FROM informasi_bappeda WHERE nama_data ='Nomor telepon'");
$getkoordinat = query("SELECT * FROM informasi_bappeda WHERE nama_data ='Koordinat'");
