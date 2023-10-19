<?php include "functions.php" ?>
<?php include "includes/header.php" ?>



	<section class="content">

		<aside class="col-xs-4">

		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


			<article class="main-content col-xs-8">
			
		
	
	<?php 

//	 Create a link saying Click Here, and set
//	the link href to pass some parameters and use the GET super global to see it
$param = ":whoAreYou";
echo "<a href='9.php?id=$param' >Click me to see the '\n$ _GET'</a><br>";
print_r($_GET);
//		Step 2 - Set a cookie that expires in one week
setcookie('one', 'nicetomeetyou', 60*60*24*7 + time());
if(isset($_COOKIE['one'])) echo '<br>'.$_COOKIE['one'];
//		Step 3 - Start a session and set it to value, any value you want.
    session_start();
    if(isset($_SESSION['assoc']))    $_SESSION['assoc'] = 'This is called associated array?';
    echo '<br>'.$_SESSION['assoc'];
	
	?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>