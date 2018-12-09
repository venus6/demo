<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {
    protected $_ci_model_paths = array(APPPATH, COMMON_APP_PATH);
    protected $_ci_library_paths = array(COMMON_APP_PATH, APPPATH, BASEPATH);
    protected $_ci_helper_paths =   array(COMMON_APP_PATH, APPPATH, BASEPATH);
}