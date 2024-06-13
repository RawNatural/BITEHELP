<?php



//MUST REMEMBER IF CHANGING PRICE to change it in checkout.php too at start and paypal part.
function addProduct($title, $price, $image, $descriptionHTML)
{
    echo "<div class='shop-grid-div'>
            <img class='shop-img' onclick='window.location.href=\"products/maia.php\"' src='$image'>
            <div class='shop-caption'>
                <div class='itemTitle'><h4 style='color: red; display: inline;'>BITE</h4><h4 style='display: inline; color: whitesmoke'>HELP</h4></div>
                <div class='priceDiv'>$<span class='price'>$price</span></div>
            
                <div class='buttons'>
                    <form method='post' action='checkout.php'>
                    <input type='number' id='quantity-selector' name='quantity-selector' min='1' value='";if (isset($_SESSION['quantity'])){$q = $_SESSION['quantity']; echo "$q";}else{echo"1";}  echo"' class='quantity-selector'>
                    <input value='Buy Now' type='submit' class='buyButton buyNowButton'  onclick='//window.location.href=\"checkout.php\"'>
                    </form>
                </div>
                
                <div class='description'>
                    $descriptionHTML
                </div>      
            </div>
        </div>";
}


?>


<?php $scriptList = array('js/jquery3.3.js', 'js/ShowHide.js', 'js/Cart.js', 'js/Reviews.js', 'js/ProductPhotoChange.js', 'js/cleaningTips.js');
    include("header.php");?>

<main>
    <div class='carousel'>
    <?php
        $title = "BITEHELP";
        $price = 20.99;
        $image = 'images/bitehelpmain.jpeg';
        $descriptionHTML = "<h4>Features</h4><ul>
<li>Use on itchy bite</li>
<li>Relieves urge to itch</li>
<li>Removes itchy bite</li>
<li>Quick and Effective</li>
<li>Easy to use</li>
<li>Battery powered</li>
<li>Re-usable</li>
</ul>";
        addProduct($title, $price, $image, $descriptionHTML);

    ?>



    <?php
    /*
    $productName = "Scarf Top";
    $images = array("images/scarfOne.jpg");
    $price = 20.99;
    $description = "A scarf top, to wear any way you like. Enjoy the versatility and nice colour that these will add to your look";


    addProduct($productName, $images, $price, $description, ""); */?>

    <?php
    /*$productName = "Scarf Top";
    $images = array("images/scarfOne.jpg");
    $price = 20.99;
    $description = "A scarf top, to wear any way you like. Enjoy the versatility and nice colour that these will add to your look";

    addProduct($productName, $images, $price, $description, "");

*/
    /**
    $productName = "Bamboo_Utensils_Travel_Pack";
    $images = array("images/utensilsCamo.jpg","images/utensilsMain.jpg", "images/utensilsPurple.jpg", "images/utensilsCamo.jpg");
    $price = 12.99;
    $description = "<p><strong>Utensils on the go</strong></p><p>Store easily, and fold out to eat.</p><p>Strong, sturdy, and easy to wash.</p>";

    addProduct($productName, $images, $price, $description, "");
    ?>


    <?php
    $productName = "Bamboo_Drinking_Straws";
    $images = array("images/BambooStrawsMain.jpg", "images/BambooStrawsMain.jpg", "images/BambooStrawsAndBrush.jpg", "images/strawsEnds.jpeg");
    $price = 9.99;
    $description = "<p><strong>Get in now on the new trend!</strong></p>
        <p>Bamboo straws feel and look spectacular. Help <strong>get rid of the millions of plastic straws</strong> that are polluting our oceans and land.</p>
        <p>Our bamboo straws are <strong>durable</strong> and <strong>easy to store</strong>. Take them with you wherever you go so that you never need to use another plastic straw.</p>
        <p>Our straws are completely Eco-Friendly! They are <strong>100% Biodegradable</strong> and <strong>Compostable</strong>; their components will break down into smaller particles and nutrients when left in the environment.</p>
        <p>They can be <strong>reused</strong> many times and will <strong>last several months</strong> if cared for.</p>";
    $anythingElse = "<div id='cleaningTips'><h4>Cleaning Tips</h4></div>
<p>Length: 19.5cm. Inner diameter: 4-5mm. </p>";

    addProduct($productName, $images, $price, $description, $anythingElse);

    ?>



<?php
$productName= "Bamboo_Toothbrush";
$images = array("images/toothbrushMain.jpg", "images/toothbrushMain.jpg");
$price = 3.99;
$description = "<p>Brush your teeth with an environmentally friendly toothbrush.</p><p>With charcoal-infused brushes to help remove stains and leave your teeth whiter than ever</p>";

addProduct($productName, $images, $price, $description, "");
*/?>
    </div>

    <div class="shop-contact-form">
            <?php include('contactForm.php')?>
    </div>
</main>


        <footer>
            <?php include("footer.php"); ?>
        </footer>

    </body>
</html>