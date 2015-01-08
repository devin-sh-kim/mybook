<?php

class MoneyBookSettingController extends \BaseController {

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
		$setting = new stdClass();
		
		$start_day = UserSetting::getSetting(Auth::user()->id, __USER_SETTING_ID_MONEYBOOK_START_DAY__);
		
		$setting->startDay = $start_day;
		//dd($setting);
		View::share('action', 'moneybook');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        
        $this->layout->content = View::make('moneybook.setting.list', array('setting' => $setting));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$startDay = Input::get('startDay');
		//dd($startDay);
		
		UserSetting::setSetting(Auth::user()->id, __USER_SETTING_ID_MONEYBOOK_START_DAY__, $startDay);
		
		return Redirect::to('moneybook-setting');
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
