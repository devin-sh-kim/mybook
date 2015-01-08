<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserSetting extends Eloquent {

    protected $table = 'user_settings';

	use SoftDeletingTrait;

	public static function getSetting($user_id, $setting_id)
	{
		$setting = UserSetting::select('value')->where('user_id', '=', $user_id)->where('setting_id', '=', $setting_id)->first();
		
		if($setting != null){
			return $setting->value;
		}else{
			$setting = UserSetting::select('value')->where('user_id', '=', '0')->where('setting_id', '=', $setting_id)->first();
			if($setting){
				return $setting->value;
			}else{
				Log::error('Not found default user setting : ' . $setting_id);
				return null;
			}
		}
	}
	
	
	public static function setSetting($user_id, $setting_id, $value)
	{
		$setting = UserSetting::where('user_id', '=', $user_id)->where('setting_id', '=', $setting_id)->first();
		//dd($setting);
		if($setting != null){
		    $setting->delete();
			
		}   

		$setting = new UserSetting;
		$setting->user_id = $user_id;
		$setting->Setting_id = $setting_id;
		$setting->value = $value;
		
		$setting->save();
	
	}
}
?>
