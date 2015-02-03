<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Record extends Eloquent {

	use SoftDeletingTrait;

    public static function getStartValue($user_id, $start, $end){
        
        $record = Record::where('user_id', '=', $user_id)
            ->where('type', '=' , 'STV')
            ->whereBetween('target_at', array($start, $end))
            ->first();
        
        if($record){
            return $record->value;    
        }else {
            0;
        }
        
        
    }

    public static function getPrevBalance($user_id, $start){
        
        $records = Record::select(DB::raw("DATE_FORMAT(target_at, '%m. %d') as date_disp"), "target_at", "type", "context", "value", "id")
            ->where('user_id', '=', $user_id)
            ->where('target_at', '<' , $start)
            ->orderBy('target_at', 'asc')
            ->orderBy('type', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
        
        $sum = 0;
        
         for ($i = 0; $i < count($records); $i++) {
            //var_dump($record->context);
            
            $record = $records[$i];
            
            if($record->type == 'INC'){
                $sum += $record->value;
            }else{
                $sum -= $record->value;
            }

        }
        
        return $sum;
    }

}
?>