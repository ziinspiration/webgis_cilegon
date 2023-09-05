<?php
require_once 'functions/functions.php';

// DATA ADMINISTRASI
$getAdmin = query("SELECT * FROM administrasi WHERE hide = 1");

// DATA TEMATIK
$getTematik = query("SELECT * FROM tematik WHERE kategori = '2' AND hide = 1 ORDER BY nama_tematik ASC");
$getBencana = query("SELECT * FROM tematik WHERE kategori = '1' AND hide = 1 ORDER BY nama_tematik ASC");

// DATA PRASARANA
$JSONjalan = query("SELECT * FROM prasarana WHERE id_jenis = 3 AND hide = 1");
$JSONprasarana = query("SELECT * FROM prasarana WHERE id_jenis_prasarana NOT IN (1, 2) AND id_jenis <> 3 AND hide = 1");
$JSONprasaranaPersampahan = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Persampahan' AND hide = 1 ORDER BY nama_prasarana ASC");
$JSONprasaranaAirbersih = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Air bersih' AND hide = 1 ORDER BY nama_prasarana ASC");

// DATA POINT SARANA
$JSONkantor = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perkantoran' AND id_jenis_sarana = 1 AND hide = 1");
$JSONpendidikan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pendidikan' AND id_jenis_sarana = 1 AND hide = 1");
$JSONkesehatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Kesehatan' AND id_jenis_sarana = 1 AND hide = 1");
$JSONpariwisata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pariwisata & Hiburan' AND id_jenis_sarana = 1 AND hide = 1");
$JSONperibadatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Peribadatan' AND id_jenis_sarana = 1 AND hide = 1");
$JSONtransportasi = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Sistem transportasi' AND id_jenis_sarana = 1 AND hide = 1");
$JSONfasilitasolahraga = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Fasilitas olahraga' AND id_jenis_sarana = 1 AND hide = 1");
$JSONperdagangan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perdagangan & Perniagaan' AND id_jenis_sarana = 1 AND hide = 1");
$JSONpemakaman = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Tempat pemakaman umum' AND id_jenis_sarana = 1 AND hide = 1");

// DATA ZONASI SARANA
$ZONASIkantor = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perkantoran' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIpendidikan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pendidikan' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIkesehatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Kesehatan' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIpariwisata = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Pariwisata & Hiburan' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIperibadatan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Peribadatan' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASItransportasi = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Sistem transportasi' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIfasilitasolahraga = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Fasilitas olahraga' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIperdagangan = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Perdagangan & Perniagaan' AND id_jenis_sarana = 2 AND hide = 1");
$ZONASIpemakaman = query("SELECT * FROM sarana JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis WHERE nama_kategori = 'Tempat pemakaman umum' AND id_jenis_sarana = 2 AND hide = 1");

// LEGENDA
$getlegendasarana = query("SELECT * FROM sarana WHERE id_jenis_sarana = 1 AND hide = 1");
$getlegendaprasarana = query("SELECT * FROM prasarana WHERE id_jenis = 1 AND hide = 1");

$nama_halaman = 'Tematik';
$linkcss = 'spasial.css';
require 'views/tematik.view.php';
