<?php

require_once('csvarray.php');

class CurrencyConverter
{
    private $base_currency;
    private $convert_to;

    public function __construct($base_currency=null, $convert_to=null)
    {
        $this->base_currency = $base_currency;
        $this->convert_to = $convert_to;
    }

    public function ConversionRates()
    {
        $conversion = new CSVArray('./ecbrates/eurofxref.csv', ',');
        return $conversion->createCSVArray()[0];
    }

    public function ConvertCurrency($amount=null)
    {
        if ($this->base_currency == 'EUR') {
            $final_amount = bcmul($amount, $this->ConversionRates()[$this->convert_to], 2);
        } elseif ($this->convert_to == 'EUR') {
            $final_amount = bcdiv($amount, $this->ConversionRates()[$this->base_currency], 2);
        } else {
            $base = bcmul($amount, $this->ConversionRates()[$this->base_currency], 2);
            $target = bcmul($amount, $this->ConversionRates()[$this->convert_to], 2);
            $final_amount = ($target / $base) * $amount;
        }

        return number_format($final_amount, 2);
    }
}
