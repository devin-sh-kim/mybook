<?php

class DashboardController extends BaseController {

    /**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.master';

    public function dashboard()
    {
        View::share('action', 'dashboard');
        
        $this->layout->head = View::make('layouts.head');
        $this->layout->header = View::make('layouts.header');
        $this->layout->sidebar = View::make('layouts.sidebar');
        $this->layout->footer = View::make('layouts.footer');
        $this->layout->script = View::make('dashboard.script');
        $this->layout->content = View::make('dashboard.dashboard');
    }
    
}

?>