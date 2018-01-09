<?php

namespace WpPluginner\Http\Controller;

use WpPluginner\Framework\Foundation\Controller as BaseController;

class FrontendController extends BaseController {

    public function about(){
        $this->plugin->view( 'frontend.layout' );
    }
}
