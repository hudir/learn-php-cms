<?php include "functions.php" ?>
<?php include "includes/header.php" ?>
    

	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


	<article class="main-content col-xs-8">
	
	
	
	<?php  

//Step 1 - Create a database in PHPmyadmin
$connect = mysqli_connect('localhost','root', '');
    if(!$connect) {
        $error = mysqli_connect_error();
        echo "<br>Connect to DB error<br> . $error";
    }
    $query_create_db = "CREATE DATABASE IF NOT EXISTS randomNumApp;";
    $result = mysqli_query($connect, $query_create_db) ;
    echo " create db";
    $qry_select_db = "USE randomNumApp;";
    $result = mysqli_query($connect, $qry_select_db);
    echo " ues db";

//Step 2 - Create a table like the one from the lecture
    $query_create_table = "CREATE TABLE IF NOT EXISTS nums(id INT , num INT);";
    $result = mysqli_query($connect, $query_create_table);
    echo " create table";

//Step 3 - Insert some Data
    $randomNum = rand(1, 99);
    $query_insert = "INSERT INTO nums(num) VALUES ($randomNum);";
    $result = mysqli_query($connect, $query_insert);
    echo " insert a random number ".$randomNum ." to db";
//Step 4 - Connect to Database and read data
    $query_read_all_data = "SELECT * FROM nums;";
    $result = mysqli_query($connect, $query_read_all_data);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }








	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php" ?>
