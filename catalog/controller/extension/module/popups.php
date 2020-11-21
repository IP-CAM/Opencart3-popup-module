<?php

class ControllerExtensionModulePopups extends \src\Extension\OpencartExtensions\Controller {

    private $error = array();
    private $prefix;

    public function __construct($registry) {
        parent::__construct($registry);
        $this->prefix = (version_compare(VERSION, '3.0', '>=')) ? 'module_' : '';
        $this->load->model('extension/module/popups');
        $this->load->language('extension/module/popups');
    }

    public function index() {
        $city_id = $this->getCorrectCityId();
        $message = $this->model_extension_module_popups->getActive($city_id);
        echo json_encode($message);
    }
}
