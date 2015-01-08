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
		//
		$start_day = UserSetting::getSetting(Auth::user()->id, __USER_SETTING_ID_MONEYBOOK_START_DAY__);
		//dd($start_day);

		$range = $this->makeRange($start_day);
		
		//dd($range);
		
		View::share('action', 'moneybook');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('moneybook.list', array('start' => $range['start'], 'end' => $range['end']));
		
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

    private function makeRange($start_day){
        $date = new DateTime();

        $today = $date->format('d');
		
		$date->setDate($date->format('Y'), $date->format('m'), $start_day);
		
		if($today < $start_day){
		    $date->modify("-1 month");
		}
			
		//$date->setDate('2014', '9', '23');
		
		$start = $date->format('Y-m-d');

		$date->modify("+1 months");
		$date->modify("-1 day");
		$end = $date->format('Y-m-d');
		//dd($start . " ~ " . $end);
		
        return array('start' => $start, 'end' => $end);
    }

}
