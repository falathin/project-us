<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'address',
    ];

    // Scope for customers deleted more than a week ago
    public function scopeDeletedOlderThanWeek($query)
    {
        return $query->where('deleted_at', '<', now()->subWeek());
    }

    protected $dates = ['deleted_at'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'customer_id');
    }
}