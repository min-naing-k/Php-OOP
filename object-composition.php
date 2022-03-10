<?php 

class Subscription {
  protected BillGateway $gateway;

  public function __construct(BillGateway $gateway)
  {
    $this->gateway = $gateway;
  }

  public function subscribe()
  {
    
  }

  public function cancel()
  {
    $this->gateway->findSubscriptionUser();
    return 'Subscription is cancel';
  }

  public function swap()
  {
    
  }
}

interface BillGateway {
  public function findSubscriptionUser();
}

class StripGateway implements BillGateway {
  public function findSubscriptionUser()
  {
    echo 'finding user in strip... and fount him..';
  }
}

class PayPalGateway implements BillGateway {
  public function findSubscriptionUser()
  {
    echo 'finding user in paypal... and fount him..';
  }
}

$subscription = new Subscription(new PayPalGateway());
echo $subscription->cancel();