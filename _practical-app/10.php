<?php include "functions.php" ?>
<?php include "includes/header.php" ?>
<section class="content">

	<aside class="col-xs-4">

		<?php Navigation();?>
			
			
	</aside><!--SIDEBAR-->

<article class="main-content col-xs-8">

	
	<?php  

//      Step 1: Use the Make a class called Dog
class  Dog {
    var $eye = 'blue';
    var $nose = 'big';
    var $fur = 'unknown';

    function showAll()
    {
        echo $this->eye.' '.$this->nose. ' '.$this->fur;
    }
}
//		Step 2: Set some properties for Dog, Example, eye colors, nose, or fur color

//		Step 4: Make a method named ShowAll that echos all the properties

//		Step 5: Instantiate the class / create object and call it pitbull
$pitbull = new Dog();
//      Step 6: Call the method ShowAll
$pitbull->showAll();

	?>





</article><!--MAIN CONTENT-->

<?php include "includes/footer.php" ?>