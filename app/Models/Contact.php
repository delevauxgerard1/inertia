<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'organization_id',
        'country_id',
        'postal_code',
    ];

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
