<?php
namespace App\Services;
use \MailchimpMarketing\ApiClient;
use App\Services\Newsletter;

class MailchimpNewsletter implements Newsletter
{

  protected $client;
  public function __construct(ApiClient $client)
  {
    $this->client = $client;
  }

  public function subscribe($email, $list = null)
  {
    $list ??= config('services.mailchimp.lists.subscribes');
    $this->client->lists->setListMember($list, md5($email), [
      'status' => 'subscribed',
      'email_address' => $email
    ]);
  }
}
