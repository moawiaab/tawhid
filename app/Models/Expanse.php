<?php

namespace App\Models;

use \DateTimeInterface;
use App\Support\HasAdvancedFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expanse extends Model
{
    use HasAdvancedFilter;
    use SoftDeletes;
    use HasFactory;

    public $table = 'expanses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $orderable = [
        'id',
        'name',
        'amount',
        'expanses',
        'user.name',
        'stage.name',
    ];

    protected $filterable = [
        'id',
        'name',
        'amount',
        'expanses',
        'user.name',
        'stage.name',
    ];

    protected $fillable = [
        'name',
        'amount',
        'expanses',
        'user_id',
        'account_id',
        'stage_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function items()
    {
        return $this->hasMany(ExpanseItem::class, 'expanse_id')->orderBy('id', 'desc');
    }

}
