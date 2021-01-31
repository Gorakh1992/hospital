<?php

/**
 * Description of Surgery_model
 *
 * @author Gorakh
 */
class Surgery_model extends CI_Model {
    
    function __construct() {
        parent::__Construct();
    }
    
    
    
    function insertUsersDetails($data){
        $this->db->insert("users", $data);
        return $this->db->insert_id();
    }
    
    
    
    function getUsersDetails($select, $where){
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get("users");
        return $query->result();
    }
    
    function updateUsersDetails($data, $where) {
        $this->db->where($where);
        $this->db->update("users", $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false; 
        }
    }
    
    function getDoctorLists($select, $where = array()){
        $this->db->select($select);
        if(!empty($where)){
          $this->db->where($where);  
        }
        $query = $this->db->get("doctor_details");
        
        return $query->result_array();
    }
    
    function insertPatientDetails($data){
        $this->db->insert("patient_details", $data);
        return $this->db->insert_id();
    }
    
    function insertPatientDetailInBulk($data){
        $this->db->insert_batch("patient_details", $data);
        return $this->db->insert_id();
    }
    
    
    function getPatientDetails($select, $where = array(), $surgery_flag = false){
        $this->db->select($select);
        if(!empty($where)){
          $this->db->where($where);  
        }
        
        if ($surgery_flag) {
            $this->db->join("surgery_patient_details", "patient_details.id=surgery_patient_details.patient_id");
        }

        $query = $this->db->get("patient_details");
        
        return $query->result_array();
    }
    
    function insertSurgeryPatientDetails($data){
        $this->db->insert("surgery_patient_details", $data);
        return $this->db->insert_id();
    }
    
    
    
    
    
    function getPatientList($post, $select = "", $is_array = false) {
        $this->_get_patient_list($post, $select);
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
    
    
    function _get_patient_list($post, $select) {
        error_reporting(0);
        
        if (empty($select)) {
            $select = '*';
        }

        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from('patient_details');
        $this->db->join('doctor_details', 'doctor_details.id = patient_details.doctor_id');

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
           $this->db->order_by('patient_details.id', 'DESC');
        }

        if (!empty($post['group_by'])) {
            $this->db->group_by($post['group_by']);
        }
    }
    
    
    
    public function count_all_patient_list($post) {
        $this->_get_patient_list($post, 'count(distinct(patient_details.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
        
    
    function count_patient_list($post){
        $this->_get_patient_list($post, 'count(distinct(patient_details.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
    
    
    function getSurgeryPatientList($post, $select = "", $is_array = false){
        $this->_get_surgery_patient_list($post, $select);
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
    
    
    function _get_surgery_patient_list($post, $select) {
        error_reporting(0);
        
        if (empty($select)) {
            $select = '*';
        }

        $this->db->distinct();
        $this->db->select($select, FALSE);
        $this->db->from('surgery_patient_details');
        $this->db->join('doctor_details', 'doctor_details.id = surgery_patient_details.doctor_id');
        $this->db->join('surgery_type', 'surgery_type.id = surgery_patient_details.surgery_type_id');
        $this->db->join('patient_details', 'patient_details.id = surgery_patient_details.patient_id');

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
           $this->db->order_by('patient_details.id', 'DESC');
        }

        if (!empty($post['group_by'])) {
            $this->db->group_by($post['group_by']);
        }
    }
    
    
    
    public function count_all_surgery_patient_list($post) {
        $this->_get_surgery_patient_list($post, 'count(distinct(surgery_patient_details.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
        
    
    function count_surgery_patient_list($post){
        $this->_get_surgery_patient_list($post, 'count(distinct(surgery_patient_details.id)) as numrows');
        $query = $this->db->get();
        return $query->result_array()[0]['numrows'];
    }
    
    
    function updatePatientDetails($data, $where) {
        $this->db->where($where);
        $this->db->update("patient_details", $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false; 
        }
    }

    function getSurgeryTypeList($select, $where){
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get("surgery_type");
        return $query->result_array();
    }
    
    function getAdvanceTakenPersonList($select, $where, $group_by){
        $this->db->select($select);
        $this->db->where($where);
        $this->db->group_by($group_by);
        $query = $this->db->get("surgery_patient_details");
        return $query->result_array();
    }
    
    function get_hopital_surgery_details($select, $where) {
        $this->db->select($select, FALSE);
        $this->db->from('surgery_patient_details');
        $this->db->join('surgery_type', 'surgery_type.id = surgery_patient_details.surgery_type_id');
        $this->db->join('doctor_details', 'doctor_details.id = surgery_patient_details.doctor_id');
        $this->db->join('patient_details', 'patient_details.id = surgery_patient_details.patient_id');
        $this->db->join('surgery_patient_document', 'surgery_patient_document.surgery_patient_id = surgery_patient_details.id');
        
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function getSurgeryDocuments($select, $where) {
        $this->db->select($select);
        $this->db->where($where);
        $query = $this->db->get("surgery_patient_document");
        return $query->result_array();
    }
    
    
    function insertPatientSurgeryfileInBulk($data){
        $this->db->insert_batch("surgery_patient_document", $data);
        return $this->db->insert_id();
    }
    
    function  deletePatientSurgeryFile($where){
        $this->db->where($where);
        $this->db->delete("surgery_patient_document");
    }
            
    function updatePatientSurgeryDetails($data, $where) {
        $this->db->where($where);
        $this->db->update("surgery_patient_details", $data);
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    
   
                  
    function updateGalleryImage($where, $data){
        $this->db->where($where);
        $this->db->update("gallery", $data);
    }
    
    function getSliderImage($where){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by('priority', "desc");
        $query = $this->db->get('slider_image');
        return $query->result_array();
    }
    
   

}
