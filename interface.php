<?php

interface Newsletter
{
  public function subscribe($email);
}

class MailChimp implements Newsletter
{
  public function subscribe($email)
  {
    die('Subscribing with mailchimp!');
  }
}

class Drip implements Newsletter
{
  public function subscribe($email)
  {
    die('Subscribing with drip!');
  }
}

class NewsletterController
{
  public function store(Newsletter $newsletter)
  {
    $email = 'mnk@gmail.com';
    $newsletter->subscribe($email);
  }
}

$newsletter = new NewsletterController();
$newsletter->store(new MailChimp());
