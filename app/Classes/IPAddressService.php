<?php

namespace App\Classes;

use App\Models\IPAddress;

class IPAddressService {

    /**
     * returns list of address
     * 
     * @return collection - list of ip address on record
     */
    public static function list()
    {
        return IPAddress::orderBy('ip')->get();
    }

    /**
     * Update if IP address already exist, otherwise create it
     * 
     * @param $ip - ip address
     * @param $label
     * 
     * @return IPAddress
     */
    public static function upcreate($ip, $label)
    {
        return IPAddress::updateOrCreate(
            ['ip' => $ip],
            ['label'=>$label]
        );
    }

}