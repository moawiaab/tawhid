<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;
    use HasAdvancedFilter;

    protected $orderable = [
        'id',
        'name',
        'status',
        'details',
    ];

    protected $filterable = [
        'id',
        'name',
        'status',
        'details',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'status',
        'details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
