<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInvestor extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'fund_id'];
}
