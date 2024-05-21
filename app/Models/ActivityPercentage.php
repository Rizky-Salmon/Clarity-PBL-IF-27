<?php

namespace App\Models;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'percentage'
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'id_activity');
    }
}
