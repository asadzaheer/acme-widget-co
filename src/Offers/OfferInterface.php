<?php
interface OfferInterface
{
    /**
     * @param string[] $products
     * @param Product[] $catalogue
     * @return float
     */
    public function apply(array $products, array $catalogue): float;
}
