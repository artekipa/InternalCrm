<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cataward
 *
 * @package App
 * @property string $name
*/
class Cataward extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function nominateds() {
        return $this->hasMany(Nominated::class, 'cataward_id');
    }
}
