<?php
namespace App\Services;

interface Newsletter {
  /**
   * Subscribe to an email listing
   * @param string $email
   * @param string|null $list
   */
  public function subscribe(string $email, $list = null);
}