<?php
require_once 'functions/functions.php';

$getAdmin = query("SELECT * FROM administrasi");
$JSONprasarana = query("SELECT * FROM prasarana");
$JSONkantor = query("SELECT * FROM sarana WHERE kategori = 'Kantor'");
$JSONpendidikan = query("SELECT * FROM sarana WHERE kategori = 'Pendidikan'");
$JSONkesehatan = query("SELECT * FROM sarana WHERE kategori = 'Kesehatan'");
$JSONpariwisata = query("SELECT * FROM sarana WHERE kategori = 'Pariwisata'");
$JSONperibadatan = query("SELECT * FROM sarana WHERE kategori = 'Peribadatan'");
$JSONtransportasi = query("SELECT * FROM sarana WHERE kategori = 'Transportasi'");
$JSONfasilitasumum = query("SELECT * FROM sarana WHERE kategori = 'Fasilitas umum'");

$nama_halaman = 'Map spasial';
$linkcss = 'spasial.css';
require 'views/mapSpasial.view.php';
