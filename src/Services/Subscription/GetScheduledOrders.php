<?php

namespace App\Services\Subscription;

use App\Entities\Subscription;
use App\Entities\ScheduledOrder;

class GetScheduledOrders
{
    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param \App\Entities\Subscription $subscription
     * @param int                        $forNumberOfWeeks
     *
     * @return array
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
    {
        $model = array();
        if(!is_null($subscription->getNextDeliveryDate())){
            for ($i = 0; $i < $forNumberOfWeeks; $i++) {
                $next_date = $subscription->getNextDeliveryDate();
                $subscription->setNextDeliveryDate($next_date->copy()->addWeek());
                if($subscription->getPlan() == 'Weekly'){
                    $model[] = new ScheduledOrder($next_date,true);
                } else{
                    $isInterval = false;
                    if($i%2 ==0){
                        $isInterval = true;
                    }
                    $model[] = new ScheduledOrder($next_date,$isInterval);
                }
            }
        }
        return $model;
    }
}
