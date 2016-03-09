<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Favouriteby extends MY_Controller {

     public function __construct() {
       parent:: __construct();
       $this->load->library('form_validation');
       $this->load->model('Favouriteby_model');
      // $this->load->library('datatables');
       $this->load->helper('common_helper');
       $this->load->library('Ajax_pagination');
       $this->perPage = 1;
   }
   function index(){

         $data = array();
        
        //total rows count
        $totalRec = count($this->Favouriteby_model->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'favouriteby/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['favData'] = $this->Favouriteby_model->getRows(array('limit'=>$this->perPage));
       //  print_r($data); exit;
         $data['title'] = 'Favourite By';
        // echo $this->uri->segment(3); exit;
       //  $this->load->library('pagination');
        // $data['data'] = $this->Favouriteby_model->fetchFavByDataTables();
         $this->load->super_admin_template('favouritebyList', $data, 'scriptFavouriteby');
   }
   
   function ajaxPaginationData()
    {
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //total rows count
        $totalRec = count($this->post->getRows());
        
        //pagination configuration
        $config['first_link']  = 'First';
        $config['div']         = 'postList'; //parent div tag id
        $config['base_url']    = base_url().'favouriteby/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->Favouriteby_model->getRows(array('start'=>$offset,'limit'=>$this->perPage));
        
        //load the view
        $this->load->super_admin_template('favouritebyList', $data, 'scriptFavouriteby');
    }

}  