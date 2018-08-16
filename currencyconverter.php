<?php

class CurrencyConverter
{
  private $base_currency;
  private $amount;
  private $convert_to;

  public function __construct($base_currency=null, $amount=null, $convert_to=null)
  {
    $this->base_currency = $base_currency;
    $this->amount = $amount;
    $this->convert_to = $convert_to;
  }

  private function ConversionInfo(){
    $conversion_array = [
      'GBP' => 0.89,
      'USD' => 1.13,
    ];
    return $conversion_array;
  }

  public function Convert()
  {
    $base = bcmul($this->amount, $this->ConversionInfo()[$this->base_currency], 2);
    $target = bcmul($this->amount, $this->ConversionInfo()[$this->convert_to], 2);
    $final_amount = ($target / $base) * $this->amount;
    return number_format($final_amount, 2);
  }
}

$convert = new CurrencyConverter('GBP',1,'USD');

var_dump($convert->Convert());
