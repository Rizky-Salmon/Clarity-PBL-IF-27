<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = "activity";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'id_activity';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['activity_name'];

    public function subsectors()
    {
        return $this->belongsToMany(SubSector::class, 'activity_subsector', 'id_activity', 'id_subsector');
    }

}

