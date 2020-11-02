<?php

namespace App\Model\Project;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{

    function project(){
        return $this->belongsTo(Project::class,'id','product_id');
    }
}
