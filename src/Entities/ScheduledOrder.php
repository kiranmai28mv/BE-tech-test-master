<?php

namespace App\Entities;

use Carbon\Carbon;

class ScheduledOrder
{
    /**
     * The delivery date of this scheduled order.
     *
     * @var \Carbon\Carbon
     */
    protected $deliveryDate;

    /**
     * Is this delivery marked as a holiday that will be skipped.
     *
     * @var bool
     */
    protected $holiday = false;

    /**
     * Is this scheduled order an opt in order that is not part of the normal subscription's plan cycle.
     *
     * @var bool
     */
    protected $optIn = false;

    /**
     * Is this scheduled order part of the subscriptions normal plan cycle.
     *
     * @var bool
     */
    protected $interval = true;

    /**
     * ScheduledOrder constructor.
     *
     * @param \Carbon\Carbon     $deliveryDate
     * @param \App\Entities\bool $isInterval
     */
    public function __construct(Carbon $deliveryDate, bool $isInterval)
    {
        $this->deliveryDate = $deliveryDate;
        $this->interval     = $isInterval;
    }

    // MUTATOR - INTERVAL
    public function isInterval(){
        return $this->interval;
    }

    // MUTATOR - HOLIDAY
    public function setHoliday($holiday){
        if($this->isInterval()){
            $this->holiday = $holiday;
        } else{
            $this->holiday = false;
        }

    }

    public function isHoliday(){
        return $this->holiday;
    }

    // MUTATOR - OPT IN
    public function setOptIn($optIn){
        if(!$this->isInterval()){
            $this->optIn = $optIn;
        } else{
            $this->optIn = false;
        }

    }

    public function isOptIn(){
        return $this->optIn;
    }

    // MUTATOR - DELIVERY DATE
    public function getDeliveryDate(){
        return $this->deliveryDate;
    }
}
