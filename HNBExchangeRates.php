<?php
/*
 * (C) Copyright 2015 Krunoslav Domic
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Contributors:
 *     Krunoslav Domic
 */

/*
    * Opis zapisa
    ****************************************
    Prvi slog - zaglavlje
    Naziv polja                 Dužina polja        Vrsta polja (N - numerik, A - alfa)
    Broj tečajnice              3                   N
    Datum izrade ddmmgggg       8                   N
    Datum primjene ddmmgggg     8                   N
    Broj slogova koji slijedi   2                   N

    Slogovi po valutama
    Naziv polja                 Dužina polja        Vrsta polja (N - numerik, A - alfa)
    Šifra valute                3                   N
    Oznaka valute               3                   A
    Broj jedinica               3                   N
    Kupovni tečaj               8,6                 N
    Srednji tečaj               8,6                 N
    Prodajni tečaj              8,6                 N

    Error link for test
    $link = 'http://www.hnb.hr/tecajn/f021114.dat';

    Current day link
    $link = 'http://www.hnb.hr/tecajn/f'.date('dmy').'.dat';
*/

class HNBExchangeRates
{
    public $documentNo;
    public $documentCreationDate;
    public $exchangeValidFrom;
    public $rates;

    function __construct()
    {
        $this->documentNo = null;
        $this->documentCreationDate = null;
        $this->exchangeValidFrom = null;
        $this->rates = array();
    }

    public static function get($date = null){
        $link = '';
        if($date == null)
            $link = 'http://www.hnb.hr/tecajn/f'.date('dmy').'.dat';
        else
            $link = 'http://www.hnb.hr/tecajn/f'.date('dmy',strtotime($date)).'.dat';
        $hnb = new HNBExchangeRates();
        $check = get_headers($link);
        if($check){
            if(strpos($check[0],"200")){
                $data = array();
                $data = explode("\n", file_get_contents($link));
                $header = array_shift($data);
                $hnb->documentNo = substr($header, 0, 3);
                $hnb->documentCreationDate = substr($header, 3, 8);
                $hnb->exchangeValidFrom = substr($header, 11, 8);
                while(!empty($data)){
                    $row_raw = array_shift($data);
                    $row = preg_split('/\s+/', $row_raw);
                    if(count($row)<4) continue;
                    $currency = new Currency();
                    $currency->id = substr($row[0], 0 , 3);
                    $currency->code = substr($row[0], 3 , 3);
                    $currency->quantity = substr($row[0], 6 , 3);
                    $currency->rate1 = $row[1];
                    $currency->rate2 = $row[2];
                    $currency->rate3 = $row[3];
                    $hnb->rates[$currency->code] = $currency;
                }
            }
        }
        return $hnb->documentNo==null ? null : $hnb;
    }
}

class Currency {
    public $id;
    public $code;
    public $quantity;
    public $rate1;
    public $rate2;
    public $rate3;
}
