<?php
 
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class OzTopProject extends Model {
     
    protected $table = "oz_top_project";
    protected $fillable = ['title', 'userId', 'projectId'];
    public $timestamps = false;
     
}
 
?>