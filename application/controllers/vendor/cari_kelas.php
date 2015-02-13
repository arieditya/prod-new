<?php
/**
 * Created by PhpStorm.
 * User: saqib
 * Date: 2/12/15
 * Time: 10:34 PM
 * @property Kelas_model $kelas_model;
 * @property Vendor_class_model $vendor_class_model;
 * @property Vendor_model $vendor_model;
 *
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cari_kelas extends MY_Controller {
    private $id;

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('pdf_helper');
        $this->load->model('murid_model');
        $this->load->model('kelas_model');
        $this->load->model('vendor_class_model');
        $this->load->model('vendor_model');
    }

    public function index() {
        $set_filter = array();
        $filter = $this->input->cookie('filter', TRUE);
        if(!empty($filter)) {
            $filter = json_decode($filter, TRUE);
            $set_filter = array();
            if(!empty($filter['type'])) {
                switch($filter['type']) {
                    case		'oneshot':
                        $set_filter['oneshot'] = TRUE;
                    case		'upcoming':
                        $set_filter['upcoming'] = TRUE;
                        break;
                    case		'ongoing':
                        $set_filter['ongoing'] = TRUE;
                        break;
                    case		'past':
                        $set_filter['past'] = TRUE;
                        break;
                }
            }
            if(!empty($filter['level'])) {
                $set_filter['level'] = $filter['level'];
            }
            if(!empty($filter['category'])) {
                $set_filter['category'] = $filter['category'];
            }
            if(!empty($filter['price_range'])) {
                $set_filter['price'] = $filter['price_range'];
            }
        }

        $this->data['filter'] = $set_filter;
        $new_filter = $this->vendor_class_model->get_filtered_class($set_filter);
        $category = $this->input->get('category', TRUE);
        $level = $this->input->get('level', TRUE);
        $min = $this->input->get('minrange', TRUE);
        $max = $this->input->get('maxrange', TRUE);

        $cat = array();
        $lvl = array();
        $categories = $this->vendor_class_model->get_category()->result();
        foreach($categories as $cats) {
            $cat[$cats->id] = $cats;
        }
        $levels = $this->vendor_class_model->get_level()->result();
        $province = $this->murid_model->get_provinsi()->result();
        foreach($levels as $lvls){
            $lvl[$lvls->id] = $lvls;
        }
        $this->data['category'] = $cat;
        $this->data['level'] = $lvl;
        $this->data['province'] = $province;

        $where = array();
        if(!empty($category)) $where['category_id'] = $category;
        if(!empty($level)) $where['level_id'] = $level;
        if(!empty($min)) $where['price_per_session >= '] = $min;
        if(!empty($max)) $where['price_per_session <= '] = $max;

        $where2 = array();
        if(!empty($category)) $where2['category'] = $category;
        if(!empty($level)) $where2['level'] = $level;
        if(!empty($oneshot)) $where2['oneshot'] = !empty($oneshot);
        if(!empty($min) || !empty($max))
            $where2['price'] = array('lo' => empty($min)?0:$min, 'hi' => empty($max)?0:$max);
        if(!empty($event)) {
            if(in_array($event, array('ongoing','upcoming','past')))
                $where[$event] = TRUE;
        }

        $where_class = '';
        if(count($new_filter) > 0){
            $where_class['id'] = array_merge($new_filter);
            $classes = $this->vendor_class_model->get_class($where_class)->result();
        } else {
            $classes = array();
        }
        foreach($classes as $cla){
            $data['vendor']['profile'][]= $this->vendor_model->get_profile(array('id'=>$cla->vendor_id))->result();
            $data['vendor']['info'][]= $this->vendor_model->get_info(array('vendor_id'=>$cla->vendor_id))->result();
        }
        $this->load->helper('text');
        $this->data['class'] = $classes;
        $this->data['vendor'] = $data['vendor'];
        $this->load->view('kelas/cari_kelas', $this->data);
    }
}