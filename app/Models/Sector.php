<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    protected $table = "sector";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_sector';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sector_name'];

    public function subSectors()
    {
        return $this->hasMany(SubSector::class, 'id_sector', 'id_sector');
    }
}
