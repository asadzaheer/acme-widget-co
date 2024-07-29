<?php
class BuyOneGetOneHalfPrice implements OfferInterface
{
    private string $productCode;

    public function __construct(string $productCode)
    {
        $this->productCode = $productCode;
    }

    /**
     * @param string[] $products
     * @param Product[] $catalogue
     * @return float
     */
    public function apply(array $products, array $catalogue): float
    {
        $discount = 0.0;
        $count = array_count_values($products)[$this->productCode] ?? 0;

        if ($count >= 2) {
            $product = $catalogue[$this->productCode];
            $discount = ($count / 2) * ($product->getPrice() / 2);
        }

        return $discount;
    }
}
