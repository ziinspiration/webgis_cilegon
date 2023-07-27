<?php
require_once 'functions/functions.php';

$getAdmin = query("SELECT * FROM administrasi");

// $JSONprasaranaMarker = query("SELECT * FROM prasarana
//     JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis
//     JOIN jenis_file ON prasarana.id_jenis = jenis_file.jenis_file_id
//     WHERE  prasarana.id_jenis = 1");

// $JSONprasaranaPolygone = query("SELECT * FROM prasarana
//     JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis
//     JOIN jenis_file ON prasarana.id_jenis = jenis_file.jenis_file_id
//     WHERE  prasarana.id_jenis = 2");

// $JSONprasaranaPolyline = query("SELECT * FROM prasarana
//     JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis
//     JOIN jenis_file ON prasarana.id_jenis = jenis_file.jenis_file_id
//     WHERE  prasarana.id_jenis = 3");

$JSONprasarana = query("SELECT * FROM prasarana WHERE id_jenis_prasarana NOT IN (1, 2) ORDER BY id_jenis = 3 DESC, id_jenis ASC");

$JSONprasaranaPersampahan = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Persampahan'");
$JSONprasaranaAirbersih = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Air bersih'");

// POINT
$JSONkantor = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perkantoran' AND id_jenis_sarana = 1");
$JSONpendidikan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pendidikan' AND id_jenis_sarana = 1");
$JSONkesehatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Kesehatan'  AND id_jenis_sarana = 1");
$JSONpariwisata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pariwisata & Hiburan'  AND id_jenis_sarana = 1");
$JSONperibadatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Peribadatan'  AND id_jenis_sarana = 1");
$JSONtransportasi = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Sistem transportasi'  AND id_jenis_sarana = 1");
$JSONfasilitasolahraga = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Fasilitas olahraga'  AND id_jenis_sarana = 1");
$JSONperdagangan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perdagangan & Perniagaan'  AND id_jenis_sarana = 1");
$JSONpemakaman = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Tempat pemakaman umum' AND id_jenis_sarana = 1");
// ZONASI
$ZONASIkantor = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perkantoran' AND id_jenis_sarana = 2");
$ZONASIpendidikan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pendidikan' AND id_jenis_sarana = 2");
$ZONASIkesehatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Kesehatan'  AND id_jenis_sarana = 2");
$ZONASIpariwisata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pariwisata & Hiburan'  AND id_jenis_sarana = 2");
$ZONASIperibadatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Peribadatan'  AND id_jenis_sarana = 2");
$ZONASItransportasi = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Sistem transportasi'  AND id_jenis_sarana = 2");
$ZONASIfasilitasolahraga = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Fasilitas olahraga'  AND id_jenis_sarana = 2");
$ZONASIperdagangan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perdagangan & Perniagaan'  AND id_jenis_sarana = 2");
$ZONASIpemakaman = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Tempat pemakaman umum' AND id_jenis_sarana = 2");

$nama_halaman = 'Map spasial';
$linkcss = 'spasial.css';
require 'views/mapSpasial.view.php';
