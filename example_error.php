<?php

//Data is not available for date eg. 02.11.2014.

require('HNBExchangeRates.php');

$data = HNBExchangeRates::get('02.11.2014.');

echo "<pre>";
print_r($data);
echo "</pre>";