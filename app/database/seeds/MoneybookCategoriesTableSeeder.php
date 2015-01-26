<?php

class MoneybookCategoriesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('moneybook_categories')->delete();

        // default value
        // Moneybook 월별 시작 일자
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '0', 'parent_code' => '00', 'disp_name' => '미분류', 'order' => '100', 'use_yn' => 'Y', 'code' => '99', 'icon' => 'fa fa-question'));
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '0', 'parent_code' => '00', 'disp_name' => '지출분류', 'order' => '0', 'use_yn' => 'Y', 'code' => '01'));
        
        $category_out = MoneybookCategory::where('disp_name', '=', '지출분류')->first();
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '식비', 'order' => '1', 'use_yn' => 'Y', 'code' => '0101', 'icon' => 'fa fa-cutlery'));
            $category_out_1 = MoneybookCategory::where('disp_name', '=', '식비')->first();
            
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '주식', 'order' => '1', 'use_yn' => 'Y', 'code' => '010101', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '부식', 'order' => '2', 'use_yn' => 'Y', 'code' => '010102', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '간식', 'order' => '3', 'use_yn' => 'Y', 'code' => '010103', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '외식', 'order' => '4', 'use_yn' => 'Y', 'code' => '010104', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '커피/음료', 'order' => '5', 'use_yn' => 'Y', 'code' => '010105', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '술/유흥', 'order' => '6', 'use_yn' => 'Y', 'code' => '010106', 'icon' => 'fa fa-cutlery'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_1->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010107', 'icon' => 'fa fa-cutlery'));
            
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '주거/통신', 'order' => '2', 'use_yn' => 'Y', 'code' => '0102', 'icon' => 'fa fa-home'));
            $category_out_2 = MoneybookCategory::where('disp_name', '=', '주거/통신')->first();
            
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '관리비', 'order' => '1', 'use_yn' => 'Y', 'code' => '010201', 'icon' => 'fa fa-home'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '공과금', 'order' => '2', 'use_yn' => 'Y', 'code' => '010202', 'icon' => 'fa fa-home'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '이동통신', 'order' => '3', 'use_yn' => 'Y', 'code' => '010203', 'icon' => 'fa fa-home'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '인터넷', 'order' => '4', 'use_yn' => 'Y', 'code' => '010204', 'icon' => 'fa fa-home'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '월세', 'order' => '5', 'use_yn' => 'Y', 'code' => '010205', 'icon' => 'fa fa-home'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_2->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010206', 'icon' => 'fa fa-home'));
            
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '생활용품', 'order' => '3', 'use_yn' => 'Y', 'code' => '0103', 'icon' => 'fa fa-lightbulb-o'));
            $category_out_3 = MoneybookCategory::where('disp_name', '=', '생활용품')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_3->code, 'disp_name' => '가구/가전', 'order' => '1', 'use_yn' => 'Y', 'code' => '010301', 'icon' => 'fa fa-lightbulb-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_3->code, 'disp_name' => '주방/욕실', 'order' => '2', 'use_yn' => 'Y', 'code' => '010302', 'icon' => 'fa fa-lightbulb-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_3->code, 'disp_name' => '잡화소모', 'order' => '3', 'use_yn' => 'Y', 'code' => '010303', 'icon' => 'fa fa-lightbulb-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_3->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010304', 'icon' => 'fa fa-lightbulb-o'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '의복/미용', 'order' => '4', 'use_yn' => 'Y', 'code' => '0104', 'icon' => 'fa fa-scissors'));
            $category_out_4 = MoneybookCategory::where('disp_name', '=', '의복/미용')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_4->code, 'disp_name' => '의류비', 'order' => '1', 'use_yn' => 'Y', 'code' => '010401', 'icon' => 'fa fa-scissors'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_4->code, 'disp_name' => '패션잡화', 'order' => '2', 'use_yn' => 'Y', 'code' => '010402', 'icon' => 'fa fa-scissors'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_4->code, 'disp_name' => '헤어/뷰티', 'order' => '3', 'use_yn' => 'Y', 'code' => '010403', 'icon' => 'fa fa-scissors'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_4->code, 'disp_name' => '세탁수선비', 'order' => '4', 'use_yn' => 'Y', 'code' => '010404', 'icon' => 'fa fa-scissors'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_4->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010405', 'icon' => 'fa fa-scissors'));
            
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '건강/문화', 'order' => '5', 'use_yn' => 'Y', 'code' => '0105', 'icon' => 'fa fa-stethoscope'));
            $category_out_5 = MoneybookCategory::where('disp_name', '=', '건강/문화')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '운동/레저', 'order' => '1', 'use_yn' => 'Y', 'code' => '010501', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '문화생활', 'order' => '2', 'use_yn' => 'Y', 'code' => '010502', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '취미', 'order' => '3', 'use_yn' => 'Y', 'code' => '010503', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '여행', 'order' => '4', 'use_yn' => 'Y', 'code' => '010504', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '병원비', 'order' => '5', 'use_yn' => 'Y', 'code' => '010505', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '보장성보험', 'order' => '6', 'use_yn' => 'Y', 'code' => '010506', 'icon' => 'fa fa-stethoscope'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_5->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010507', 'icon' => 'fa fa-stethoscope'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '교육/육아', 'order' => '6', 'use_yn' => 'Y', 'code' => '0106', 'icon' => 'fa fa-child'));
            $category_out_6 = MoneybookCategory::where('disp_name', '=', '교육/육아')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_6->code, 'disp_name' => '등록금', 'order' => '1', 'use_yn' => 'Y', 'code' => '010601', 'icon' => 'fa fa-child'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_6->code, 'disp_name' => '학원/교재비', 'order' => '2', 'use_yn' => 'Y', 'code' => '010602', 'icon' => 'fa fa-child'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_6->code, 'disp_name' => '육아용품', 'order' => '3', 'use_yn' => 'Y', 'code' => '010603', 'icon' => 'fa fa-child'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_6->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010604', 'icon' => 'fa fa-child'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '교통/차량', 'order' => '7', 'use_yn' => 'Y', 'code' => '0107', 'icon' => 'fa fa-car'));
            $category_out_7 = MoneybookCategory::where('disp_name', '=', '교통/차량')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_7->code, 'disp_name' => '대중교통비', 'order' => '1', 'use_yn' => 'Y', 'code' => '010701', 'icon' => 'fa fa-car'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_7->code, 'disp_name' => '주유비', 'order' => '2', 'use_yn' => 'Y', 'code' => '010702', 'icon' => 'fa fa-car'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_7->code, 'disp_name' => '자동차보험', 'order' => '3', 'use_yn' => 'Y', 'code' => '010703', 'icon' => 'fa fa-car'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_7->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010704', 'icon' => 'fa fa-car'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '경조사/회비', 'order' => '8', 'use_yn' => 'Y', 'code' => '0108', 'icon' => 'fa fa-bookmark'));
            $category_out_8 = MoneybookCategory::where('disp_name', '=', '경조사/회비')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_8->code, 'disp_name' => '경조사비', 'order' => '1', 'use_yn' => 'Y', 'code' => '010801', 'icon' => 'fa fa-bookmark'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_8->code, 'disp_name' => '모임회비', 'order' => '2', 'use_yn' => 'Y', 'code' => '010802', 'icon' => 'fa fa-bookmark'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_8->code, 'disp_name' => '데이트', 'order' => '3', 'use_yn' => 'Y', 'code' => '010803', 'icon' => 'fa fa-bookmark'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_8->code, 'disp_name' => '선물', 'order' => '4', 'use_yn' => 'Y', 'code' => '010804', 'icon' => 'fa fa-bookmark'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_8->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010805', 'icon' => 'fa fa-bookmark'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '세금/이자', 'order' => '9', 'use_yn' => 'Y', 'code' => '0109', 'icon' => 'fa fa-university'));
            $category_out_9 = MoneybookCategory::where('disp_name', '=', '세금/이자')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_9->code, 'disp_name' => '세금', 'order' => '1', 'use_yn' => 'Y', 'code' => '010901', 'icon' => 'fa fa-university'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_9->code, 'disp_name' => '대출이자', 'order' => '2', 'use_yn' => 'Y', 'code' => '010902', 'icon' => 'fa fa-university'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_9->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '010903', 'icon' => 'fa fa-university'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '용돈/기타', 'order' => '10', 'use_yn' => 'Y', 'code' => '0110', 'icon' => 'fa fa-leaf'));
            $category_out_10 = MoneybookCategory::where('disp_name', '=', '용돈/기타')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_10->code, 'disp_name' => '용돈', 'order' => '1', 'use_yn' => 'Y', 'code' => '011001', 'icon' => 'fa fa-leaf'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_10->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '011002', 'icon' => 'fa fa-leaf'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '카드대금', 'order' => '11', 'use_yn' => 'Y', 'code' => '0111', 'icon' => 'fa fa-credit-card'));
            $category_out_11 = MoneybookCategory::where('disp_name', '=', '카드대금')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_11->code, 'disp_name' => '카드대금', 'order' => '1', 'use_yn' => 'Y', 'code' => '011101', 'icon' => 'fa fa-credit-card'));
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_out->code, 'disp_name' => '저축/보험', 'order' => '12', 'use_yn' => 'Y', 'code' => '0112', 'icon' => 'fa fa-paper-plane-o'));
            $category_out_12 = MoneybookCategory::where('disp_name', '=', '저축/보험')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '예금', 'order' => '1', 'use_yn' => 'Y', 'code' => '011201', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '적금', 'order' => '2', 'use_yn' => 'Y', 'code' => '011202', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '펀드', 'order' => '3', 'use_yn' => 'Y', 'code' => '011203', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '보험', 'order' => '4', 'use_yn' => 'Y', 'code' => '011204', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '투자', 'order' => '5', 'use_yn' => 'Y', 'code' => '011205', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_out_12->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '011206', 'icon' => 'fa fa-paper-plane-o'));
        



        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '0', 'parent_code' => '0', 'disp_name' => '수입분류', 'order' => '0', 'use_yn' => 'Y', 'code' => '02'));
        
        $category_inc = MoneybookCategory::where('disp_name', '=', '수입분류')->first();
        
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_inc->code, 'disp_name' => '주수입', 'order' => '1', 'use_yn' => 'Y', 'code' => '0201', 'icon' => 'fa fa-plus-square'));
            $category_inc_1 = MoneybookCategory::where('disp_name', '=', '주수입')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_1->code, 'disp_name' => '급여', 'order' => '1', 'use_yn' => 'Y', 'code' => '020101', 'icon' => 'fa fa-plus-square'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_1->code, 'disp_name' => '상여', 'order' => '2', 'use_yn' => 'Y', 'code' => '020102', 'icon' => 'fa fa-plus-square'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_1->code, 'disp_name' => '사업소득', 'order' => '3', 'use_yn' => 'Y', 'code' => '020103', 'icon' => 'fa fa-plus-square'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_1->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '020104', 'icon' => 'fa fa-plus-square'));
            
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_inc->code, 'disp_name' => '부수입', 'order' => '2', 'use_yn' => 'Y', 'code' => '0202', 'icon' => 'fa fa-plus-circle'));
        $category_inc_2 = MoneybookCategory::where('disp_name', '=', '부수입')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_2->code, 'disp_name' => '이자', 'order' => '1', 'use_yn' => 'Y', 'code' => '020201', 'icon' => 'fa fa-plus-circle'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_2->code, 'disp_name' => '배당금', 'order' => '2', 'use_yn' => 'Y', 'code' => '020202', 'icon' => 'fa fa-plus-circle'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_2->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '020203', 'icon' => 'fa fa-plus-circle'));

        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_inc->code, 'disp_name' => '전월이월', 'order' => '3', 'use_yn' => 'Y', 'code' => '0203', 'icon' => 'fa fa-refresh'));
        $category_inc_3 = MoneybookCategory::where('disp_name', '=', '전월이월')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_3->code, 'disp_name' => '전월이월', 'order' => '1', 'use_yn' => 'Y', 'code' => '020301', 'icon' => 'fa fa-refresh'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_3->code, 'disp_name' => '시작금액', 'order' => '2', 'use_yn' => 'Y', 'code' => '020302', 'icon' => 'fa fa-refresh'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_3->code, 'disp_name' => '잔액조정', 'order' => '3', 'use_yn' => 'Y', 'code' => '020303', 'icon' => 'fa fa-refresh'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_3->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '020304', 'icon' => 'fa fa-refresh'));
        
        MoneybookCategory::create(array('user_id' => '0', 'level' => '1', 'parent_code' => $category_inc->code, 'disp_name' => '저축보험', 'order' => '4', 'use_yn' => 'Y', 'code' => '0204', 'icon' => 'fa fa-paper-plane-o'));
        $category_inc_4 = MoneybookCategory::where('disp_name', '=', '저축보험')->first();
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '예금', 'order' => '1', 'use_yn' => 'Y', 'code' => '020401', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '적금', 'order' => '2', 'use_yn' => 'Y', 'code' => '020402', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '펀드', 'order' => '3', 'use_yn' => 'Y', 'code' => '020403', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '보험', 'order' => '4', 'use_yn' => 'Y', 'code' => '020404', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '투자', 'order' => '5', 'use_yn' => 'Y', 'code' => '020405', 'icon' => 'fa fa-paper-plane-o'));
            MoneybookCategory::create(array('user_id' => '0', 'level' => '2', 'parent_code' => $category_inc_4->code, 'disp_name' => '기타', 'order' => '99', 'use_yn' => 'Y', 'code' => '020406', 'icon' => 'fa fa-paper-plane-o'));

    }

}

?>
