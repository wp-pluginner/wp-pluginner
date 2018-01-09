<?php

namespace WpPluginner\Ajax;

use WpPluginner\Foundation\AjaxAdmin;
use WpPluginner\File;
use Exception;

class Import extends AjaxAdmin
{
    protected $prefix = 'import';

    protected function create(){
        try{
            $file = $_FILES['file'];
            $base_upload_dir = $this->getBaseUploadDirectory();
            $unique_dir = md5(time());
            $upload_dir = $base_upload_dir.DIRECTORY_SEPARATOR.$unique_dir;
            wp_mkdir_p($upload_dir);
            $filePath = $upload_dir.DIRECTORY_SEPARATOR.$file['name'];
            $saveFile = $this->saveFileToUploadDirectory($file,$filePath);

            if($saveFile){
                $createFile = $this->saveFileRecord([
                    'file_name' => $file['name'],
                    'file_path' => $unique_dir
                ]);
                return wp_send_json_success( [ 'file_id' => $createFile->id ] );
            }
            return wp_send_json_error( [ 'message' => __('Can\'t save file', $this->plugin->TextDomain) ] );
        }catch(Exception $e){
            return wp_send_json_error( [ 'message' => $e->getMessage() ] );
        }

    }

    private function saveFileRecord(Array $record){
        try{
            return File::create($record);
        }catch(Exception $e){
            $message = sprintf(__('Can\'t save file record: ', $this->plugin->TextDomain),$e->getMessage());
            throw new Exception($message);
        }
    }

    private function saveFileToUploadDirectory($file,$filePath){
        try{
            return move_uploaded_file($file['tmp_name'],$filePath);
        }catch(Exception $e){
            $message = sprintf(__('Can\'t save file: ', $this->plugin->TextDomain),$e->getMessage());
            throw new Exception($message);
        }
    }

    private function getBaseUploadDirectory(){
        $wp_upload_dir = wp_upload_dir();
        if(! empty($wp_upload_dir['basedir'])){
            $upload_dir = $wp_upload_dir['basedir'].DIRECTORY_SEPARATOR.(WpPluginner()->TextDomain);
            wp_mkdir_p($upload_dir);
            if(!file_exists($upload_dir.DIRECTORY_SEPARATOR.'index.php')){
                touch($upload_dir.DIRECTORY_SEPARATOR.'index.php');
            }
            return $upload_dir;
        }
        throw new Exception(__('Can\'t get uploads directory',$this->plugin->TextDomain));
    }

}
