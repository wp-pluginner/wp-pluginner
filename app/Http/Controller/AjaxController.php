<?php

namespace WpPluginner\Http\Controller;

use WpPluginner\Framework\Foundation\Controller as BaseController;

class AjaxController extends BaseController {

    public function execute(){
        if (!$this->plugin->request()->has('function')) {
            return wp_send_json_error( ['message' => __('Undefined Ajax Request', WPPLUGINNER_TEXTDOMAIN)] );
        }
        if (!check_ajax_referer($this->plugin->config()->get('plugin.slug'), 'nonce', false)) {
            return wp_send_json_error( ['message' => __('Security check', WPPLUGINNER_TEXTDOMAIN)] );
        }
        $callFunction = $this->plugin->request()->get('function');
        if(! method_exists($this,$callFunction)){
            return wp_send_json_error( ['message' => __('Undefined Call Request', WPPLUGINNER_TEXTDOMAIN)] );
        }
        return $this->{$callFunction}();
    }
}
