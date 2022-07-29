<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $fillable = ['user_id','category_name'];
    protected $guarded = ['id']; // give permission to all the field

    function rel_to_user(){

        return $this -> belongsTo(User::class, 'user_id');
    }

}
