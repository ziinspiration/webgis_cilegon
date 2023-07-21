<?php

$getinstagram = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'instagram'");
$getyoutube = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'youtube'");
$gettwitter = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'twitter'");
$getfacebook = query("SELECT * FROM informasi_bappeda WHERE nama_data = 'facebook'");
$getmarquee = query("SELECT * FROM informasi_bappeda WHERE jenis_informasi ='marquee'");
