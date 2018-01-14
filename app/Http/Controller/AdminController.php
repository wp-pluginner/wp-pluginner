<?php

namespace WpPluginner\Http\Controller;

use WpPluginium\Framework\Foundation\Controller as BaseController;

class AdminController extends BaseController {
    /*
    |--------------------------------------------------------------------------
    | Admin Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles base plugin admin menu  with auto register
    | app.css, app.js, and localize JS variable to wordpress admin.
    |
    */

    /**
     * Create a new controller instance.
     *
     * @param  array  $attributes
     * @return void
     */
    public function __construct( $attributes = array() ){
        parent::__construct($attributes);
        $this->load();
    }

    /**
     * Register assets to wordpress admin.
     *
     * @return void
     */
    public function load(){
        $manifests = $this->readMixManifest();
        $this->registerAdminStyles($manifests);
        $this->registerAdminScripts($manifests);
        $this->registerAdminLocalizes();
    }

    /**
     * Register JS variables to wordpress admin.
     *
     * @return void
     */
    protected function registerAdminLocalizes(){
        wp_localize_script(
            'wp_pluginner-js',
            'wp_pluginner',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce($this->plugin->config()->get('plugin.slug')),
            ]
        );
    }

    /**
     * Register css to wordpress admin, If in development mode, read
     * mix-manifest.json to controll css version if exists.
     *
     * @param  array|boolean  $manifests
     * @return void
     */
    protected function registerAdminStyles( $manifests = false )
    {
        $src = '/css/app.css';
        $version = $manifests && isset($manifests[$src]) ? $manifests[$src] : $this->plugin->metaData('Version');
        $url = $this->plugin->publicUri . $src;
        wp_enqueue_style('wp_pluginner-css',$url,[],$version);
        $styles = $this->plugin->config()->get('enqueue.admin_enqueue_styles',[]);
    }

    /**
     * Register js to wordpress admin, If in development mode, read
     * mix-manifest.json to controll js version if exists.
     *
     * @param  array|boolean  $manifests
     * @return void
     */
    protected function registerAdminScripts($manifests=false){
        $src = '/js/app.js';
        $version = $manifests && isset($manifests[$src]) ? $manifests[$src] : $this->plugin->metaData('Version');
        $url = $this->plugin->publicUri . $src;
        wp_enqueue_script('wp_pluginner-js',$url,['jquery'],$version,true);
    }

    /**
     * Read mix-manifest.json to controll css and js version.
     *
     * @return void
     */
    protected function readMixManifest(){
        $dev = $this->plugin->config()->get('plugin.development',false);
        if(!$dev) return false;
        $manifestFile = $this->plugin->public_path.'/mix-manifest.json';
        if (! file_exists($manifestFile)) {
            return false;
        }
        $manifests = json_decode(file_get_contents($manifestFile), true);
        foreach($manifests as $key => $manifest){
            $version = $this->plugin->Version;
            $query_str = parse_url($manifest, PHP_URL_QUERY);
            if($query_str){
                parse_str($query_str,$output);
                if(isset($output['id'])) $version = $output['id'];
            }
            $manifests[$key] = $version;
        }
        return $manifests;
    }
}
