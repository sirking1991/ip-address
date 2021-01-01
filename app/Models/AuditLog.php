<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime:F jS Y h:i:s A',
        'updated_at' => 'datetime:F jS Y h:i:s A',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
