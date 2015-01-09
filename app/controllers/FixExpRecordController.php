<?php

class FixExpRecordController extends \BaseController {

	/**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		View::share('action', 'moneybook');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->content = View::make('moneybook.fixExpRecord.list');
	}

    public function listJson(){
        
        $records = FixExpRecord::where('user_id', '=', Auth::id())->get();
        
        $array_data = array('data' => array());
        
        for ($i = 0; $i < count($records); $i++) {

            $record = $records[$i];
            
            if($record->type == 'INC'){
                $record->type_name = '수입';
            }else{
                $record->type_name = '지출';
            }
            
            
            
            switch ($record->cycle_type){
                case 'Y':
                    $cycle_day = preg_split('/[-]/', $record->cycle_day);
                    $cycle_disp = "매년 " . $cycle_day[0] . "월 " . $cycle_day[1] . "일";
                    break;
                
                case 'M':
                    $cycle_disp = "매월 " . $record->cycle_day . "일";
                    break;
                
                case 'W':
                    switch ( $record->cycle_day ){
                        case '0':
                            $cycle_day = "일요일";
                            break;
                        case '1':
                            $cycle_day = "월요일";
                            break;
                        case '2':
                            $cycle_day = "화요일";
                            break;
                        case '3':
                            $cycle_day = "수요일";
                            break;
                        case '4':
                            $cycle_day = "목요일";
                            break;
                        case '5':
                            $cycle_day = "금요일";
                            break;
                        case '6':
                            $cycle_day = "토요일";
                            break;
                    }
                    
                    $cycle_disp = "매주 " . $cycle_day;
                    break;
                
                case 'D':
                    $cycle_disp = "매일";
                    break;
                    
            }
             
            $record->cycle_disp = $cycle_disp;
            
            $record->value_disp = number_format($record->value);
            
			$array_record = array(
			        'id'            => $record->id,
			        'cycle_disp'    => $record->cycle_disp, 
			        'type_name'     => $record->type_name, 
			        'context'       => $record->context, 
			        'value_disp'    => $record->value_disp, 
            );
			
		    $array_data['data'][$i] = $array_record;
		    
        }
        
        // $total_record = array('','','', number_format($sum));
        // $array_data['data'][count($records)] = $total_record;
        
        return Response::json($array_data);
        
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		//dd($input);
		
		$record = new FixExpRecord;
		
		$record->user_id = Auth::id();
		$record->type = $input['type'];
		$record->cycle_type = $input['cycle_type'];
		
		switch ($record->cycle_type){
		    case 'Y':
		        $record->cycle_day = $input['cycle_yearly_month'].'-'.$input['cycle_yearly_day'];
		        break;
            case 'M':
		        $record->cycle_day = $input['cycle_monthly_day'];
		        break;
		    case 'W':
		        $record->cycle_day = $input['cycle_weekly'];
		        break;
            case 'D':
		        $record->cycle_day = 1;
		        break;
		}
		
		$record->context = $input['context'];
		
		$value = $input['value'];
		if(preg_match("/^[0-9,]+$/", $value)) 
			$value = str_replace(',', '', $value);
		
		$record->value = $value;
		
		$record->save();
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
