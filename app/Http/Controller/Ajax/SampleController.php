<?php

namespace WpPluginner\Http\Controller\Ajax;

use WpPluginner\Http\Controller\AjaxController;
use WpPluginner\Model\Example;


class SampleController extends AjaxController
{
    public function refreshNonce()
    {
        return wp_send_json_success( [ 'nonce' => wp_create_nonce($this->plugin->config()->get('plugin.slug')) ] );
    }

    public function getModel()
    {
        $model = Example::all();
        if ($model) {
            return wp_send_json_success( [ 'examples' => $model ] );
        } else {
            return wp_send_json_error( ['message' => __('Failed to get model Example', WPPLUGINNER_TEXTDOMAIN)] );
        }
    }

    public function createModel()
    {
        if ($this->plugin->request()->has('model')) {
            $create = Example::create(json_decode($this->plugin->request()->get('model'), true));
            if($create) return wp_send_json_success( ['created' => $create] );
            return wp_send_json_error( ['message' => __('Failed to create new model', WPPLUGINNER_TEXTDOMAIN)] );
        }
        return wp_send_json_error( ['message' => __('Missing required parameter', WPPLUGINNER_TEXTDOMAIN)] );
    }

    public function deleteModel()
    {
        if ($this->plugin->request()->has('id')) {
            $delete = Example::where('id',$this->plugin->request()->get('id'))->delete();
            if($delete) return wp_send_json_success( ['deleted' => $delete] );
            return wp_send_json_error( ['message' => __('Failed to delete selected model', WPPLUGINNER_TEXTDOMAIN)] );
        }
        return wp_send_json_error( ['message' => __('Missing required parameter', WPPLUGINNER_TEXTDOMAIN)] );
    }

}
