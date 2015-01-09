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
        );
		$array_data['data'][0] = $array_record;


        //금월
        $sum = $prevBalance;
        $records = Record::select(DB::raw("DATE_FORMAT(target_at, '%m. %d') as date_disp"), "target_at", "type", "context", "value", "id")
            ->where('user_id', '=', $user_id)
            ->whereBetween('target_at', array($start, $end))
            ->orderBy('target_at', 'asc')
            ->orderBy('type', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($records as $record) {
            //var_dump($record->context);
            
            if($record->type == 'INC'){
                $record->type_name = '수입';
                $sum += $record->value;
            }else{
                $record->type_name = '지출';
                $sum -= $record->value;
            }
            
            $record->value_disp = number_format($record->value);
            
            $record->sum_disp = number_format($sum);
            
			$array_record = array(
			        'id'            => $record->id,
			        'date_disp'          => $record->date_disp, 
			        'target_at'     => $record->target_at, 
			        'type_name'     => $record->type_name, 
			        'context'       => $record->context, 
			        'value_disp'    => $record->value_disp, 
			        'sum_disp'      => $record->sum_disp
            );
			
		    $array_data['data'][count($array_data['data'])] = $array_record;
		    
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
		
        $record = DB::table('records')
            ->select(DB::raw("DATE_FORMAT(target_at, '%m. %d') as date_disp"), "target_at", "type", "context", "value", "id")
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
		$record = Record::findOrFail($id);
		if( $record->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}

		$result = $record->delete();
		
		return Response::json(array('result' => $result));
	}


}
