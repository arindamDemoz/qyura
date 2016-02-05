<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'modules/api/controllers/MyRest.php';

class MedicartApi extends MyRest {

    function __construct() {
        // Construct our parent class
        parent::__construct();
        $this->load->model(array('medicart_model'));
    }

    function list_post() {


        $this->form_validation->set_rules('lat', 'Lat', 'required|decimal');
        $this->form_validation->set_rules('long', 'Long', 'required|decimal');
        $this->form_validation->set_rules('q', 'q', 'trim|xss_clean');
        $this->form_validation->set_rules('notin', 'notin', 'trim|xss_clean');


        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {


            $option['lat'] = isset($_POST['lat']) ? $this->input->post('lat') : '';
            $option['long'] = isset($_POST['long']) ? $this->input->post('long') : '';

            $option['search'] = isset($_POST['q']) ? $this->input->post('q') : '';

            $notIn = isset($_POST['notin']) ? $this->input->post('notin') : '';

            $option['notIn'] = explode(',', $notIn);
            
            $aoClumns = array("medicartOffer_id", "MIId", "offerCategory", "title", "image", "description","startDate", "endDate", "actualPrice", "discountPrice",   "medicartOffer_deleted", "modifyTime","by", "lat", "long");

            $medList = $this->medicart_model->getMedlists($option);
            
            
            if ($medList) {

                $finalResult = array();
                if (!empty($medList)) {
                    foreach ($medList as $row) {

                        $finalTemp = array();
                        $finalTemp[] = isset($row->medicartOffer_id) ? $row->medicartOffer_id : "";
                        $finalTemp[] = isset($row->medicartOffer_MIId) ? $row->medicartOffer_MIId : "";
                        $finalTemp[] = isset($row->medicartOffer_offerCategory) ? $row->medicartOffer_offerCategory : "";
                        $finalTemp[] = isset($row->medicartOffer_title) ? $row->medicartOffer_title : "";
                        $finalTemp[] = isset($row->medicartOffer_image) ? $row->medicartOffer_image : "";
                        $finalTemp[] = isset($row->medicartOffer_description) ? $row->medicartOffer_description : "";
                        //$finalTemp[] = isset($row->medicartOffer_maximumBooking) ? $row->medicartOffer_maximumBooking : "";
                        $finalTemp[] = isset($row->medicartOffer_startDate) ? $row->medicartOffer_startDate : "";
                        $finalTemp[] = isset($row->medicartOffer_endDate) ? $row->medicartOffer_endDate : "";
                        //$finalTemp[] = isset($row->medicartOffer_discount) ? $row->medicartOffer_discount : "";
                        //$finalTemp[] = isset($row->medicartOffer_ageDiscount) ? $row->medicartOffer_ageDiscount : "";
                        $finalTemp[] = isset($row->medicartOffer_actualPrice) ? $row->medicartOffer_actualPrice : "";
                        $finalTemp[] = isset($row->medicartOffer_discountPrice) ? $row->medicartOffer_discountPrice : "";
                        $finalTemp[] = isset($row->medicartOffer_deleted) ? $row->medicartOffer_deleted : "";
                        //$finalTemp[] = isset($row->medicartOffer_discount) ? $row->medicartOffer_discount : "";
                        $finalTemp[] = isset($row->modifyTime) ? $row->modifyTime : "";
                       // dump((isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != ''));
                        
                        $by = "";
                        $lat = "";
                        $long = "";
                        
                        $diagnostic_name = (isset($row->diagnostic_name) && $row->diagnostic_name != null && $row->diagnostic_name != '') ? $row->diagnostic_name : "" ;
                        $hospital_name = (isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != '') ? $row->hospital_name : "";
                        
                        $hospital_lat = (isset($row->hospital_lat) && $row->hospital_lat != null && $row->hospital_lat != '') ? $row->hospital_lat : "";
                        $diagnostic_lat = (isset($row->diagnostic_lat) && $row->diagnostic_lat != null && $row->diagnostic_lat != '') ? $row->diagnostic_lat : "";
                        
                        $hospital_long = (isset($row->hospital_long) && $row->hospital_long != null && $row->hospital_long != '') ? $row->hospital_long : "";
                        $diagnostic_long = (isset($row->diagnostic_long) && $row->diagnostic_long != null && $row->diagnostic_long != '') ? $row->diagnostic_long : '';
                        
                        if($hospital_name != "") $by= $hospital_name; elseif($diagnostic_name != ""){$by = $diagnostic_name;}
                        if($hospital_lat != "") $lat= $hospital_lat; elseif($diagnostic_lat != ""){$lat = $diagnostic_lat;}
                        if($hospital_long != "") $long= $hospital_long; elseif($diagnostic_long != ""){$long = $diagnostic_long;}
                        
                        $finalTemp[] = $by;
                        $finalTemp[] = $lat;
                        $finalTemp[] = $long;
                        //$finalTemp[] = (isset($row->hospital_lat) && $row->hospital_lat != null && $row->hospital_lat != '') ? $row->hospital_lat : (isset($row->diagnostic_lat) && $row->diagnostic_lat != null && $row->diagnostic_lat != '') ? $row->diagnostic_lat : '' ;
                        //$finalTemp[] = (isset($row->hospital_long) && $row->hospital_long != null && $row->hospital_long != '') ? $row->hospital_long : (isset($row->diagnostic_long) && $row->diagnostic_long != null && $row->diagnostic_long != '') ? $row->diagnostic_long : ''  ;
                        $finalResult[] = $finalTemp;
                    }
                }
            }

            // $finalResult = $this->jsonify($finalResult);


            if (!empty($finalResult)) {
                $response1['msg'] = 'medicart offer found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No medicart offer is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }
    
    function MedicartDitail_post() {


        $this->form_validation->set_rules('medicartOffer_id', 'MedicartOffer id', 'required|integer');
        


        if ($this->form_validation->run() == FALSE) {
            // setup the input
            $message = $this->validation_post_warning();
            $response = array('status' => FALSE, 'msg' => $message);
            $this->response($response, 400);
        } else {

            $medicartOffer_id = isset($_POST['medicartOffer_Id']) ? $this->input->post('medicartOffer_id') : '';
            
            $aoClumns = array("medicartOffer_id", "MIId", "offerCategory", "title", "image", "startDate", "endDate", "description", "actualPrice", "discountPrice", "medicartOffer_deleted", "modifyTime","by");

            $row = $this->medicart_model->getMedDetail($medicartOffer_id);
            
            
            if ($row) {

                $finalResult = array();
                if (!empty($row)) {
                    

                        $finalTemp = array();
                        $finalTemp[] = isset($row->medicartOffer_id) ? $row->medicartOffer_id : "";
                        $finalTemp[] = isset($row->medicartOffer_MIId) ? $row->medicartOffer_MIId : "";
                        $finalTemp[] = isset($row->medicartOffer_offerCategory) ? $row->medicartOffer_offerCategory : "";
                        $finalTemp[] = isset($row->medicartOffer_title) ? $row->medicartOffer_title : "";
                        $finalTemp[] = isset($row->medicartOffer_image) ? $row->medicartOffer_image : "";
                        $finalTemp[] = isset($row->medicartOffer_description) ? $row->medicartOffer_allowBooking : "";
                        //$finalTemp[] = isset($row->medicartOffer_maximumBooking) ? $row->medicartOffer_maximumBooking : "";
                        $finalTemp[] = isset($row->medicartOffer_startDate) ? $row->medicartOffer_startDate : "";
                        $finalTemp[] = isset($row->medicartOffer_endDate) ? $row->medicartOffer_endDate : "";
                        //$finalTemp[] = isset($row->medicartOffer_discount) ? $row->medicartOffer_discount : "";
                        //$finalTemp[] = isset($row->medicartOffer_ageDiscount) ? $row->medicartOffer_ageDiscount : "";
                        $finalTemp[] = isset($row->medicartOffer_actualPrice) ? $row->medicartOffer_actualPrice : "";
                        $finalTemp[] = isset($row->medicartOffer_discountPrice) ? $row->medicartOffer_discountPrice : "";
                        $finalTemp[] = isset($row->medicartOffer_deleted) ? $row->medicartOffer_deleted : "";
                        //$finalTemp[] = isset($row->medicartOffer_discount) ? $row->medicartOffer_discount : "";
                        $finalTemp[] = isset($row->modifyTime) ? $row->modifyTime : "";
                       // dump((isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != ''));
                        
                        $by = "";
                        $lat = "";
                        $long = "";
                        
                        $diagnostic_name = (isset($row->diagnostic_name) && $row->diagnostic_name != null && $row->diagnostic_name != '') ? $row->diagnostic_name : "" ;
                        $hospital_name = (isset($row->hospital_name) && $row->hospital_name != null && $row->hospital_name != '') ? $row->hospital_name : "";
                        
                        //$hospital_lat = (isset($row->hospital_lat) && $row->hospital_lat != null && $row->hospital_lat != '') ? $row->hospital_lat : "";
                       // $diagnostic_lat = (isset($row->diagnostic_lat) && $row->diagnostic_lat != null && $row->diagnostic_lat != '') ? $row->diagnostic_lat : "";
                        
                        //$hospital_long = (isset($row->hospital_long) && $row->hospital_long != null && $row->hospital_long != '') ? $row->hospital_long : "";
                        //$diagnostic_long = (isset($row->diagnostic_long) && $row->diagnostic_long != null && $row->diagnostic_long != '') ? $row->diagnostic_long : '';
                        
                        if($hospital_name != "") $by= $hospital_name; elseif($diagnostic_name != ""){$by = $diagnostic_name;}
                        //if($hospital_lat != "") $lat= $hospital_lat; elseif($diagnostic_lat != ""){$lat = $diagnostic_lat;}
                        //if($hospital_long != "") $long= $hospital_long; elseif($diagnostic_long != ""){$long = $diagnostic_long;}
                        
                        $finalTemp[] = $by;
                        //$finalTemp[] = $lat;
                        //$finalTemp[] = $long;
                        //$finalTemp[] = (isset($row->hospital_lat) && $row->hospital_lat != null && $row->hospital_lat != '') ? $row->hospital_lat : (isset($row->diagnostic_lat) && $row->diagnostic_lat != null && $row->diagnostic_lat != '') ? $row->diagnostic_lat : '' ;
                        //$finalTemp[] = (isset($row->hospital_long) && $row->hospital_long != null && $row->hospital_long != '') ? $row->hospital_long : (isset($row->diagnostic_long) && $row->diagnostic_long != null && $row->diagnostic_long != '') ? $row->diagnostic_long : ''  ;
                        $finalResult[] = $finalTemp;
                    
                }
            }

            // $finalResult = $this->jsonify($finalResult);


            if (!empty($finalResult)) {
                $response1['msg'] = 'medicart offer found';
                $response1['status'] = TRUE;
                $response1['data'] = $finalResult;
                $response1['colName'] = $aoClumns;
                $this->response($response1, 200); // 200 being the HTTP response code
            } else {
                $response1['msg'] = 'No medicart offer is available at this range!';
                $response1['status'] = FALSE;
                $this->response($response1, 404);
            }
        }
    }

}
