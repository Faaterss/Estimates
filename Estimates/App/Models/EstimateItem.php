<?php

namespace Modules\Estimates\App\Models;

use App\Classes\AimModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Estimates\Database\factories\EstimateItemFactory;

class EstimateItem extends Model
{
    use HasFactory, AimModel;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];
    
    protected static function newFactory(): EstimateItemFactory
    {
        //return EstimateItemFactory::new();
    }
}
