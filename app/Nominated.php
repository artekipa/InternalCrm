<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class Nominated
 *
 * @package App
 * @property string $company
 * @property string $cataward
 * @property string $year
 * @property string $materialdates
 * @property string $docsdate
 * @property string $matrialtype
 * @property string $materialloc
 * @property integer $sitenumber
 * @property string $contactperson
 * @property string $cpemail
 * @property integer $cpphone
 * @property string $presentation_name
 * @property integer $presentation_site_no
 * @property tinyInteger $member
 * @property text $comments
 * @property integer $eventpersonno
 * @property string $event_person
*/
class Nominated extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait;

    protected $fillable = ['materialdates', 'docsdate', 'matrialtype', 'materialloc', 'sitenumber', 'contactperson', 'cpemail', 'cpphone', 'presentation_name', 'presentation_site_no', 'member', 'comments', 'eventpersonno', 'event_person', 'company_id', 'cataward_id', 'year_id'];
    protected $hidden = [];
    public static $searchable = [
        'eventpersonno',
    ];
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCompanyIdAttribute($input)
    {
        $this->attributes['company_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCatawardIdAttribute($input)
    {
        $this->attributes['cataward_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setYearIdAttribute($input)
    {
        $this->attributes['year_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setMaterialdatesAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['materialdates'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['materialdates'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getMaterialdatesAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDocsdateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['docsdate'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['docsdate'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDocsdateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setSitenumberAttribute($input)
    {
        $this->attributes['sitenumber'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCpphoneAttribute($input)
    {
        $this->attributes['cpphone'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPresentationSiteNoAttribute($input)
    {
        $this->attributes['presentation_site_no'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setEventpersonnoAttribute($input)
    {
        $this->attributes['eventpersonno'] = $input ? $input : null;
    }
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id')->withTrashed();
    }
    
    public function programs_id()
    {
        return $this->belongsToMany(Program::class, 'nominated_program')->withTrashed();
    }
    
    public function project_id()
    {
        return $this->belongsToMany(Project::class, 'nominated_project')->withTrashed();
    }
    
    public function cataward()
    {
        return $this->belongsTo(Cataward::class, 'cataward_id')->withTrashed();
    }
    
    public function award_id()
    {
        return $this->belongsToMany(Award::class, 'award_nominated')->withTrashed();
    }
    
    public function year()
    {
        return $this->belongsTo(Year::class, 'year_id')->withTrashed();
    }
    
    public function user_id()
    {
        return $this->belongsToMany(User::class, 'nominated_user');
    }
    
    public function organizations_id()
    {
        return $this->belongsToMany(Organization::class, 'nominated_organization')->withTrashed();
    }
    
}
