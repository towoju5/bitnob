<?php

namespace Towoju5\Bitnob\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cards extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
}
