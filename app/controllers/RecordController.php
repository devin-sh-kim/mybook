<?php
use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found Resource', 404);
});

class RecordController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user_id = Auth::user()->id;
        $start = Input::get('start');
        $end = Input::get('end');

        $array_data = array('data' => array());

        //전월 계산
        $prevBalance = Record::getPrevBalance($user_id, $start);
        
        $array_record = array(
			        'id'            => '0',
			        'date_disp'     => '-', 
			        'target_at'     => '-', 
			        'type_name'     => '수입', 
			        'context'       => '지난달 남은 돈', 
			        'value_disp'    => number_format($prevBalance),
			        'sum_disp'      => number_format($prevBalance),
			        'category_name' => '-',
			        'category_icon' => '-',
        );
		$array_data['data'][0] = $array_record;


        //금월
        $sum = $prevBalance;
        $records = Record::join('moneybook_categories', 'records.category_code', '=', 'moneybook_categories.code')
            ->where('records.user_id', '=', $user_id)
            ->whereBetween('records.target_at', array($start, $end))
            ->orderBy('records.target_at', 'asc')
            ->orderBy('records.type', 'asc')
            ->orderBy('records.fix_exp_id', 'desc')
            ->orderBy('records.created_at', 'asc')
            ->select(
            	DB::raw("DATE_FORMAT(records.target_at, '%m. %d') as date_disp"), 
            	"records.target_at", 
            	"records.type", 
            	"records.context", 
            	"records.value", 
            	"records.id", 
            	"records.fix_exp_id", 
            	"moneybook_categories.disp_name as category_name",
            	"moneybook_categories.icon as category_icon"
            )->get();
		//dd($records);
        foreach ($records as $record) {
            //var_dump($record->context);
            
            if($record->type == 'INC'){
                $record->type_name = '수입';
                $sum += $record->value;
            }else{
                $record->type_name = '지출';
                $sum -= $record->value;
            }
            
            if($record->fix_exp_id != '0'){
            	$record->type_name = "고정 ".$record->type_name;
            }
            
            $record->value_disp = number_format($record->value);
            
            $record->sum_disp = number_format($sum);
            
			$array_record = array(
			        'id'            => $record->id,
			        'date_disp'     => $record->date_disp, 
			        'target_at'     => $record->target_at, 
			        'type_name'     => $record->type_name,
			        'type'     		=> $record->type, 
			        'context'       => $record->context, 
			        'value_disp'    => $record->value_disp, 
			        'sum_disp'      => $record->sum_disp,
			        'category_name' => "<i class='" .$record->category_icon . "'></i> " . $record->category_name,
			        'category_icon' => $record->category_icon,
            );
			
		    $array_data['data'][count($array_data['data'])] = $array_record;
		    
        }
        
        // $total_record = array('','','', number_format($sum));
        // $array_data['data'][count($records)] = $total_record;
        
        // 고정 지출 포함
        //$fixExpRecords = FixExpRecord::where('user_id', '=', Auth::id())->get();
        //$result = $this->makeResult($start, $end, $records, $fixExpRecords, $prevBalance);
        //return Response::json($result);
        
        return Response::json($array_data);
        
	}

	private function makeResult($start, $end, $records, $fixExpRecords, $prevBalance){
		
		$result = array('data' => array());
		
		$current_date = date_create_from_format('Y-m-d', $start);;
		$end_date = date_create_from_format('Y-m-d', $end);;
		
		if($current_date > $end_date){
			return null;
		}
		
		while($current_date <= $end_date){
			//$result['data'][count($result['data'])] = $current_date->format('Y-m-d');
			
			$year = $current_date->format('Y');
			$month = $current_date->format('m');
			$day = $current_date->format('d');
			$week = $current_date->format('w');
			$date = $current_date->format('Y-m-d');
			
			// 고정 항목
			foreach($fixExpRecords as $fer){
				$record = null;
				if($fer->type == 'INC'){
		            $type_name = '고정 수입';
		        }else{
		            $type_name = '고정 지출';
		        }
            
            	$value_disp = number_format($fer->value);
            
				switch ($fer->cycle_type){
					case 'Y':
						$cycle_day = preg_split('/[-]/', $fer->cycle_day);
                    	if($month == $cycle_day[0] && $day == $cycle_day[1]){
                    		$record = $this->makeRecord($fer->id, $current_date->format("m. d"), $current_date->format("Y-m-d"), $type_name, $fer->context.' ('.$year.'년)', $value_disp, 0);
                    	}
						break;
					case 'M':
						if($day == $fer->cycle_day){
							$record = $this->makeRecord($fer->id, $current_date->format("m. d"), $current_date->format("Y-m-d"), $type_name, $fer->context .' ('.$month.'월)', $value_disp, 0);
						}
						break;
					case 'W':
						break;
					case 'D':
						break;

				}
				
				if($record != null){
					$result['data'][count($result['data'])] = $record;	
				}
			}

			// 일반 항목
			


			$current_date->modify("+1 day");
		}
		return $result;
	}

	private function makeRecord($id, $date_disp, $target_at, $type_name, $context, $value_disp, $sum_disp){
		$array_record = array(
	        'id'            => $id,
	        'date_disp'     => $date_disp, 
	        'target_at'     => $target_at, 
	        'type_name'     => $type_name, 
	        'context'       => $context, 
	        'value_disp'    => $value_disp, 
	        'sum_disp'      => $sum_disp
        );
        return $array_record;
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
		$target_at 		= Input::get('target_at');
		$type 			= Input::get('type');
		$context 		= Input::get('context');
		$value 			= Input::get('value');
		$category_code	= Input::get('category_code');
		
		//dd($category_code);
		if(!$category_code){
			$category_code = '99';
		}
		
		if(preg_match("/^[0-9,]+$/", $value)) 
			$value = str_replace(',', '', $value);
		
		$record 		= new Record;
	    
	    $record->user_id    = Auth::user()->id;
		$record->target_at 	= $target_at;
		$record->type 		= $type;
		$record->context 	= $context;
		$record->value 		= $value;
		$record->category_code = $category_code;
		
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
		
        $record = Record::select(DB::raw("DATE_FORMAT(target_at, '%Y-%m-%d') as target_at"), "type", "context", "value", "id", "category_code")
            ->where('id', '=', $id)
            ->first();
        //dd($record);
        
        if($record->type == 'INC'){
            $record->type_name = '수입';
        }else{
            $record->type_name = '지출';
        }
            
        $record->value_disp = number_format($record->value);
		
        // $total_record = array('','','', number_format($sum));
        // $array_data['data'][count($records)] = $total_record;
        
        return Response::json($record);
        
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
		$target_at 		= Input::get('target_at');
		$type			= Input::get('type');
		$context 		= Input::get('context');
		$value 			= Input::get('value');
		$category_code	= Input::get('category_code');
		
		if(!$category_code){
			$category_code = '99';
		}
		
		if(preg_match("/^[0-9,]+$/", $value)) 
			$value = str_replace(',', '', $value);
		
		
		$record = Record::findOrFail($id);
		if( $record->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}

		$record->target_at 	= $target_at;
		$record->type	 	= $type;
		$record->context 	= $context;
		$record->value 		= $value;
		$record->category_code = $category_code;

		$result = $record->save();
		
		return Response::json(array('result' => $result));
		
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
		$record = Record::findOrFail($id);
		if( $record->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}

		$result = $record->delete();
		
		return Response::json(array('result' => $result));
	}


}
