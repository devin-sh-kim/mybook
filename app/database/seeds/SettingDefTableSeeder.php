<?php

class SettingDefTableSeeder extends Seeder {

    public function run()
    {
        DB::table('setting_defs')->delete();

        // default value
        // Moneybook 월별 시작 일자
        SettingDef::create(array('setting_id' => '1001', 'title' => 'MoneyBook 월별 시작 일', 'desc' => ''));
        
    }

}

?>
