<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSector extends Model
{
    use HasFactory;

    protected $table = "subsector";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_subsector';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subsector_name',
        'description',
        'id_sector',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class, 'id_sector');
    }
}
