<?php

class StampController extends \BaseController {
	
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
		
		$stampCards = StampCard::where('user_id', '=', Auth::user()->id)->get();

		foreach( $stampCards as $stampCard ){
			$stampCard->stamp_count = $this->getStampCount($stampCard);
			
			$prevDate = new DateTime();
			$prevDate->modify('-1 day');
			$stampCard->prev_stamp_count = $this->getStampCount($stampCard, $prevDate);
			//dd($stampCard->prev_stamp_count);
		}

		//dd($stampCards);

		
		View::share('action', 'stamp');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('stamp.list', array('stampCards' => $stampCards));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

		
		View::share('action', 'stamp');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('stamp.create');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		
// 		dd($input);
		
		$card = new StampCard;
        
        $card->user_id          = Auth::user()->id;
        		
		$card->goal             = $input['goal'];
		
		if( isset($input['input_value']) && $input['input_value'] == 'Y'){
		    $card->input_value  = $input['input_value'];    
		}else{
		    $card->input_value  = 'N';    
		}
		
		$card->max_stamp_num    = $input['max_stamp_num'];
		$card->reset_type       = $input['reset_type'];
		
		if( $input['reset_type'] == '2' )
		    $card->reset_day        = $input['reset_weekly'];
		
		if( isset($input['end_date']) )
		    $card->end_date     = $input['end_date'];

		//dd($card);
		
		$result = $card->save();
		
		//dd($result);
		
		return Redirect::to('stamp');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$stampCard = StampCard::findOrFail($id);
		
		$stampCard->stamp_count = $this->getStampCount($stampCard);
		
		$prevDate = new DateTime();
		$prevDate->modify('-1 day');
		$stampCard->prev_stamp_count = $this->getStampCount($stampCard, $prevDate);
		//dd($stampCard->prev_stamp_count);
			
		View::share('action', 'stamp');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('stamp.show', array('stampCard' => $stampCard));
	}

    public function calendar($id){
        
        $stampCard = StampCard::findOrFail($id);
        
        View::share('action', 'stamp');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        $this->layout->content = View::make('stamp.calendar', array('stampCard' => $stampCard));
        
    }

    public function calendarJson($id){
        
        //start=2014-12-28&end=2015-02-08
        
        $start = Input::get('start');
        $end = Input::get('end');

        $calendarData = DB::table('stamps')
                            ->select(DB::raw("count(*) as title, DATE(stamped_at) as start"))
                            ->where('stamp_card_id', '=', $id)
                            ->whereBetween('stamped_at', array($start, $end))
                            ->groupBy('stamped_at')
                            ->get();

        $stampCard = StampCard::findOrFail($id);

        if($stampCard->end_date != '0000-00-00'){
            $meta = array(
                'rendering' => 'background',
                'start' => $stampCard->created_at->toDateString(),
                'end' => $stampCard->end_date
                //'start' => $stampCard->end_date
            );
    
            array_push($calendarData, $meta);
        }
        
        //dd($meta);
        //dd($calendarData);

        return Response::json($calendarData);
    }



    public function chart($id){
        
        $type = Input::get('type');
        
        if($type == null){
            $type = 'daily';
        }
        
        $stampCard = StampCard::findOrFail($id);
        
        View::share('action', 'stamp');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        //$this->layout->script = View::make('stamp.list_script');
        
        if($type == 'user-value'){
            $this->layout->content = View::make('stamp.userValueChart', array('stampCard' => $stampCard));
        } else {
            $this->layout->content = View::make('stamp.dailyStampChart', array('stampCard' => $stampCard));
        }
        
    }

    public function dailyStampChartJson($id){
        
        $chartData = DB::table('stamps')
                            ->select(DB::raw("COUNT(*) as value, DATE_FORMAT(stamped_at,'%Y-%m-%d') as stamp"))
                            ->where('stamp_card_id', '=', $id)
        //                    ->whereBetween('stamped_at', array($start, $end))
                            ->orderBy('created_at')
                            ->groupBy('stamped_at')
                            ->get();
        
        foreach($chartData as $d){
            $arrayData[$d->stamp] = array('value' => $d->value, 'stamp' => $d->stamp);
        }

        if(count($chartData) > 0){
            
            
            $start = $chartData[0]->stamp;
            $end = $chartData[count($chartData) -1]->stamp;
            
            //dd($start . " - " . $end);
            
            $startDate = new DateTime($start);
            $endDate = new DateTime($end);
            $diffDays = $endDate->diff($startDate)->days;
            //dd($diffDays);
            
            for($i = 0; $i < $diffDays; $i++){
                $startDate->modify("+1 day");
                $dateStr = $startDate->format("Y-m-d");
                
                if(isset($arrayData[$dateStr])){
                    
                }else{
                    $arrayData[$dateStr] = array('value' => '0', 'stamp' => $dateStr);
                }
                
            }
            
        }

        $array = array_values(array_sort($arrayData, function($value)
            {
                return $value['stamp']; 
            }
        ));
            
        
        return Response::json($array);
    }

    public function userValueChartJson($id){
        
        $chartData = DB::table('stamps')
                            ->select(DB::raw("value, DATE_FORMAT(created_at,'%Y-%m-%d %H:%i') as stamp"))
                            ->where('stamp_card_id', '=', $id)
        //                    ->whereBetween('stamped_at', array($start, $end))
                            ->orderBy('id')
                            ->get();
        
        return Response::json($chartData);
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

	public function addStamp($id){
		
		$input = Input::all();
		
		
		$stamp = new Stamp;
		$stamp->user_id = Auth::user()->id;
		$stamp->stamp_card_id = $id;
		$stamp->stamped_at = date('Y-m-d');
		
		if(isset($input['value'])){
		    $stamp->value = $input['value'];
		}
		
		//dd($stamp);
		
		$stamp->save();
		
		$stampCard = StampCard::findOrFail($id);
		
		return $this->getStampCount($stampCard);
		
	}

    private function getStampCount($stampCard, $targetDate = null){
        
        if($targetDate == null){
        	$targetDate = new DateTime();
        }
        
    	$stampCount = 0;
		if( $stampCard->reset_type == '0' ){ //반복 없음

			$stampCount = Stamp::where('stamp_card_id', '=', $stampCard->id)->count();

		}else if( $stampCard->reset_type == '1' ){ // 매일
			
			$stampCount = Stamp::where('stamp_card_id', '=', $stampCard->id)->where('stamped_at', '=', $targetDate->format('Y-m-d'))->count();
		
		}else if( $stampCard->reset_type == '2' ){ // 매주
			
			
			$reset_day = $stampCard->reset_day;
			$date = $targetDate;
			
			$week_num = (date('N') - $reset_day);
			if($week_num < 0){
				$week_num = $week_num + 7;
			}
			//dd($week_num);
			$date->modify("-".$week_num." day");
			$week_start = $date->format('Y-m-d');
			$date->modify("+6 day");
			$week_end = $date->format('Y-m-d');
			//dd($week_start . " ~ " . $week_end);
			
			$stampCount = Stamp::where('stamp_card_id', '=', $stampCard->id)->whereBetween('stamped_at', array($week_start, $week_end))->count();
			
		}else if( $stampCard->reset_type == '3' ){ // 매월 1일
			
			$date = $targetDate;
			
			//$date->setDate('2014', '9', '23');
			$date->setDate($date->format('Y'), $date->format('m'), '1');
			$month_start = $date->format('Y-m-d');
			$date->modify("+1 months");
			$date->modify("-1 day");
			$month_end = $date->format('Y-m-d');
			//dd($month_start . " ~ " . $month_end);
			
			$stampCount = Stamp::where('stamp_card_id', '=', $stampCard->id)->whereBetween('stamped_at', array($month_start, $month_end))->count();

		}
		//$stampCard->stamp_count = $stampCount;
        return $stampCount;
    }
    
    public function removeLastStamp($id)
    {
    	$stampCard = StampCard::findOrFail($id);
    	
    	$stamp = Stamp::where('user_id', '=', Auth::user()->id)
    		->where('stamp_card_id', '=', $id)
    		->orderBy('created_at', 'desc')
    		->first();
    	
    	if($stamp != null){
    		$stamp->delete();
    	}
    	
    	return $this->getStampCount($stampCard);
    }
    
}
