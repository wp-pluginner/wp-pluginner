<?php

namespace WpPluginner\Http\Controller;

use WpPluginium\Framework\Foundation\Controller as BaseController;

class AjaxController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Ajax Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles base plugin ajax request  with nonce verification.
    |
    */

    /**
     * Ajax execution.
     *
     * @return  mixed  response
     */
    public function execute(){
        if (!$this->plugin->request()->has('function')) {
            return wp_send_json_error( ['message' => __('Undefined Ajax Request', WP_PLUGINNER_TEXTDOMAIN)] );
        }
        if (!check_ajax_referer($this->plugin->config()->get('plugin.slug'), 'nonce', false)) {
            return wp_send_json_error( ['message' => __('Security check', WP_PLUGINNER_TEXTDOMAIN)] );
        }
        $callFunction = $this->plugin->request()->get('function');
        if(! method_exists($this,$callFunction)){
            return wp_send_json_error( ['message' => __('Undefined Call Request', WP_PLUGINNER_TEXTDOMAIN)] );
        }
        return $this->{$callFunction}();
    }
}
