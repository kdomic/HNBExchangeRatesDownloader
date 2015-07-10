HNB Exchange Rates Downloader for PHP
=============

## Synopsis

This PHP script uses publicly available service from Croatian national bank (http://www.hnb.hr/) to grab currency exchange rates.


## Installation

Just include `HNBExchangeRates.php` in your project and start to use it.


## Code Example

Download data for specific date:
```
require('HNBExchangeRates.php');

$data = HNBExchangeRates::get('01.11.2014.'); 
```

Download data for today:
```
require('HNBExchangeRates.php');

$data = HNBExchangeRates::get(); 
```

## Links

HNB homepage: `http://www.hnb.hr/`

HNB current exchange rates: `list: http://www.hnb.hr/tecajn/etecajn.htm`

HNB data repository: `http://www.hnb.hr/tecajn1/e-arhiva-tecajn.htm`

HNB formated data: `http://www.hnb.hr/etecajn/f110715.dat`

HNB data format rules: `http://www.hnb.hr/tecajn/etecajn.htm`


## License

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

     http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.