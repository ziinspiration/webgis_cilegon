<?php
require '../functions/functions.php';
$keyword = $_GET['keyword'];
$id = $_GET['id']; // Add this line to fetch the 'id' parameter
$query = "SELECT * FROM atribut_prasarana 
JOIN data_prasarana ON atribut_prasarana.data_pokok_id = data_prasarana.id 
WHERE atribut_prasarana.data_pokok_id = $id AND 
      (
      data3 LIKE '%$keyword%' OR data6 LIKE '%$keyword%' OR 
      data1 LIKE '%$keyword%' OR data2 LIKE '%$keyword%' OR 
      data5 LIKE '%$keyword%' OR
      data4 LIKE '%$keyword%'
      )";

$getdata = query($query);
?>

<?php if ($getdata) : ?>
    <table class="table table-striped m-auto mt-1">
        <thead>
            <tr class="fofa">
                <th scope="col">data1</th>
                <th scope="col">data2</th>
                <th scope="col">data3</th>
                <?php if (!empty($getdata[0]['data4'])) : ?>
                    <th scope="col">data4</th>
                <?php endif; ?>
                <th scope="col">data5</th>
                <th scope="col">data6</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getdata as $a) : ?>
                <tr>
                    <td><?= $a['data1']; ?></td>
                    <td><?= $a['data2']; ?></td>
                    <td><?= $a['data3']; ?></td>
                    <?php if (!empty($a['data4'])) : ?>
                        <td><?= $a['data4']; ?></td>
                    <?php endif; ?>
                    <td><?= $a['data5']; ?></td>
                    <td><?= $a['data6']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else :  ?>
    <div class="row">
        <div class="col-md-6 m-auto mt-5 text-center">
            <div class="alert alert-danger p-3" role="alert">
                Data not found!
            </div>
        </div>
    </div>
<?php endif; ?>