<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'category_id',
        'user_id',
        'account_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function products()
    {
        return $this->hasMany(ProductStore::class);
    }
}
