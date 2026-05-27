<?php
interface CarCouponGenerator
{
    public function addSeasonDiscount();
    public function addStockDiscount();
}

trait ModifyAttributes
{

    protected bool $isHigSeason = false;
    protected bool $bigStock  = true;

    public function __construct(private int $discount = 0) {}

    public function changeSeason(): void
    {
        $this->isHigSeason = !$this->isHigSeason;
    }
    public function changeStock(): void
    {
        $this->bigStock = !$this->bigStock;
    }
    public function generateCoupon()
    {
        $this->addSeasonDiscount();
        $this->addStockDiscount();
        echo "Get {$this->discount}% off the price of your new car.\n";
    }
}

class BmwCuoponGenerator implements CarCouponGenerator
{
    use ModifyAttributes;

    public function addSeasonDiscount()
    {
        $this->discount += !$this->isHigSeason ? 5 : 0;
    }
    public function addStockDiscount()
    {
        $this->discount += $this->bigStock ? 7 : 0;
    }
}

class MercedesCuoponGenerator implements CarCouponGenerator
{
    use modifyAttributes;

    public function addSeasonDiscount()
    {
        $this->discount += !$this->isHigSeason ? 4 : 0;
    }
    public function addStockDiscount()
    {
        $this->discount += $this->bigStock ? 10 : 0;
    }
}

class CouponGenerator
{
    protected $specificCouponGenerator;

    public function __construct(string $type)
    {
        if (preg_match('/bmw/i', $type)) {
            $this->specificCouponGenerator = new BmwCuoponGenerator;
        } else if (preg_match('/mercedes/i', $type)) {
            $this->specificCouponGenerator = new MercedesCuoponGenerator;
        } else {
            throw new Exception("type of coupon not supported.");
        }
    }
    public function changeSeason()
    {
        $this->specificCouponGenerator->changeSeason();
    }
    public function changeStock()
    {
        $this->specificCouponGenerator->changeStock();
    }
    public function generateCoupon()
    {
        $this->specificCouponGenerator->generateCoupon();
    }
}
