<?php include "functions.php" ?>
<?php include "includes/header.php" ?>

	<section class="content">

	<aside class="col-xs-4">

	<?php Navigation();?>
			
	</aside><!--SIDEBAR-->


<article class="main-content col-xs-8">

<?php  

/*  Step1: Make an if Statement with elseif and else to finally display string saying, I love PHP

	Step 2: Make a forloop  that displays 10 numbers

	Step 3 : Make a switch Statement that test againts one condition with 5 cases
 */
if(false){}
elseif (false){}
else{
    echo "I love PHP<br>";
}

for($num=0; $num<10; $num++){
    echo "$num<br>";
}

$vari = 55;
switch($vari) {
    case 1:
        echo "is now 1";
        break;
    case 2:
        echo "is now 2";
        break;
    case 3:
        echo "is now 3";
        break;
    case 4:
        echo "is now 4";
        break;
    case 5:
        echo "is now 5";
        break;
    default:
        echo "is out of 1-5";
        break;
}
	
?>






</article><!--MAIN CONTENT-->
	
<?php include "includes/footer.php" ?>