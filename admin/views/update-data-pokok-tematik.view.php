<?php
include 'views/partials/starter-head.php';
include 'views/partials/alert-tambah-data.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nama_data = $_POST["nama_data"];

    $sql = "UPDATE data_tematik SET nama_data='$nama_data' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Data updated successfully.";
    } else {
        $message = "Error updating data: " . $conn->error;
    }
}

?>
<div class="container-fluid">
    <h1 class="mt-5 mb-2 text-center text-dark">Update data pokok tematik</h1>
    <div class="row w-75 m-auto">
        <div id="search-container" class="table-responsive mt-3">
            <table class="table table-striped m-auto mt-5">
                <thead>
                    <tr class="fofa">
                        <th scope="col">No</th>
                        <th scope="col">Nama Data</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($getdata as $a) : ?>
                        <tr>
                            <th class="=" scope="row"><?= $i++; ?></th>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                                    <input class="bg-transparent border-0 px-1 <?= empty($message) ? 'editable' : ''; ?>" type="text" name="nama_data" value="<?= $a['nama_data']; ?>" <?php if (!empty($message)) echo 'readonly'; ?>>
                            </td>
                            <td>
                                <?php if (empty($message)) : ?>
                                    <a class="text-warning me-2 edit-icon" href="#"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <button type="submit" class="text-primary btn save-icon" name="save"><i class="fa-solid fa-floppy-disk"></i></button>
                                <?php endif; ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php include 'views/partials/script.php' ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        const editIcons = document.querySelectorAll(".edit-icon");
        const inputFields = document.querySelectorAll("input.editable");

        editIcons.forEach((editIcon, index) => {
            editIcon.addEventListener("click", (event) => {
                event.preventDefault(); // Mencegah tindakan default dari link
                inputFields[index].removeAttribute("readonly");
                inputFields[index].focus();
            });
        });

        <?php if (!empty($message)) : ?>
            <?php if (strpos($message, "successfully") !== false) : ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '<?= $message; ?>',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'update-data-pokok-tematik'; // Ganti dengan URL halaman tujuan
                    }
                });
            <?php else : ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '<?= $message; ?>',
                });
            <?php endif; ?>
        <?php endif; ?>
    });
</script>

<?php include 'views/partials/starter-foot.php' ?>