<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 *
 * @package App
 * @property string $name
 * @property string $adress
 * @property string $persontitle
 * @property string $personname
 * @property string $zipcode
 * @property string $city
 * @property integer $phone
 * @property string $email
 * @property string $website
 * @property text $comments
 * @property string $nomination
 * @property string $senddate
 * @property string $user
*/
class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'persontitle', 'personname', 'zipcode', 'city', 'phone', 'email', 'website', 'comments', 'nomination', 'senddate', 'adress_address', 'adress_latitude', 'adress_longitude', 'user_id'];
    protected $hidden = [];
    public static $searchable = [
    ];
    

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setPhoneAttribute($input)
    {
        $this->attributes['phone'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setSenddateAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['senddate'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['senddate'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getSenddateAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setUserIdAttribute($input)
    {
        $this->attributes['user_id'] = $input ? $input : null;
    }
    
    public function vivode_id()
    {
        return $this->belongsToMany(Vivodeship::class, 'company_vivodeship')->withTrashed();
    }
    
    public function trades_id()
    {
        return $this->belongsToMany(Trade::class, 'company_trade')->withTrashed();
    }
    
    public function nomiyear_id()
    {
        return $this->belongsToMany(Year::class, 'company_year')->withTrashed();
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function nominateds() {
        return $this->hasMany(Nominated::class, 'company_id');
    }
}
