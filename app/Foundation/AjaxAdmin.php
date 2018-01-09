<?php

namespace WpPluginner\Foundation;

use WpPluginner\Framework\Foundation\ServiceProvider;
use Exception;
if ( ! defined( 'ABSPATH' ) ) exit;
class AjaxAdmin extends ServiceProvider
{
    protected $prefix;

    public function register()
    {
        $name_prefix = $this->plugin->slug.'_'.$this->prefix;
        add_action( 'wp_ajax_' . $name_prefix, [ $this, 'handle' ] );
    }

    public function handle(){
        if(! $callFunction = $this->request->get('call')){
            return wp_send_json_error( ['message' => __('Undefined Ajax Request',$this->plugin->slug)] );
        }
        if(! check_ajax_referer($this->plugin->TextDomain,'nonce',false) ){
            return wp_send_json_error( ['message' => __('Security check',$this->plugin->slug)] );
        }
        if(! method_exists($this,$callFunction)){
            return wp_send_json_error( ['message' => __('Undefined Call Request',$this->plugin->slug)] );
        }
        return $this->{$callFunction}();
    }

}
