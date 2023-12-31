<?php
require_once 'functions/functions.php';
// SEARCH
$getsearchtematik = query("SELECT * FROM tematik WHERE hide = 1");
$getsearchrencana = query("SELECT * FROM rencana WHERE hide = 1");
$getsearchadministrasi = query("SELECT * FROM administrasi WHERE hide = 1");
$getsearchsarana = query("SELECT * FROM sarana WHERE hide = 1");
$getsearchprasarana = query("SELECT * FROM prasarana WHERE hide = 1");

// DATA ADMINISTRASI
$getAdmin = query("SELECT * FROM administrasi WHERE hide = 1");

// DATA TEMATIK
$getTematik = query("SELECT * FROM tematik WHERE kategori = '2' AND hide = 1 ORDER BY nama_tematik ASC");
$getBencana = query("SELECT * FROM tematik WHERE kategori = '1' AND hide = 1 ORDER BY nama_tematik ASC");
$icontematik = "
    (
        SELECT * FROM tematik
        WHERE kategori = '2' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM tematik
        WHERE kategori = '1' AND hide = 1
    )
    ORDER BY nama_tematik ASC;
";

$gettematikicon = query($icontematik);

// DATA PRASARANA
$JSONprasaranaPersampahan = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Persampahan' AND hide = 1 ORDER BY nama_prasarana ASC");
$JSONprasaranaAirbersih = query("SELECT * FROM prasarana JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis WHERE nama_jenis = 'Air bersih' AND hide = 1 ORDER BY nama_prasarana ASC");
$JSONprasarana = query("SELECT * FROM prasarana WHERE id_jenis_prasarana = 3 AND hide = 1");
$JSONjalanstatus = query("SELECT * FROM prasarana WHERE id_jenis_prasarana = 5 AND hide = 1");
$JSONjalanfungsi = query("SELECT * FROM prasarana WHERE id_jenis_prasarana = 6 AND hide = 1");
$JSONjalankondisi = query("SELECT * FROM prasarana WHERE id_jenis_prasarana = 7 AND hide = 1");
$iconprasarana = "
    (
    SELECT prasarana.* FROM prasarana
    JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis
    WHERE jenis_prasarana.nama_jenis = 'Persampahan' AND prasarana.hide = 1
    )
    UNION ALL
    (
        SELECT prasarana.* FROM prasarana
        JOIN jenis_prasarana ON prasarana.id_jenis_prasarana = jenis_prasarana.id_jenis
        WHERE jenis_prasarana.nama_jenis = 'Air bersih' AND prasarana.hide = 1
    )
    UNION ALL
    (
    SELECT * FROM prasarana
    WHERE id_jenis_prasarana = 3 AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM prasarana
        WHERE id_jenis_prasarana = 5 AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM prasarana
        WHERE id_jenis_prasarana = 6 AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM prasarana
        WHERE id_jenis_prasarana = 7 AND hide = 1
    )
    ORDER BY nama_prasarana ASC;
";

$getprasaranaicon = query($iconprasarana);

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
$iconsarana = "
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Perkantoran' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Pendidikan' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Kesehatan' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Pariwisata & Hiburan' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Peribadatan' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Sistem transportasi' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Fasilitas olahraga' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Perdagangan & Perniagaan' AND hide = 1
    )
    UNION ALL
    (
        SELECT * FROM sarana
        JOIN kategori_data ON sarana.kategori_id = kategori_data.id_kategori
        JOIN jenis_sarana ON sarana.id_jenis_sarana = jenis_sarana.id_jenis
        WHERE nama_kategori = 'Tempat pemakaman umum' AND hide = 1
    )
    ORDER BY nama_sarana ASC;
";

$getsaranaicon = query($iconsarana);

$nama_halaman = 'Tematik';
$linkcss = 'spasial.css';
require 'views/tematik.view.php';
