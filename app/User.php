<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Hash;
use Validator;
class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, EntrustUserTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Function validate data for user
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/13
	 * @param  array $data
	 * @param  string $factory
	 * @return object
	 */
	public static function validate($data, $factory = 'login'){
		$rules = array(
			'email' => 'required|email',
			'password' => 'required|min:6',
	    );
	    if ($factory == 'register'){
	    	$rules = array(
	    		'email' => 'required|email|unique:users',
	    		'password' => 'required|min:6|confirmed',
	    		'name' => 'required|min:6',
	    		'password_confirmation' => 'required|min:6'
    		);
	    }
	    if ($factory == 'edit'){
	    	$rules = array(
	    		'name' => 'required|min:6',
	    		'current_password' => 'required|min:6',
	    		'address' => 'required|min:6',
	    		'birthday' => 'required|date_format:Y-m-d|before:tomorrow',
	    		'image' => 'image|mimes:jpeg,jpg,png|max:1000'
    		);
    		if($data['password'] != "" || $data['password_confirmation'] != ""){
    			$rules['password'] = 'required|min:6|max:50|confirmed';
    			$rules['password_confirmation'] = 'required|min:6|max:50';
    		}
	    }
	    return Validator::make($data, $rules);
	}

	/**
	 * Function create user
	 * @author  Tran Van Moi <[moitran92@gmail.com]>
	 * @since  2015/05/13
	 * @param  array $user_info
	 * @param  string $role_name
	 * @return object
	 */
	public static function create_user($user_info, $role_name){
		$user = new User;
        $user->name = $user_info['name'];
        $user->uid = empty($user_info['id']) ? 'res_local' : $user_info['id'];
        $user->email = $user_info['email'];
        $user->image = $user_info['image'];
        $user->password = Hash::make($user_info['password']);
        $user->save();
        // attack role to user
        $role = Role::whereName($role_name)->first();
		$user->attachRole($role);
        return $user;
	}
}
