<?php

class TableSetupController extends BaseController {

    public function setupStamp(){
        $result = '';
        if (!Schema::hasTable('stamp_cards'))
        {
            Schema::create('stamp_cards', function($table)
            {
                $table->increments('id');               // id, key
                $table->integer('user_id');             // 사용자
                $table->text('goal');                   // 목표
                $table->integer('reset_type');          // 리셋 타입(매월=3, 매주=2, 매일=1, 없음=0)
                $table->integer('reset_day');           // 리셋 일(매월 x일, 매주 x요일, 매일, 없음)
                $table->integer('max_stamp_num');       // 목표 스탬프 갯수
                $table->date('end_date');               // 종료 일
                $table->integer('stamp_theme_id');      // 스탬프 테마
                
                $table->timestamps();
                $table->softDeletes();
            });
            $result = $result."Success Create Teble : stamp_cards"."\n";
        } else {
            $result = $result."Exist Teble : stamp_cards"."\n";
        }
        
        if (!Schema::hasTable('stamps'))
        {
            Schema::create('stamps', function($table)
            {
                $table->increments('id');               // id, key
                $table->integer('user_id');             // 사용자
                $table->integer('stamp_card_id');       // 스탬프 카드 ID
                $table->integer('stamp_type');          // 스탬프 테마
                $table->integer('stamp_theme_id');      // 스탬프 테마
                $table->dateTime('stamped_at');         // 스탬프 시간
                
                $table->timestamps();
                $table->softDeletes();
            });
            $result = $result."Success Create Teble : stamps"."\n";
        } else {
            $result = $result."Exist Teble : stamps"."\n";
        }
        
        return "<pre>".$result."</pre>";

    }
    
    public function setupBoard(){
        $result = '';
        if (!Schema::hasTable('boards'))
        {
            Schema::create('boards', function($table)
            {
                $table->increments('id');               // id, key
                $table->integer('user_id');             // 사용자
                $table->text('context');                // 내용
                $table->string('status', 100);          // 상태
                
                $table->timestamps();
                $table->softDeletes();
            });
            $result = $result."Success Create Teble : boards"."\n";
        } else {
            $result = $result."Exist Teble : boards"."\n";
        }

        return "<pre>".$result."</pre>";

    }
    
    public function setupRecord(){
        $result = '';
        if (!Schema::hasTable('records'))
        {
            Schema::create('records', function($table)
            {
                $table->increments('id');               // id, key
                $table->integer('user_id');             // 사용자
                $table->string('type', 3);              // 수입, 지출
                $table->integer('value');               // 금액
                $table->dateTime('target_at');          // 대상 일
                $table->text('context');                // 내용
                
                /*
                기록(records)
                    id
                    writeDate
                    targetDate
                    type[수입, 지출]
                    value
                    store
                    comment
                    targetType[wallet, card]
                    target
                    category
                    tag
                    order
                */

                $table->timestamps();
                $table->softDeletes();
            });
            $result = $result."Success Create Teble : records"."\n";
        } else {
            $result = $result."Exist Teble : records"."\n";
        }

        return "<pre>".$result."</pre>";

    }
    
    public function setupSetting(){
        $result = '';
        if (!Schema::hasTable('settings'))
        {
            Schema::create('settings', function($table)
            {
                $table->increments('id');                               
                $table->integer('user_id');             
                $table->integer('setting_id');          
                $table->string('value');            

                
                $table->timestamps();
                $table->softDeletes();
            });
            $result = $result."Success Create Teble : settings"."\n";
        } else {
            $result = $result."Exist Teble : settings"."\n";
        }
        $setting = new Setting;
        $setting->user_id = 7;
        $setting->setting_id = 1001;
        $setting->value = '25';
        $setting->save();
        return "<pre>".$result."</pre>";

    }
}
?>