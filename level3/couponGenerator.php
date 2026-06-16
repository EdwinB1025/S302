<?php
interface CouponStrategy
{
    public function calculateDiscount(bool $isHighSeason, bool $bigStock): int;
}

class BmwCoupon implements CouponStrategy
{
    public function calculateDiscount(bool $isHighSeason, bool $bigStock): int
    {
        return (!$isHighSeason ? 5 : 0) + ($bigStock ? 7 : 0);
    }
}

class MercedesCoupon implements CouponStrategy
{
    public function calculateDiscount(bool $isHighSeason, bool $bigStock): int
    {
        return (!$isHighSeason ? 4 : 0) + ($bigStock ? 10 : 0);
    }
}

class CouponGenerator
{
    private bool $isHighSeason = false;
    private bool $bigStock = true;

    public function __construct(private CouponStrategy $strategy) {} // inyectada como dependencia

    public function setStrategy(CouponStrategy $strategy) // cambiable en runtime
    {
        $this->strategy = $strategy;
    }

    public function changeSeason()
    {
        $this->isHighSeason = !$this->isHighSeason;
    }
    public function changeStock()
    {
        $this->bigStock = !$this->bigStock;
    }

    public function generateCoupon()
    {
        $discount = $this->strategy->calculateDiscount($this->isHighSeason, $this->bigStock);
        echo "Get {$discount}% off the price of your new car.\n";
    }
}
