<?php

/**
 * Description of Escorts_model
 *
 * @author Gorakh
 */
class Agency_Model extends CI_Model {
    
    function __construct() {
        parent::__Construct();
    }
       
    function insertEscortsAgencyProfileDetails($data){
        $this->db->insert("escorts_agency_details", $data);
        return $this->db->insert_id();
    }
    
    function updateAgencyProfile($data, $where) {
        $this->db->where($where);
        $this->db->update("escorts_agency_details", $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false; 
        }
    }
    
    function getAgencyDetails($select, $where){
        $this->db->distinct();
        $this->db->select($select);
        if(!empty($where)){
          $this->db->where($where);  
        }
        $this->db->join('escorts_agency_details', 'escorts_agency_details.user_id = users.id','left');
        $this->db->join('country_wise_currency', 'country_wise_currency.country_id = escorts_agency_details.country_id');
        $this->db->join('agency_escorts_profile', 'users.id = agency_escorts_profile.agency_id','left');
        $query = $this->db->get("users");
        return $query->result_array();
    }
    
   function insertAgencyEscortsServiveArea($data){
       $this->db->insert_batch("agency_service_area", $data);
        return $this->db->insert_id();
        
    }
    
    function InsertEscortProfile($data){
        $this->db->insert("agency_escorts_profile", $data);
        return $this->db->insert_id();
    }
    
    function getAgencyEscortsDetails($select, $where, $limit, $start) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->order_by("agency_escorts_profile.id", "desc");
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get("agency_escorts_profile");
        return $query->result();
    }
    
    
     function getEscortImageList($select, $where = array()) {
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_image_list");
        return $query->result_array();
    }
    
    function updateAgecyEscortProfile($data, $where) {
        $this->db->where($where);
        $this->db->update("agency_escorts_profile", $data);
        
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false; 
        }
    }
    
    function getAgencyEscortLanguageList($select, $where){
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_languages_mapping");
        return $query->result_array();
    }
    
    function getEscortRateDetails($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_rate");
        return $query->result_array();
    }
    
   function insertAgencyEscortsServiceableArea($data){
       $this->db->insert_batch("agency_escorts_service_area", $data);
        return $this->db->insert_id();
        
   }
   
   
    function getEscortServiceableArea($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("agency_escorts_service_area");
        return $query->result_array();
    }
    
    
    function getEscortSpecialisation($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_specialisation");
        return $query->result_array();
    }
    
    function getEscortFeaturedService($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_featured_services_details");
        return $query->result_array();
    }
    
    function getAgencyEscortsList($select, $where, $limit = null, $start = null) {

        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join('escorts_type', ' agency_escorts_profile.escort_type_id = escorts_type.id ', 'left');
        $this->db->join('country', 'agency_escorts_profile.country_id = country.id', 'left');
        $this->db->join('cities', 'agency_escorts_profile.city_id = cities.id', 'left');
        $this->db->join('pincode_list', 'agency_escorts_profile.pincode_id = pincode_list.id', 'left');
        $this->db->join('escorts_image_list', 'agency_escorts_profile.id = escorts_image_list.escort_id', 'left');
        $this->db->order_by("agency_escorts_profile.id", "asc");
        if (!empty($limit)) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get("agency_escorts_profile");
        return $query->result_array();
    }

    function getEscortPincodeList($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("pincode_list");
        return $query->result_array();
    }
    
    
    
    function genericDelete($delete, $where) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->delete($delete);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    
    function agencyServiceAreaDetails($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("agency_service_area");
        return $query->result_array();
    }
    
    function getAgencyEscortsCount($select, $where, $join = false ){
        
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join('escorts_type', 'agency_escorts_profile.escort_type_id = escorts_type.id ', 'left');
        $this->db->join('country', 'agency_escorts_profile.country_id = country.id', 'left');
        $this->db->join('cities', 'country.id = cities.country_id', 'left');
        $this->db->join('pincode_list', 'agency_escorts_profile.pincode_id = pincode_list.id', 'left');
        $this->db->join('escorts_image_list', 'agency_escorts_profile.agency_id = escorts_image_list.escort_id', 'left');
        
        if (!empty($join)) {
            $this->db->join('escorts_rate', 'agency_escorts_profile.id = escorts_rate.escort_id', 'left');
        }

        $query = $this->db->get("agency_escorts_profile");
        return $query->result_array();
    }
    
     function getAgencyEscortServiceableArea($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join('cities', 'cities.id = agency_escorts_service_area.city_id', "left");
        $query = $this->db->get("agency_escorts_service_area");
        return $query->result_array();
    }
    
    
    
    function getEscortSpecialisationList($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $this->db->join('escort_services', 'escort_services.id = escorts_specialisation.escort_services_id', "left");
        $query = $this->db->get("escorts_specialisation");
        return $query->result_array();
    }
    
    
        
    function getEscortsAgency($select, $where) {
        $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("escorts_agency_details");
        return $query->result_array();
    }
    
    function get_agency_escorts_profile($select, $where){
       $this->db->distinct();
        $this->db->select($select);
        if (!empty($where)) {
            $this->db->where($where);
        }
        $query = $this->db->get("agency_escorts_profile"); 
        return $query->result_array();
    }
    
    function get_agency_list($post, $select = "", $is_array = false) {
        $this->_get_agency_list($post, $select);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }

        $query = $this->db->get();
        
       if($is_array){
            return $query->result_array();
        }else{
            return $query->result();
        }
    }
    
    
    function _get_agency_list($post, $select) {

        if (empty($select)) {
            $select = '*';
        }

        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from('users');
        $this->db->join('escorts_agency_details', 'escorts_agency_details.user_id = users.id','left');
        $this->db->join('country', 'escorts_agency_details.country_id = country.id', 'left');
        $this->db->join('cities', 'escorts_agency_details.city_id = cities.id', 'left');

        if (!empty($post['where'])) {
            $this->db->where($post['where']);
        }

        if (!empty($post['search_value'])) {
            $like = "";
            foreach ($post['column_search'] as $key => $item) {

                if ($key === 0) {
                    $like .= "( " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                } else {
                    $like .= " OR " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                }
            }
            $like .= ") ";

            $this->db->where($like, null, false);
        }

        if (!empty($post['order'])) {
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
        } else {
           $this->db->order_by('users.id', 'ASC');
        }

        if (!empty($post['group_by'])) {
            $this->db->group_by($post['group_by']);
        }
    }
    
    public function count_all_agency_list($post) {
        $this->_get_agency_list($post, 'count(distinct(users.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
        
    
    function count_agency_list($post){
        $this->_get_agency_list($post, 'count(distinct(users.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
    
    
    function get_escort_list($post, $select = "", $is_array = false) {
        $this->_get_escort_list($post, $select);
        if ($post['length'] != -1) {
            $this->db->limit($post['length'], $post['start']);
        }

        $query = $this->db->get();
        
       if($is_array){
            return $query->result_array();
        }else{
            return $query->result();
        }
    }
    
    function _get_escort_list($post, $select) {

        if (empty($select)) {
            $select = '*';
        }

        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from('agency_escorts_profile');
        $this->db->join('escorts_type', ' agency_escorts_profile.escort_type_id = escorts_type.id ', 'left');
        $this->db->join('country', 'agency_escorts_profile.country_id = country.id', 'left');
        $this->db->join('cities', 'agency_escorts_profile.city_id = cities.id', 'left');
        $this->db->join('escorts_image_list', 'agency_escorts_profile.id = escorts_image_list.escort_id', 'left');
        
        if (!empty($post['where'])) {
            $this->db->where($post['where']);
        }

        if (!empty($post['search_value'])) {
            $like = "";
            foreach ($post['column_search'] as $key => $item) {

                if ($key === 0) {
                    $like .= "( " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                } else {
                    $like .= " OR " . $item . " LIKE '%" . $post['search_value'] . "%' ";
                }
            }
            $like .= ") ";

            $this->db->where($like, null, false);
        }

        if (!empty($post['order'])) {
            $this->db->order_by($post['column_order'][$post['order'][0]['column']], $post['order'][0]['dir']);
        } else {
           $this->db->order_by('agency_escorts_profile.id', 'ASC');
        }

        if (!empty($post['group_by'])) {
            $this->db->group_by($post['group_by']);
        }
    }
    
    
    public function count_all_escort_list($post) {
        $this->_get_escort_list($post, 'count(distinct(agency_escorts_profile.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
        
    
    function count_escort_list($post){
        $this->_get_escort_list($post, 'count(distinct(agency_escorts_profile.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }

}
