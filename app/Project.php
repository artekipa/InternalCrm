<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Project
 *
 * @package App
 * @property string $name
*/
class Project extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function awards_id()
    {
        return $this->belongsToMany(Award::class, 'award_project')->withTrashed();
    }
    
}
