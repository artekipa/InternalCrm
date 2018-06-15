<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Program
 *
 * @package App
 * @property string $name
*/
class Program extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['name'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function project_id()
    {
        return $this->belongsToMany(Project::class, 'program_project')->withTrashed();
    }
    
    public function award_id()
    {
        return $this->belongsToMany(Award::class, 'award_program')->withTrashed();
    }
    
}
