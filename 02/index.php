<?php

interface ShopProduct
{
    public function product(string $name, float $price, int $tax, int $EAN);
}