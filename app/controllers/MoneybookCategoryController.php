<?php

class MoneybookCategoryController extends \BaseController {

	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = MoneybookCategory::where('parent_code', '=', '01')->get();
		
		$sub_categories = array();
		
		foreach($categories as $category){
			$sub = MoneybookCategory::where('parent_code', '=', $category->code)->get();
			$sub_categories[$category->code] = $sub;
		}
		
		View::share('action', '');
	        $this->layout->head = View::make('layouts.head');
	        $this->layout->header = View::make('layouts.header');
	        $this->layout->sidebar = View::make('layouts.sidebar');
	        $this->layout->footer = View::make('layouts.footer');
	        $this->layout->content = View::make('category.list', array('categories' => $categories, 'sub_categories' => $sub_categories));
		
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
		//
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
