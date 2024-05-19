<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityPercentage extends Model
{
    use HasFactory;

    protected $table = "activity_percentage";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_activity_percentage';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_activity',
        'id_employees',
        'id_subsector',
        'percentage'
    ];
}
