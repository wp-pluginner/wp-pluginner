<?php

namespace WpPluginner\Http\Controller;

use WpPluginner\Framework\Foundation\Controller as BaseController;

class AdminController extends BaseController {

    public function __construct( $attributes = array() ){
        parent::__construct($attributes);
        $this->load();
    }

    public function load(){
        $manifests = $this->readMixManifest();
        $this->registerAdminStyles($manifests);
        $this->registerAdminScripts($manifests);
        $this->registerAdminLocalizes();
    }

    protected function registerAdminLocalizes(){
        wp_localize_script(
            'wp_pluginner-js',
            'wp_pluginner',
            [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('wp_pluginner'),
            ]
        );
    }

    protected function registerAdminStyles($manifests=false){
        $styles = $this->plugin->config()->get('enqueue.admin_enqueue_styles',[]);
        if($styles && is_array($styles) && !empty($styles)){
            foreach($styles as $style){
                if(isset($style['handle']) && isset($style['src'])){
                    $url = $style['src'] ? $this->plugin->publicUri.$style['src'] : $style['url'];
                    $deps = isset($style['deps']) ? $style['deps'] : [];
                    $version = $manifests && $style['src'] && isset($manifests[($style['src'])]) ? $manifests[($style['src'])] : $this->container->Version;
                    wp_enqueue_style($style['handle'],$url,$deps,$version);
                }
            }
        }
    }

    protected function registerAdminScripts($manifests=false){
        $scripts = $this->plugin->config()->get('enqueue.admin_enqueue_scripts',[]);
        if($scripts && is_array($scripts) && !empty($scripts)){
            foreach($scripts as $script){
                if(isset($script['handle']) && isset($script['src'])){
                    $url = $script['src'] ? $this->plugin->publicUri.$script['src'] : $script['url'];
                    $deps = isset($script['deps']) ? $script['deps'] : [];
                    $version = $manifests && $script['src'] && isset($manifests[($script['src'])]) ? $manifests[($script['src'])] : $this->container->Version;
                    $in_footer = isset($script['in_footer']) ? $script['in_footer'] : false;
                    wp_enqueue_script($script['handle'],$url,$deps,$version,$in_footer);
                }
            }
        }
    }

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
