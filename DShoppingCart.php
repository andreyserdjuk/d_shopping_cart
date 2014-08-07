<?php

class DShoppingCart
{
	/**
	 * @var models\Product[]
	 */
	protected $products = array();

	/**
	 * TODO: Get products list with discounts
	 */
	
	public function getProducts()
	{
		return $this->products;
	}

	public function getProduct($id)
	{
		return isset($this->$products[$id])? $products[$id] : false;
	}

	public function addProduct(Product $product)
	{
		$this->products[$product->getId()] = $product;
	}

	public function removeProducts()
	{
		$this->$products = array();
	}
}