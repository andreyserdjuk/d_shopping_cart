<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'DShoppingCart.php';

/**
 * As assumed, ShoppingCart is a list of products collected for creating 
 * an Order. Being that checkout process may include additional functionality,
 * such as cross-sales, promotions etc. it would be better to store ShoppingCart
 * content in the session or DB. All Orders stored in DB too.
 */

/**
 * Prepare mock of Product (it must implement some interface but I really have no time)
 */
$productId = 1;
$product = new Product($productId);
$product->setName('LG G3');
$product->setPrice(6900);

/**
 * Add product to ShoppingCart
 */
$shoppingCart = new DShoppingCart;
$shoppingCart->addProduct($product);

// $product = $doctrine->em->getRepository('models\Product')->find($productId);
// if ($product) {
	// $doctrine->em->detach($product);
	// ShoppingCart::addProduct($product);
	session_start();
	$_SESSION['shopping_cart'] = serialize($shoppingCart);
// }
echo '<pre>';
// print_r($_SESSION);
$shopping_cart = unserialize($_SESSION['shopping_cart']);

/**
 * Get products stored in session
 */
$products = $shopping_cart->getProducts();
print_r($products);


// mock object for Product - for projects without Doctrine
class Product
{
	private $name;
	private $price;

	public function __construct($id)
	{
		$this->id = $id;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	public function setPrice($price)
	{
		$this->price = $price;
	}
}