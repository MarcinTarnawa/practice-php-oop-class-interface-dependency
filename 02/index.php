<?php

interface CartOperations
{
    public function addProduct(Product $product);
    public function removeFromCart(int $id);
}

interface IProduct 
{
    public function __construct(string $name, float $price, int $tax, int $Ean);
}