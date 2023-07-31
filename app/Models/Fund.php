<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'start_year', 'fund_manager_id'];

    protected $with = ['manager', 'aliases'];

    public function manager()
    {
        return $this->belongsTo(FundManager::class, 'fund_manager_id', 'id');
    }

    public function aliases()
    {
        return $this->hasMany(FundAlias::class);
    }
}
