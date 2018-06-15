<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;

/**
 * Class Year
 *
 * @package App
 * @property integer $name
*/
class Year extends Model
{
    use SoftDeletes, FilterByUser;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setNameAttribute($input)
    {
        $this->attributes['name'] = $input ? $input : null;
    }
    
}
