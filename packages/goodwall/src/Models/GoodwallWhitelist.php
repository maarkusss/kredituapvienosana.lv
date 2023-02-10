<?php

namespace Goodday\Goodwall\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * GoodwallWhitelist Class
 *
 * Model stores a list of IP Addresses allowed to access restricted areas
 * (those restricted with "BehindGoodwall" middleware)
 *
 * @property $ip_address
 */
class GoodwallWhitelist extends Model
{
    protected $table = 'goodwall_whitelist';

    protected $fillable = [
        'ip_address',
    ];

    public $timestamps = true;
}
