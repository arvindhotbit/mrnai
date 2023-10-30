<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cron extends CI_Controller {

	public function __construct() {
		parent::__construct();
		error_reporting(0);
		ob_start();
		error_reporting(0);
		@ini_set( 'upload_max_size' , '128M' );
		@ini_set( 'post_max_size', '128M');
		@ini_set( 'max_execution_time', '900' );
		$this->load->model(array('admin/Common_model'));
		$this->load->helper('common_helper');
	}


    
}
