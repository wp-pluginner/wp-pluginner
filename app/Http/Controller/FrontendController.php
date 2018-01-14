<?php

namespace WpPluginner\Http\Controller;

use WpPluginium\Framework\Foundation\Controller as BaseController;

class FrontendController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles base custom plugin frontend url.
    |
    */

    /**
     * Show about.
     *
     * @return void
     */
    public function about(){
        $this->plugin->view( 'frontend.layout' );
    }
}
