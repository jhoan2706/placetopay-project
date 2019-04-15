<?php
namespace App\Interfaces;

interface CheckoutMethodInterface
{
    public function sendCheckoutRequest();
}