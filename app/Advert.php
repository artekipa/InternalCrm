<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Advert
 *
 * @package App
 * @property string $title
 * @property text $desc
*/
class Advert extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'desc'];
    protected $hidden = [];
    public static $searchable = [
    ];
    
    
    public function catadver_id()
    {
        return $this->belongsToMany(Catadvert::class, 'advert_catadvert')->withTrashed();
    }
    
    public function team_id()
    {
        return $this->belongsToMany(Team::class, 'advert_team');
    }
    
}
