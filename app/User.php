<?php
//changed by Ronak Patel @ line 13,14,34-38
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
	
	const ADMIN_TYPE = 'admin';
    const DEFAULT_TYPE = 'default';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isBan',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
	
	protected function friendsOfThisUser()
	{
		return $this->belongsToMany(User::class, 'friendships', 'first_user', 'second_user')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}
 
	// friendship that this user was asked for
	protected function thisUserFriendOf()
	{
		return $this->belongsToMany(User::class, 'friendships', 'second_user', 'first_user')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}
 
	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
		if ( ! array_key_exists('friends', $this->relations)) {
			$this->loadFriends();
		}
		return $this->getRelation('friends');
	}
 
	protected function loadFriends()
	{
		if ( ! array_key_exists('friends', $this->relations))
		{
			$friends = $this->mergeFriends();
			$this->setRelation('friends', $friends);
		}
	}
 
	protected function mergeFriends()
	{
		if($temp = $this->friendsOfThisUser){
			return $temp->merge($this->thisUserFriendOf);
		}
		else{
			return $this->thisUserFriendOf;
		}
	}
	
	public function friend_requests()
	{
		return $this->hasMany(Friendship::class, ‘second_user’)
		->where(‘status’, ‘pending’);
	}
	
	public function isAdmin()
    {
        return $this->type === self::ADMIN_TYPE;
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	function review() {
        return $this->hasMany('App\Review');
    }
	
	function rating() {
        return $this->hasMany('App\Rating');
    }
	
	function shelf() {
		return $this->hasMany('App\Shelf');
	}
	
	public function profile()
    {
        return $this->hasOne('App\Profile');
    }
	
}
