<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Invite extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the route key for the model.
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'token';
    }

    public function clickRequest(): HasOne
    {
        return $this->hasOne(ClickIncomingRequest::class);
    }
}
