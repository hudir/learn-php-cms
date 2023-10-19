
<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

	<section class="content">

		<aside class="col-xs-4">
		
		<?php Navigation();?>
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">
 <form action="6.php" method="post">
     <input name="todo" type="text" placeholder="what next">
     <input type="submit" name="add">
 </form>

	<?php  

/*  Step1: Make a form that submits one value to POST super global
 */
    $todos = array();
if (strlen($_POST['todo']) > 0) {
    $todos[] = $_POST['todo'];
}

for ($x=0; $x<$todos; $x++){
    echo $todos[$x]."<br>";
}
	
?>


</article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>

