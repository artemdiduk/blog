<?php
namespace App\Event;

use Framework\src\EventServiceProvider;

class RegistrationEvent extends EventServiceProvider {
    public $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
