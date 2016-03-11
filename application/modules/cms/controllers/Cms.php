<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends MY_Controller {

    public $error_message = '';

    public function __construct() {
        parent:: __construct();
        // $this->load->library('form_validation');
        $this->load->model('cms_model');
    }

    function index() {
        $data = array();

        $data['title'] = 'CMS';
        $this->load->super_admin_template('cmsList', $data, 'cmsScript');
    }  
    
     /**
     * @project Qyura
     * @method addcms
     * @description add cms view form
     * @access public
     */
    function addcms() {
        $data = array();
        $data['title'] = 'Add CMS';
        $this->load->super_admin_template('addcms', $data, 'cmsScript');
    }
    
     function savecms() {

        //validate form input
        $this->form_validation->set_rules('cms_title', 'CMS Title', 'required|is_unique[cms.cms_title]');
        $this->form_validation->set_rules('cms_description', 'CMS Description', 'required|trim');


        if ($this->form_validation->run() == true) {

                    $title = $this->input->post('cms_title');
                    $code = str_replace(' ', '_', trim($title));
                    
                    
                    $optionsArray = array(
                        'cms_title' => $this->input->post('cms_title'),
                        'cms_description' => $this->input->post('cms_description'),
                        'cms_code' => $code,
                        'createdAt' => date('Y-m-d H:i:s')

                    );
                    $options = array
                        (
                        'data' => $optionsArray,
                        'table' => 'cms'
                    );
                    $insert = $this->cms_model->customInsert($options);
                    if($insert){
                        print_r($insert);
                        echo "insert"; exit;
                        //$responce = array('status' => 1, 'msg' => $this->lang->line("success"), 'lId' => $insert);
                    }else{
                        echo "not insert"; exit;
//                        $error = array("TopErrorAdd" => $this->lang->line("saveErrorMsg"));
//                        $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                    }

        } else {
            echo "insert error"; exit;
//            $error = ajax_validation_errors();
//            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
        }

       // echo json_encode($responce);
    }

      /**
     * @project Qyura
     * @method cmsView
     * @description  cms view form
     * @access public
     */
    function cmsView($cms_id='') {
     
        $where = array('deleted' => 0, 'cms_id' => $cms_id);
        $tbl = 'cms';
        $option = array(
            'select' => '*',
            'where' => $where,
            'table' => $tbl,
            'single' => true
        );

        $data['result'] = $this->cms_model->customGet($option);

       $this->load->super_admin_template('viewcms', $data, 'cmsScript');

    }

   
     /**
     * @project Qyura
     * @method editView
     * @description edit cms view form
     * @access public
     */
    function editView($cms_id='') {
        
        $where = array('deleted' => 0, 'cms_id' => $cms_id);
        $tbl = 'cms';
        $option = array(
            'select' => '*',
            'where' => $where,
            'table' => $tbl,
            'single' => true
        );

        $data['resultRows'] = $this->cms_model->customGet($option);

       $this->load->super_admin_template('editcms', $data, 'cmsScript');
    }

     /**
     * @project Qyura
     * @method updatecms
     * @description add cms view form
     * @access public
     */
    function updatecms() {

        //validate form input
      $this->form_validation->set_rules('cms_title', 'CMS Title', 'required');
        $this->form_validation->set_rules('cms_description', 'CMS Description', 'required');
        if ($this->form_validation->run() == true) {
            $whereId = $this->input->post('cms_id');
           
             $where = array('cms_id' => $whereId);
                  $title = $this->input->post('cms_title');
                  $code = str_replace(' ', '_', trim($title));
                  $additional_data = array(
                        'cms_title' => $this->input->post('cms_title'),
                        'cms_description' => $this->input->post('cms_description'),
             );
              
                $options = array
                    (
                    'data' => $additional_data,
                    'where' => $where,
                    'table' =>'cms'
                );
                $update = $this->cms_model->customUpdate($options);
                if ($update) {
                    print_r($update);
                    echo "update"; exit;
                   // $responce = array('status' => 1, 'isAlive' => TRUE, 'msg' => $this->lang->line("success"), 'lId' => $update);
                } else {
                    echo "not update"; exit;
                   // $error = array("TopErrorAdd" => $this->lang->line("saveErrorMsg"));
                   // $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
                }
        } else {
            echo "validation false"; exit;
//            $error = ajax_validation_errors();
//            $responce = array('status' => 0, 'isAlive' => TRUE, 'errors' => $error);
        }
      echo "error"; exit;
//        echo json_encode($responce);
    }
    
    function getcmsdetail(){
         echo $this->cms_model->fetchcmsDataTables();
    }

}
