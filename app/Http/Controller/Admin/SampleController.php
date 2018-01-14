<?php

namespace WpPluginner\Http\Controller\Admin;

use WpPluginium\Framework\WpPluginner;

use WpPluginner\Http\Controller\AdminController;
use WpPluginner\Model\Example;


class SampleController extends AdminController
{
    public function dashboard()
    {
        print $this->plugin->view()->make( 'admin.dashboard', $this->attributes );
    }

    public function modelVue()
    {
        print $this->plugin->view()->make( 'admin.model-vue', $this->attributes );
    }

    public function model()
    {
        $message = false;
        if ($this->plugin->request()->method() == 'POST') {
            if (
                $this->plugin->request()->has('_action') &&
                $this->plugin->request()->get('_action') == 'create' &&
                $this->plugin->request()->has('key') &&
                $this->plugin->request()->has('value')
            ) {
                $create = Example::create([
                    'key' => $this->plugin->request()->get('key'),
                    'value' => $this->plugin->request()->get('value'),
                ]);
                if($create){
                    $message = [
                        'status' => 'success',
                        'text' => 'New model created'
                    ];
                }else{
                    $message = [
                        'status' => 'danger',
                        'text' => 'Failed to create new model'
                    ];
                }

            } elseif (
                $this->plugin->request()->has('_action') &&
                $this->plugin->request()->get('_action') == 'delete' &&
                $this->plugin->request()->has('id')
            ) {
                $delete = Example::where('id',$this->plugin->request()->get('id'))->delete();
                if($delete){
                    $message = [
                        'status' => 'success',
                        'text' => 'Selected model deleted'
                    ];
                }else{
                    $message = [
                        'status' => 'danger',
                        'text' => 'Failed to delete selected model'
                    ];
                }

            }
        }
        $model = Example::all();
        $attributes = $this->attributes;
        $attributes['model'] = $model;
        print $this->plugin->view()->make( 'admin.model', $attributes )->with('message',$message);
    }
}
