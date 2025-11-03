<?php

interface addProduct
{
    public function addProduct(Product $product);
    public function removeFromCart(int $id);
}

interface Product 
{
    public function __construct(string $name, float $price, int $tax, int $Ean);
}