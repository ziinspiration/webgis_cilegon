<?php

require 'functions.php';
$id = $_GET['id'];

$count = countAdministrasi();

if ($count == 1) {
    echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Tidak dapat menghapus data',
                text: 'Minimal harus ada 1 data tersisa.',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../ubah-administrasi';
                }
            });
        </script>";
} else {
    if (deleteAdministrasi($id) > 0) {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil dihapus',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../ubah-administrasi';
                    }
                });
            </script>";
    } else {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Data Gagal dihapus',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '../ubah-administrasi';
                    }
                });
            </script>";
    }
}
