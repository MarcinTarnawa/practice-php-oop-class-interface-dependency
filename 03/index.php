<?php

require '../02/index.php';

class Cart implements ShopProduct
{
    public $cart = [];

    public function product(string $name, float $price, int $tax, int $EAN)
    {
        return [
            'name' => $name,
            'price' => $price,
            'tax' => $tax,
            'EAN' => $EAN
        ];
    }

    public function addToCart($product)
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
            if ($product['name'] === $productName) {
                $search[] = $productName;
            }
        }
        if(isset($search)){
        foreach($search as $item => $name)
            echo $name . "</br>";
        } else {
            echo "No items found";
        }
    }
}

$test = new Cart;

$produktA = $test->product('stolik', 69.99, 8, 3321132215534); 
$test->addToCart($produktA);
$produktB = $test->product('krzeslo', 35.55, 23, 1231231231232); 
$test->addToCart($produktB);
$produktC = $test->product('fotel', 49.99, 12, 5901452457853); 
$test->addToCart($produktC);

$test->search('stolik');
?>
<pre>
<?php
var_dump($test);
?>
</pre>