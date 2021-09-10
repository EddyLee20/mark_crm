<?php


namespace App\Models;

use \Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
}
