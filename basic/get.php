<?php
echo "super globel GET<br>";
echo "<br>";

print_r($_GET);
echo "<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php
$id = 154;
$btnText = "Do not Click Me!";
?>

<a href="get.php?id=<?php echo $id; ?>" class="btn btn-secondary"><?php echo $btnText; ?></a>



</body>
</html>








