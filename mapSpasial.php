<?php
require_once 'functions/functions.php';

$getAdmin = query("SELECT * FROM administrasi");
$JSONprasarana = query("SELECT * FROM prasarana");
$JSONkantor = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Kantor'");
$JSONpendidikan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Pendidikan'");
$JSONkesehatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Kesehatan'");
$JSONpariwisata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Pariwisata & Hiburan'");
$JSONperibadatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Peribadatan'");
$JSONtransportasi = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Transportasi'");
$JSONfasilitasumum = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori WHERE nama_kategori = 'Fasilitas umum'");

$nama_halaman = 'Map spasial';
$linkcss = 'spasial.css';
require 'views/mapSpasial.view.php';
