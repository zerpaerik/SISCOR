<?php

namespace SISCOR;

use Illuminate\Database\Eloquent\Model;

class Adjunto extends Model
{
    protected $table='tbladjunto';
    protected $primaryKey='id';


    public $timestamps=false;

    protected $fillable =[
        'id',
        'id_correspondencia',
        'fecha',
        'adjunto',
        ];


}
