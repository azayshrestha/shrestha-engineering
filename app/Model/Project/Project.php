<?php

namespace App\Model\Project;

use App\Model\Service\Service;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    function images()
    {
        return $this->hasMany(ProjectImage::class,'project_id','id');
    }
    function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
