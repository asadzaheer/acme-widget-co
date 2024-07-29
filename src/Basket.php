<?php
class Basket
{
    /** @var array<string> */
    private array $products = [];

    /** @var array<string, Product> */
    private array $catalogue;

    /** @var array<string, float> */
    private array $deliveryCharges;

    /** @var array<OfferInterface> */
    private array $offers;

    /**
     * @param Product[] $catalogue
     * @param array<string, float> $deliveryCharges
     * @param OfferInterface[] $offers
     */
    public function __construct(array $catalogue, array $deliveryCharges, array $offers)
    {
        $this->catalogue = $catalogue;
        $this->deliveryCharges = $deliveryCharges;
        $this->offers = $offers;
    }

    public function add(string $productCode): void
    {
        $this->products[] = $productCode;
    }

    public function total(): float
    {
        $total = 0.0;
        $productCounts = array_count_values($this->products);

        // Calculate product total
        foreach ($productCounts as $code => $count) {
            $product = $this->catalogue[$code];
            $total += $product->getPrice() * $count;
        }

        // Apply offers
        foreach ($this->offers as $offer) {
            $total -= $offer->apply($this->products, $this->catalogue);
        }

        // Calculate delivery charges
        $deliveryCost = $this->calculateDelivery($total);
        return $total + $deliveryCost;
    }

    private function calculateDelivery(float $total): float
    {
        if ($total >= 90) {
            return 0.0;
        }
        if ($total >= 50) {
            return 2.95;
        }

        ;

        return 4.95;
    }

    /**
     * @return array<string, float>
     */
    public function getDeliverCharges(): array {
        return $this->deliveryCharges;
    }
}
