<?php
echo "<div class='container p-3'><h1 class='text-center'>Our Financial Plan</h1>";
echo "<br>";
$connect = mysqli_connect('localhost', 'root', '', 'familyIncomingCalc');
if(!$connect) {
    echo "<br>Connect to DB error<br>";
}

if (isset($_POST['incoming'])) {
    $peiIncome=$_POST['peiIncome'];
    $zhuoIncome=$_POST['zhuoIncome'];
    $harperIncome=$_POST['harperIncome'];
    $linghuaqian=$_POST['lingHuaQian'];
    if ($peiIncome) {
        $query_update = "UPDATE income SET mouthly = $peiIncome where name='Pei'";
        mysqli_query($connect, $query_update) ;
    }
    if ($zhuoIncome) {
        $query_update = "UPDATE income SET mouthly = $zhuoIncome where name='Zhuo'";
        mysqli_query($connect, $query_update) ;
    }
    if ($harperIncome) {
        $query_update = "UPDATE income SET mouthly = $harperIncome where name='Harper'";
        mysqli_query($connect, $query_update) ;
    }
    if ($linghuaqian) {
        $query_update = "UPDATE income SET linghuaqian = $linghuaqian where name='Pei' OR name = 'Zhuo'";
        mysqli_query($connect, $query_update) ;
    }
} elseif (isset($_POST['zhichu'])) {
    $new = $_POST['xiangmu'];
    $pri = $_POST['price'];
    $query_add_zhichu = "INSERT INTO pay(zhichu, price) VALUES ('$new', $pri)";
    $result = mysqli_query($connect, $query_add_zhichu) ;
} elseif (isset($_POST['updatePay'])) {

    $id=$_POST['zhichuSelect'];

    if(strlen($_POST['newzhichu']) > 0) {
        $newzhichu=$_POST['newzhichu'];
        $query = "UPDATE pay SET zhichu='$newzhichu' WHERE id=$id";
        $result = mysqli_query($connect, $query);
    } elseif ($_POST['newprice'] > -1) {
        $newprice=$_POST['newprice'];
        $query = "UPDATE pay SET price=$newprice WHERE id=$id";
        $result = mysqli_query($connect, $query);
    }
    if (!$result) {
        die("Query FAILED" .mysqli_error($connect));
    }
}


$lingHuaQianPei = 0;
$lingHuaQianZhuo = 0;
$totalIncoming = 0;
$totalRest = 0;

$query_read_all_income = "SELECT * FROM income;";
$income = mysqli_query($connect, $query_read_all_income);
echo "<div class='text-center  border-top border-bottom border-secondary py-3'><h2>Total Income</h2><ul>";
while ($row = mysqli_fetch_assoc($income)) {
    echo "<li>".$row['name']. ": " . $row['mouthly'] . " Euro</li>";
    $totalIncoming += $row['mouthly'];
    if ($row['name'] === 'Zhuo') {
        $lingHuaQianZhuo = $row['linghuaqian'] * $row['mouthly'] / 100;
    } elseif ($row['name'] === 'Pei') {
        $lingHuaQianPei = $row['linghuaqian'] * $row['mouthly'] / 100;
    }
}
echo "</ul>";
echo 'Total Income one month: <b>'.$totalIncoming.'</b> EURO <br>';
echo '零花钱 Pei: <b>'.$lingHuaQianPei.'</b> EURO <br>';
echo '零花钱 Zhuo: <b>'.$lingHuaQianZhuo.'</b> EURO <br>';
$totalRest = $totalIncoming - $lingHuaQianPei - $lingHuaQianZhuo;
echo 'Total Rest Money one month: <b>'.$totalRest.'</b> EURO <br><br></div>';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<div>

<?php
$query_read_all_pay = "SELECT * FROM pay;";
$pay = mysqli_query($connect, $query_read_all_pay);
echo "<div class='border-bottom border-secondary py-3 my-2'><h2>支出</h2><ul>";
while ($row = mysqli_fetch_assoc($pay)) {
    echo "<li>".$row['zhichu']. ": " . $row['price'] . "</li>";
    $totalRest -= $row['price'];
}
echo "</ul>";
echo 'Total Rest Money one month: <b>'.$totalRest.'</b> EURO <br><br></div>';
?>

<form action="familyFinacePlan.php" method="post" class="container text-center  border-bottom border-secondary py-3 my-3">
    <h3>Add New 支出</h3>
    <label>支出项目</label>
    <input type="text" name="xiangmu">
    <label>Price</label>
    <input type="number" step="0.01" name="price">
    <input type="submit" name="zhichu" value="Add 支出项目" class="btn btn-danger">
</form>



<?php
function showAllxuanxiang(){
    global $connect;
    $query="SELECT * FROM pay;";
    $result = mysqli_query($connect, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $zhichu = $row['zhichu'];
        echo "<option value='$id'>$zhichu</option>";
    }
}
?>
<form action="familyFinacePlan.php" method="post" class="container text-center border-bottom border-secondary py-3 my-3">
    <div class="form-group px-5 text-center">
        <h4 for=""  class="form-label">Update 支出项目</h4>
        <select name="zhichuSelect" id="" class="form-select w-50 mx-auto">
            <?php
            showAllxuanxiang();
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="username"  class="form-label">支出项目 Name</label>
        <input type="text" name="newzhichu" class="from-control">
    </div>

    <div class="form-group">
        <label for=""  class="form-label">New Price</label>
        <input type="number" step="0.01" name="newprice" class="from-control">
    </div>

    <input type="submit" name="updatePay" value="Update Pay" class="btn btn-info">
</form>




<form action="familyFinacePlan.php" method="post" class="container text-center border-bottom border-secondary py-3 my-3">
    <h4 class="text-center">Update income data</h4>
    <div class="row">
        <div class="col-6">
            <h5>Pei</h5>
            <label>Incoming</label>
            <input type="number" placeholder="" name="peiIncome"/>

        </div>

        <div class="col-6">
            <h5>Zhuo</h5>
            <label>Incoming</label>
            <input type="number" placeholder="" name="zhuoIncome" />

        </div>
    </div>

    <div class="row my-3">
        <div class="col-6">
            <h5>零花钱</h5>
            <input type="number" placeholder="" name="lingHuaQian"/><label>%</label>
        </div>

        <div class="col-6">
            <h5>Harper</h5>
            <label>Incoming</label>
            <input type="number" placeholder="" name="harperIncome" />

        </div>
    </div>

    <input type="submit" name="incoming" class="btn btn-info"/>
</form>
</div>


</body>
</html>








