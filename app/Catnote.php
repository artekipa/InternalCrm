<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use App\Traits\FilterByUser;

/**
 * Class Catnote
 *
 * @package App
 * @property string $name
 * @property string $created_by
 * @property string $created_by_team
*/
class Catnote extends Model
{
    use SoftDeletes, FilterByUser, FilterByUser;

    protected $fillable = ['name', 'created_by_id', 'created_by_team_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByTeamIdAttribute($input)
    {
        $this->attributes['created_by_team_id'] = $input ? $input : null;
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function created_by_team()
    {
        return $this->belongsTo(Team::class, 'created_by_team_id');
    }
    
}
