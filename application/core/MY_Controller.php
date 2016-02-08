<?php  if(!defined('BASEPATH')){    exit('No direct script access allowed');}

class MY_Controller extends CI_Controller
{
    public $data = array();
    public $configCustomData = array();
    public $tables = array();
    public $currentDate = '';
    public $currentDateTime = '';
    public $currentTime = '';
    public $currentTimestamp = '';
    public $titlePrifix = 'Qyura | ';
    public $access_denied;
    public $popupMessage = 'You must be an administrator to view this page.';
    public $sessionExp = "Your session has expired. Please log in again";
    public $_moduleId = '';
    
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: text/html; charset=utf-8');
        $this->currentDate = date('Y-m-d');
        $this->currentDateTime = date('Y-m-d H:i:s');
        $this->currentTime = date('H:i:s');
        $this->currentTimestamp = time();

        $this->loader = '<div style="width:100%; text-align:center;"><div><img src="' . base_url() . 'images/ajax-loader.gif" /></div></div>';
        $this->small_loader = '<div><img src="' . base_url() . 'images/loader.gif" /></div>';
        $this->access_denied = $this->session->flashdata('access_denied');

        if ($this->input->is_ajax_request()) {
            if (!$this->ion_auth->logged_in()) {
                if (!($this->router->fetch_class() == 'auth' && ($this->router->fetch_method() == 'loginAjax' || $this->router->fetch_method() == 'forgotPasswordAjax'))) {
                    $script = '<script type="text/javascript">
                    $("#headLoginModal").modal("show");
                </script>';
                    $responce = array('status' => 0, 'isAlive' => FALSE, 'loginMod' => $script);
                    header('Content-Type: application/json');
                    echo json_encode($responce);
                }
            }
        }

    }
}
