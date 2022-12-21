<?php

namespace Framework\src;

use App\Liseners\TelegramRegistrationLisener;
use App\Event\RegistrationEvent;
class EventServiceProvider
{

    private $events = [
        RegistrationEvent::class => [
            TelegramRegistrationLisener::class,
        ],
       
    ];

    public function notify() {
        foreach($this->events[get_class($this)] as $liseners) {
           
           (new $liseners())->hendler($this);
           
        }
    }
}
