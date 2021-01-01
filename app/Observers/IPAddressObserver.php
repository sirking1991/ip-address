<?php

namespace App\Observers;

use App\Classes\AuditLogService;
use App\Models\IPAddress;

class IPAddressObserver
{
    /**
     * Handle the IPAddress "created" event.
     *
     * @param  \App\Models\IPAddress  $ipAddress
     * @return void
     */
    public function created(IPAddress $ipAddress)
    {
        \Log::debug('IP address created: ip='.$ipAddress->ip.' label='.$ipAddress->label);
        AuditLogService::log($ipAddress->ip, 1, 'created');
    }

    /**
     * Handle the IPAddress "updated" event.
     *
     * @param  \App\Models\IPAddress  $ipAddress
     * @return void
     */
    public function updated(IPAddress $ipAddress)
    {
        \Log::debug('IP address updated: ip='.$ipAddress->ip.' label='.$ipAddress->label);
        AuditLogService::log($ipAddress->ip, 1, 'updated');
    }

    /**
     * Handle the IPAddress "deleted" event.
     *
     * @param  \App\Models\IPAddress  $ipAddress
     * @return void
     */
    public function deleted(IPAddress $ipAddress)
    {
        //
    }

    /**
     * Handle the IPAddress "restored" event.
     *
     * @param  \App\Models\IPAddress  $ipAddress
     * @return void
     */
    public function restored(IPAddress $ipAddress)
    {
        //
    }

    /**
     * Handle the IPAddress "force deleted" event.
     *
     * @param  \App\Models\IPAddress  $ipAddress
     * @return void
     */
    public function forceDeleted(IPAddress $ipAddress)
    {
        //
    }
}
