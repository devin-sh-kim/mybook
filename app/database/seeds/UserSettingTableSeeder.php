<?php

class UserSettingTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_settings')->where('user_id', '=', '0')->delete();

        // default value
        // Moneybook 월별 시작 일자
        UserSetting::create(array('user_id' => '0', 'setting_id' => '1001', 'value' => '1',));
        
    }

}

?>
