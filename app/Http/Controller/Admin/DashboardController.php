<?php

namespace WpPluginner\Http\Controller\Admin;

use WpPluginner\Http\Controller\AdminController;
use WpPluginner\Framework\WpPluginner;

class DashboardController extends AdminController
{
    public function index()
    {
        $this->plugin->view( 'dashboard', $this->attributes );
    }
}
