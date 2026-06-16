<?php
require_once 'couponGenerator.php';

// Cliente: elige e inyecta la estrategia
$gen = new CouponGenerator(new BmwCoupon());
$gen->generateCoupon();
$gen->setStrategy(new MercedesCoupon()); // cambio en runtime — esto es Strategy
$gen->generateCoupon();
