<?php
require_once 'couponGenerator.php';

$couponBMW = new CouponGenerator('bmw');
$couponMercedes = new CouponGenerator('mercedes');

$couponBMW->generateCoupon();
$couponMercedes->generateCoupon();
