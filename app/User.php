<?php
namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;
use Hash;
use App\Traits\FilterByUser;
use App\Traits\FilterByTeam;

/**
 * Class User
 *
 * @package App
 * @property string $name
 * @property string $firstname
 * @property string $lastname
 * @property string $phone
 * @property string $avatar
 * @property string $email
 * @property string $password
 * @property string $created_by
 * @property integer $codenumber
 * @property string $remember_token
 * @property tinyInteger $approved
 * @property string $team
*/
class User extends Authenticatable
{
    use Notifiable;
    use FilterByUser, FilterByTeam;

    protected $fillable = ['name', 'firstname', 'lastname', 'phone', 'avatar', 'email', 'password', 'codenumber', 'remember_token', 'approved', 'created_by_id', 'team_id'];
    protected $hidden = ['password', 'remember_token'];
    public static $searchable = [
    ];
    
    
    /**
     * Hash password
     * @param $input
     */
    public function setPasswordAttribute($input)
    {
        if ($input)
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
    }
    

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCreatedByIdAttribute($input)
    {
        $this->attributes['created_by_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setCodenumberAttribute($input)
    {
        $this->attributes['codenumber'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeamIdAttribute($input)
    {
        $this->attributes['team_id'] = $input ? $input : null;
    }
    
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    
    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    public function topics() {
        return $this->hasMany(MessengerTopic::class, 'receiver_id')->orWhere('sender_id', $this->id);
    }

    public function inbox()
    {
        return $this->hasMany(MessengerTopic::class, 'receiver_id');
    }

    public function outbox()
    {
        return $this->hasMany(MessengerTopic::class, 'sender_id');
    }
    public function internalNotifications()
    {
        return $this->belongsToMany(InternalNotification::class)
            ->withPivot('read_at')
            ->orderBy('internal_notification_user.created_at', 'desc')
            ->limit(10);
    }

    public function sendPasswordResetNotification($token)
    {
       $this->notify(new ResetPassword($token));
    }
}
