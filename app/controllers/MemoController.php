<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

App::error(function(ModelNotFoundException $e)
{
    return Response::make('Not Found Resource', 404);
});

class MemoController extends \BaseController {

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
		$memos = Memo::where('user_id', '=', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(9);
        
		View::share('action', 'memo');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->script = View::make('memo.list_script');
        $this->layout->content = View::make('memo.list', array('memos' => $memos));
		
		Session::put('LAST_PAGE', Input::get('page'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		View::share('action', 'memo');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->script = View::make('memo.create_script');
        $this->layout->content = View::make('memo.create');

	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		
		
		$input = Input::all();
		
		
		$memo = new Memo;
		$memo->user_id = Auth::user()->id;
		$memo->title = $input['title'];
		$memo->context = $input['context'];

        if( $memo->title == '' ){
            $memo->title = date("Y년 n월 j일  g시 i분(A)에 저장된 메모입니다.");
        }

		if (Input::hasFile('attach'))
        {
            $file = Input::file('attach');
            $attachType = $file->getMimeType();
            $filename = $file->getClientOriginalName();
            $filename = rawurldecode($filename);
            
            $attachFileName = date_timestamp_get(date_create()) . '_' . str_random(40); 
            if( $file->getClientOriginalExtension() != '' ){
                $attachFileName = $attachFileName . '.' . $file->getClientOriginalExtension(); 
            }
            
            $file->move(base_path() . '/attach', $attachFileName);

            $memo->filename = $filename;
            $memo->attach_key = $attachFileName;
            $memo->attach_type = $attachType;
        }

        $memo->save();
		
		return Redirect::to('memo');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$memo = Memo::findOrFail($id);
		
		if( $memo->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}
		
		View::share('action', 'memo');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->script = View::make('memo.show_script');
        $this->layout->content = View::make('memo.show', array('memo' => $memo));
	}

    // public function getAttachFile($id){
        
    //     $memo = Memo::findOrFail($id);
        
    //     $attachFilename = $memo->attach;
    //     $filename = $memo->filename;
        
    //     if($attachFilename == ''){
    //         return Response::make('Not Found Resource', 404);
    //     }else{
    //         $path = base_path() . '/attach/' . $attachFilename;

    //         $headers = array('Content-Disposition', 'inline; filename="' . $filename . '"');

    //         return Response::download(base_path() . '/attach/' . $attachFilename, $filename, $headers);
    //     }
    // }
    
    public function getAttachFile($id){
 
        $mode = Input::get('mode', 'inline');
 
        $memo = Memo::findOrFail($id);
        
        if( $memo->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}

        
        $attachFilename = $memo->attach_key;
        $filename = $memo->filename;
        
        if($attachFilename == ''){
            return Response::make('Not Found Resource', 404);
        }else{
            $path = base_path() . '/attach/' . $attachFilename;
            if (file_exists($path)) {
                
                if ( $mode == 'inline' ){
                    //header('Content-Description: File Transfer');
                    header('Content-Type: ' . $memo->attach_type);
                    header('Content-Disposition: inline; filename=' . $filename);
                    //header('Expires: 0');
                    //header('Cache-Control: must-revalidate');
                    //header('Pragma: public');
                    header('Content-Length: ' . filesize($path));
                    readfile($path);
                    exit;    
                }else{
                    return Response::download(base_path() . '/attach/' . $attachFilename, $filename);      
                }
                
            }else{
                return Response::make('Not Found Resource', 404);
            }
        }
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
		$memo = Memo::findOrFail($id);

        if( $memo->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}
		
		View::share('action', 'memo');
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->script = View::make('memo.edit_script');
        $this->layout->content = View::make('memo.edit', array('memo' => $memo));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		
		
		$memo = Memo::findOrFail($id);

        if( $memo->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}
		
		//$memo->user_id = Auth::user()->id;
		$memo->title = $input['title'];
		$memo->context = $input['context'];

        if (isset($input['removeAttach'])){
            $removeAttach = $input['removeAttach'];
            
            $memo->filename = '';
            $memo->attach_key = '';
            $memo->attach_type = '';
            
        }

		if (Input::hasFile('attach'))
        {
            $file = Input::file('attach');
            $attachType = $file->getMimeType();
            $filename = $file->getClientOriginalName();
            $filename = rawurldecode($filename);
            
            $attachFileName = date_timestamp_get(date_create()) . '_' . str_random(40); 
            if( $file->getClientOriginalExtension() != '' ){
                $attachFileName = $attachFileName . '.' . $file->getClientOriginalExtension(); 
            }
            
            //dd($filename . ", " . $attachFileName);
            
            $file->move(base_path() . '/attach', $attachFileName);

            $memo->filename = $filename;
            $memo->attach_key = $attachFileName;
            $memo->attach_type = $attachType;
        }
        
        $memo->save();
		
		return Redirect::to('memo/' . $id);
		
		
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$memo = Memo::findOrFail($id);

        if( $memo->user_id != Auth::user()->id){
		    return Response::make('Forbidden', 403);
		}

		$result = $memo->delete();
		
		return Response::json(array('result' => $result));
	}


}
