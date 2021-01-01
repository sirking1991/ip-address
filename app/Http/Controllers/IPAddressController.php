<?php

namespace App\Http\Controllers;

use App\Classes\AuditLogService;
use App\Classes\IPAddressService;
use App\Models\IPAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IPAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return IPAddressService::list();
    }

    /**
     * Display a listing of the resource.
     *
     * @param $ip
     * @return \Illuminate\Http\Response
     */
    public function auditLogs($ip)
    {
        return AuditLogService::list($ip);
    }    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate ip
        $validator = Validator::make($request->all(), [
            'ip' => 'required|ip',
        ]);

        if ($validator->fails()) {
            return response('IP field must be a valid IP address', 422);
        }

        IPAddressService::upcreate($request->ip, $request->label);
        
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IPAddress  $iPAddress
     * @return \Illuminate\Http\Response
     */
    public function show(IPAddress $iPAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IPAddress  $iPAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(IPAddress $iPAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IPAddress  $iPAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IPAddress $iPAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IPAddress  $iPAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(IPAddress $iPAddress)
    {
        //
    }
}
