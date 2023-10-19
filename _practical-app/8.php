<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

    <section class="content">

    <aside class="col-xs-4">

        <?php Navigation(); ?>


    </aside><!--SIDEBAR-->


    <article class="main-content col-xs-8">


        <?php

//        Step 1 - Make a variable with some text as value
$text = "carzytext";
//		Step 2 - use crypt() function to encrypt it
$salt = "thisisthesupercreateicanottellyou";
$fromat = "$2y$10$";
$encryptText = crypt($text, $fromat.$salt);
//		Step 3 - Assign the crypt result to a variable
//		Step 4 - echo the variable
echo $encryptText;

	
	?>


    </article><!--MAIN CONTENT-->
<?php include "includes/footer.php" ?>