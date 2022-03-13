<?php

interface PaymentInterface
{
  public function amount();
}

class CashPayment implements PaymentInterface
{
  public function amount(): string
  {
    return "Paid 1000 MMK by using CashPayment.";
  }
}

class MobilePayment implements PaymentInterface
{
  public function amount(): string
  {
    $amount = 1000 - ((1000 * 20) / 100); // 20% discount
    return "Paid $amount MMK by using MobilePayment.";
  }
}

class PayPalPayment implements PaymentInterface
{
  public function amount(): string
  {
    $amount = 1000 - ((1000 * 30) / 100); // 30% discount
    return "Paid $amount MMK by using PayPal.";
  }
}

class Payment
{
  private $payment;

  public function pay($payment_method)
  {
    switch ($payment_method) {
      case 'cash':
        $this->payment = new CashPayment();
        break;
      case 'mobile':
        $this->payment = new MobilePayment();
        break;
      case 'paypal':
        $this->payment = new PayPalPayment();
        break;
      default:
        $this->payment = new CashPayment();
        break;
    }

    return $this->payment->amount();
  }
}

// $pay = new Payment();
// $amount = $pay->pay('mobile');
// echo $amount;

abstract class Car {
  public function pick()
  {
    $car_name = trim(preg_replace('/[A-Z]/', ' $0', (new ReflectionClass($this))->getShortName()));
    return "Picking $car_name for $this->date.";
  }
}

class FitCar extends Car {
  public function __construct(protected $date)
  {}
}

class VitzCar extends Car {
  public function __construct(protected $date)
  {}
}

class VimCar extends Car {
  public function __construct(protected $date)
  {}
}


class CarPicker {
  public $date;

  public function __construct($date)
  {
    $this->date = $date;
  }

  public function pick()
  {
    $car = null;
    switch ($this->date) {
      case 'today':
        $car = new FitCar($this->date);
        break;
      case 'sunday':
        $car = new VitzCar($this->date);
        break;
      case 'monday':
        $car = new VimCar($this->date);
        break;
      default:
        $car = new FitCar($this->date);
        break;
    }

    return $car->pick();
  }
}


$car = new CarPicker('monday');
echo $car->pick();