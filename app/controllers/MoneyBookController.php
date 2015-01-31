<?php

class MoneyBookController extends \BaseController {

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
		$start_day = UserSetting::getSetting(Auth::user()->id, __USER_SETTING_ID_MONEYBOOK_START_DAY__);

		$input = Input::all();
		
		$now = new DateTime();
		
		if(isset($input['y'])){
			$year = $input['y'];
		}else{
			$year = $now->format('Y');
		}
		
		if(isset($input['m'])){
			$month = $input['m'];
		}else{
			$month = $now->format('m');
		}
		
		$range = $this->makeRange($year, $month, $start_day);

		$categories = MoneybookCategory::get();
		
		View::share('action', 'moneybook');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->content = View::make('moneybook.list', array("range" => $range, "categories" => $categories));
		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		View::share('action', 'moneybook');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('moneybook.create');
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		//dd(Input::all());
		
		$target_at 		= Input::get('target_at');
		$type 			= Input::get('type');
		$context 		= Input::get('context');
		$value 			= Input::get('value');
	
		
		if(preg_match("/^[0-9,]+$/", $value)) 
			$value = str_replace(',', '', $value);
		
		$record 		= new Record;
	    
	    $record->user_id    = Auth::user()->id;
		$record->target_at 	= $target_at;
		$record->type 		= $type;
		$record->context 	= $context;
		$record->value 		= $value;
		
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

    private function makeRange($year, $month, $day){
        $date = new DateTime();

        $today = $date->format('d');
		
		$date->setDate($year, $month , $day);
		
		if($today < $day){
		    $date->modify("-1 month");
		}
			
		//$date->setDate('2014', '9', '23');
		
		$start = $date->format('Y-m-d');

		$date->modify("+1 months");
		$date->modify("-1 day");
		$end = $date->format('Y-m-d');
		//dd($start . " ~ " . $end);
		
		$prev = new DateTime();
		$prev->setDate($year, $month , $day);
		$prev->modify("-1 month");
		$prev_year = $prev->format("Y");
		$prev_month = $prev->format("m");
		
		$next = new DateTime();
		$next->setDate($year, $month , $day);
		$next->modify("+1 month");
		$next_year = $next->format("Y");
		$next_month = $next->format("m");
		
		
        return array(
        	'start' => $start, 
        	'end' => $end,
        	'prev_year' => $prev_year,
        	'prev_month' => $prev_month,
        	'next_year' => $next_year,
        	'next_month' => $next_month,);
    }

}
