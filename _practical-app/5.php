<?php include "functions.php" ?>
<?php include "includes/header.php" ?>
	<section class="content">

		<aside class="col-xs-4">
		<?php Navigation();?>
			
			
		</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

	
	<?php 


/*  Step1: Use a pre-built math function here and echo it


	Step 2:  Use a pre-built string function here and echo it


	Step 3:  Use a pre-built Array function here and echo it

 */
echo sqrt(21)."<br>";
echo strtoupper("ich bin hudir")."<br>";
echo max([1,2,3])."<br>";

$nums=[1,2,3];
if (in_array(1, $nums)) {
    echo "found it";
}
?>





</article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>