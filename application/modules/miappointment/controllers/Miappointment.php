<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Miappointment extends MY_Controller {

    public $error_message = '';

    public function __construct() {
        parent:: __construct();
        $this->load->model('miappointment_model','miappointment');
    }

    /**
     * @project Qyura
     * @method index
     * @description listing templeat
     * @access public
     * @return html
     */
    
    public function index() {
        $data = array();
        $this->load->super_admin_template('miAppList', $data, 'miAppScript');
    }

    /**
     * @project Qyura
     * @method getDignostiData
     * @description miAppList listing
     * @access public
     * @return json data for datatable
     */
    
    public function getDignostiData() {
        echo $this->miappointment->getDiagnostic();
    }
    /**
     * @project Qyura
     * @method getBloodBankDl
     * @description get records in listing using datatables
     * @access public
     * @return array
     */
    function getBloodBankDl() {
        echo $this->miappointment->fetchbloodBankDataTables();
    }

    /**
     * @project Qyura
     * @method detail
     * @description detail mi appointment
     * @access public
     * @param qtnId
     * @return html
     */
    public function detail($qtnId = '') {
        $data = array();
        $data['qtnDetail'] = $this->miappointment->getDetail($qtnId);
        //dump($data['qtnDetail']);
        $data['quotationTests'] =$this->miappointment->getQuotationTests($qtnId);
        //dump($data['quotationTests']);
        $data['userDetail'] = $this->miappointment->getQuotationUserDetail($qtnId);
        
        $data['qtnAmount'] = $this->miappointment->qtTestTotalAmount($qtnId);
        
        //dump($data['userDetail']);
        $data['qtnId'] = $qtnId;
        $this->load->super_admin_template('miAppDetail', $data, 'miAppScript');
    }

}
