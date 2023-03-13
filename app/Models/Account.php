<?php

namespace App\Models;

use App\Support\HasAdvancedFilter;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasAdvancedFilter;

    public $table = 'accounts';
    protected $orderable = [
        'id',
        'name',
        'details'
    ];

    protected $filterable = [
        'id',
        'name',
        'details'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'details',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }

    public function expanses()
    {
        return $this->hasMany(Expanse::class);
    }
    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function locker() {
        return $this->hasOne(PublicTreasury::class);
    }
}
