<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FixExpApply extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'moneybook:fix-exp-apply';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Moneybook Service - fix-exp record apply to records table.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		
		if($this->option('user') != null){
			$user = User::find($this->option('user'));
			if($user == null){
				$this->error("not found user : " . $this->option('user'));
				return;
			}else{
				//$this->info($user->email);
				$users = array($user);
			}
		}else{
			$users = User::get();
		}
		
		
		
		foreach($users as $u){
			$this->info("Apply Fix-Exp Record : " . $u->email);
			
			if($this->option('date') != null){
				$dates = array($this->option('date'));
			}else{
				$dates = array();
				$r = Record::select(DB::raw('DATE_FORMAT(target_at, "%Y-%m-%d") as target_at'))->where('user_id', '=', $u->id)->orderBy('target_at')->first();
				if(count($r) > 0){
					$start_date = date_create_from_format('Y-m-d', $r->target_at);
					//$this->info($start_date->format("Y-m-d"));
					$today = new DateTime();
					$today = $today->format('Y-m-d');
					if($today >= $start_date->format('Y-m-d')){
						while(1){
							$dates[count($dates)] = $start_date->format('Y-m-d');
							if($today == $start_date->format('Y-m-d')){
								break;
							}else{
								$start_date->modify("+1 day");
							}
						}	
					}
				}
				
			}
			
			$fixExpRecords = FixExpRecord::where('user_id', '=', $u->id)->get();
			
			foreach($dates as $d){
				$this->info("\tProcess : " . $d);
				
				$clearCount = $this->clearFixExp($u->id, $d);
				$this->info("\t\tClear Records : " . $clearCount);
				if(!$this->option('clear')){
					$applyCount = $this->applyFixExp($u->id, $d, $fixExpRecords);
					$this->info("\t\tApply Records : " . $applyCount);
				}
			}
		}
	}

	private function clearFixExp($user_id, $date){
		$count = Record::where('user_id', '=', $user_id)->where('target_at', '=', $date)->where('fix_exp_id', '!=', '0')->delete();
		return $count;
	}
	
	private function applyFixExp($user_id, $date, $fixExpRecords){
		$count = 0;
		$d = date_create_from_format('Y-m-d', $date);
		$year = $d->format('Y');
		$month = $d->format('m');
		$day = $d->format('d');
		$week = $d->format('w');
		
		// 고정 항목
		foreach($fixExpRecords as $fer){
			$record = null;

			$start_at = date_create_from_format('Y-m-d H:i:s', $fer->start_at);
			$end_at = date_create_from_format('Y-m-d H:i:s', $fer->end_at);
			
			$start_at = $start_at->format('Y-m-d');
			$end_at = $end_at->format('Y-m-d');
			
			if($date >= $start_at && $date <= $end_at){
				switch ($fer->cycle_type){
					case 'Y':
						$cycle_day = preg_split('/[-]/', $fer->cycle_day);
	                	if($month == $cycle_day[0] && $day == $cycle_day[1]){
	                		$record = $this->convFixExpToRecord($user_id, $fer->id, $date, $fer->type, $fer->context.' ('.$year.'년)', $fer->value);
	                	}
						break;
					case 'M':
						if($day == $fer->cycle_day){
							$record = $this->convFixExpToRecord($user_id, $fer->id, $date, $fer->type, $fer->context.' ('.$month.'월)', $fer->value);
						}
						break;
					case 'W':
						break;
					case 'D':
						break;
	
				}
				
				if($record != null){
					$record->save();
					$count++;
				}
			}
		}
		
		return $count;
		
	}

	private function convFixExpToRecord($user_id, $fix_exp_id, $target_at, $type, $context, $value){
		
		$record = new Record;
		
		$record->user_id 		= $user_id;
		$record->fix_exp_id 	= $fix_exp_id;
		$record->target_at 		= $target_at;
		$record->type 			= $type;
		$record->context 		= $context;
		$record->value 			= $value;
		
        return $record;
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('user', 'u', InputOption::VALUE_OPTIONAL, 'user id', null),
			array('date', null, InputOption::VALUE_OPTIONAL, 'target date(YYYY-MM-DD)', null),
			array('clear', null, InputOption::VALUE_NONE, 'clear fix-exp records', null),
		);
	}

}
