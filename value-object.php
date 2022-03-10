<?php
//======= Benifits of creating value object =========//
// Avoids primitive obession - and readability
// Helps with consitency
// Immutable

class Age
{
  private $age;

  public function __construct($age)
  {
    $this->validateAge($age);

    $this->age = $age;
  }

  // mutable version
  public function increment($amount = 1)
  {
    $this->validateAge($this->age + $amount);

    $this->age = $this->age + $amount;
    return new self($this->age);
  }

  // inmutable version
  public function inmutableIncrement($amount = 1)
  {
    return new self($this->age + $amount);
  }

  public function get()
  {
    return $this->age;
  }

  public function isEqualTo(Age $age): string
  {
    if ($this->age === $age->age) {
      return "Old Age is $age->age. New Age is $this->age. Equal";
    }
    return "Old Age is $age->age. New Age is $this->age. Not Equal";
  }

  protected function validateAge($age)
  {
    if ($age < 0 || $age > 120) {
      throw new InvalidArgumentException('That makes no sense!');
    }
  }
}

function register(string $name, Age $age)
{

}

// $age = new Age(22);

// $age->age = 500;
// $age2 = $age->increment(); // mutable version

// $age2 = $age->inmutableIncrement(); // inmutable version

// echo $age->get(); // 22
// echo $age2->get(); // 23

// echo $age2->isEqualTo($age);

// register('Mnk', $age);

class Price
{
  const USD = 'USD';
  const MMK = 'MMK';

  public function __construct(private float $amount, private string $fromCurrency, private string $toCurrency)
  {
    if ($amount < 0) {
      throw new InvalidArgumentException('That makes no sense!You must give positive number');
    }

    $this->checkAvailableCurrencies();

    $this->$amount = $amount;
    $this->fromCurrency = $fromCurrency;
    $this->toCurrency = $toCurrency;
  }

  public function getAmount()
  {
    return $this->amount;
  }

  public function getFromCurrency()
  {
    return $this->fromCurrency;
  }

  public function getToCurrency()
  {
    return $this->toCurrency;
  }

  private function getAvailableCurrencies(): array
  {
    return [self::USD, self::MMK];
  }

  private function checkAvailableCurrencies()
  {
    if (!in_array($this->fromCurrency, $this->getAvailableCurrencies())) {
      throw new InvalidArgumentException("$this->fromCurrency is not available in our application");
    }
    if (!in_array($this->toCurrency, $this->getAvailableCurrencies())) {
      throw new InvalidArgumentException("$this->toCurrency is not available in our application");
    }
  }
}

// USD => MMK (1USD, 1788MMK)
function currencyConverter(Price $price)
{
  $one_usd_to_mmk = 1780;
  $totalAmount = 0;
  if ($price->getToCurrency() === 'MMK') {
    $totalAmount = $price->getAmount() * $one_usd_to_mmk;
    echo $price->getAmount() . $price->getFromCurrency() . ' ' . $totalAmount . $price->getToCurrency();
    return;
  }
  if ($price->getToCurrency() === 'USD') {
    $totalAmount = $price->getAmount() / $one_usd_to_mmk;
    echo $price->getAmount() . $price->getFromCurrency() . ' ' . $totalAmount . $price->getToCurrency();
    return;
  }
}

try {
  currencyConverter(new Price(1, 'USD', 'MMK'));
} catch (InvalidArgumentException $e) {
  echo $e->getMessage();
}
