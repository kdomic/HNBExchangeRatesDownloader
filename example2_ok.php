<?php

//Download data for today

require('HNBExchangeRates.php');

$data = HNBExchangeRates::get('01.11.2014.');

echo "<pre>";
print_r($data);
echo "</pre>";