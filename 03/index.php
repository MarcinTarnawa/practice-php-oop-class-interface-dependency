<?php

require '../02/index.php';

class Product implements IProduct
{
    public $name;
    public $price;
    public $tax;
    public $Ean;

    public function __construct(string $name, float $price, int $tax, int $Ean)
    {
        $this->name = $name;
        $this->price = $price;
        $this->tax = $tax;
        $this->Ean = $Ean;
    }
}

class Cart implements CartOperations
{
    public $cart = [];
    
    public function addProduct(Product $product)
    {
        $this->cart[] = $product;
        return $this->cart;
    }

    public function removeFromCart($id)
    {
       foreach ($this->cart as $key => $product) {
            if ($key === $id) {
                unset($this->cart[$id]);
                return;
            }
        }
    }

    public function search($productName)
    {
        foreach ($this->cart as $key => $product) {
            if (str_contains(strtolower($product->name), strtolower($productName))) {
                $search[] = $productName;
            }
        }

        if (!empty($search)) {
            $count = count($search);
            $productName = reset($search); 
            echo "Found $count $productName.<br>";
            
        } else {
            echo "No items found";
        }
    }
}

$cart = new Cart();

$productStolik = new Product('stolik', 69.99, 8, 3321132215534);
$productKrzeslo = new Product('krzeslo', 33.99, 12, 257272744);
$productKrzeslo2 = new Product('krzeslo 2', 18.99, 12, 1312133213);
$productKrzeslo3 = new Product('krzeslo 3', 45.99, 12, 8786453453);

$cart->addProduct($productStolik);
$cart->addProduct($productKrzeslo);
$cart->addProduct($productKrzeslo2);
$cart->addProduct($productKrzeslo3);

$cart->search('krzeslo');
$cart->removeFromCart(1);
$cart->search('Krzeslo');

?>
<pre>
<?php
var_dump($cart);
?>
</pre>