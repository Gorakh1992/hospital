<?php

/**
 * Description of Admin Panel Controller
 *
 * @author Gorakh
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_panel extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model("surgery_model");
        //$this->load->model("agency_model");
        $this->load->library('session');
        $this->load->library('excel');
        $this->load->helper('cookie');
        $this->load->helper('url');
    }
    
    public function index(){
        $this->load->view("admin-panel/login");
    }
    
    
    
    function sign_in() {
        log_message('info', __METHOD__ . " " . json_encode($_POST, true));

        $email = $this->input->post("email");
        $clear_password = $this->input->post("clear_password");
        $has_key_password = md5($this->input->post("clear_password"));
        if ($email) {
            $select = "users.id, users.name, users.email, users.mobile_no, users.user_type, users.active";
            $where = array(
                'users.email' => $email,
                'users.clear_password' => $clear_password,
                'users.has_key_password' => $has_key_password
            );
            $users_details = $this->surgery_model->getUsersDetails($select, $where);
        
            $session = array();
            if (!empty($users_details)) {
                $string_arr = explode(" ", trim($users_details[0]->name));
                $short_name = '';
                if (!empty($string_arr)) {
                    $first = substr($string_arr[0], 0, 1);
                    if (count($string_arr) > 1) {
                        $last = substr($string_arr[1], 0, 1);
                        $short_name = $first . " " . $last;
                    } else {
                        $short_name = $first . " " . substr($string_arr[0], (strlen($string_arr[0]) - 1), 1);
                    }
                }

                $session['id'] = $users_details[0]->id;
                $session['name'] = $users_details[0]->name;
                $session['short_name'] = $short_name;
                $session['email'] = $users_details[0]->email;
                $session['user_type'] = $users_details[0]->user_type;
                $session['mobile_no'] = $users_details[0]->mobile_no;

                $this->setSession($session);

                echo json_encode(array('message' => 'Login succss'));
                
            } else {
                echo json_encode(array("message" => 'Your email or password invalid.'));
            }
        } else {
            echo json_encode(array("message" => 'Your email should not be blank.'));
        }
    }

    public function dashboard(){
      $data = array();
       $this->checkLoginAdminSession();
       if($this->session->userdata['userType'] == 3){
           $post['order'] ='';
           $post['length'] = 4;
           $post['start'] = 0;
           $data['recent_patient_list'] = $this->surgery_model->getPatientList($post, "*", $is_array = TRUE);
       }
//       echo '<pre/>';
//       print_r($data);
//       die();
       $this->load->view('admin-panel/admin_header');
       $this->load->view('admin-panel/admin_sidebar');
       $this->load->view("admin-panel/admin_dashboard",$data); 
       $this->load->view('admin-panel/admin_footer');
    }
    
    
    
    
    
    
    public function agency_list(){
       $data = array();
       $data['country_list'] = $this->surgery_model->getCountiesList("country.id, country.country_name", array("country.status" => 1));
       $this->checkLoginAdminSession();
       $this->load->view('admin-panel/admin_header');
       $this->load->view('admin-panel/admin_sidebar');
       $this->load->view("admin-panel/agency_list",$data); 
       $this->load->view('admin-panel/admin_footer');
    }
    
   
  
    
    
   
    
    function get_escorts_list(){
        $data = $this->get_escorts_list_data();
        
        $post = $data['post'];
        if (!empty($data['data'])) {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->agency_model->count_all_escort_list($post),
                "recordsFiltered" => $this->agency_model->count_escort_list($post),
                "data" => $data['data'],
            );
        } else {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data['data'],
            );
        }
        echo json_encode($output);
    }
    
    function get_escorts_list_data() {
        $post = $this->get_post_data();
        $search_flag = trim($this->input->post('search_flag'));
        $city_id = trim($this->input->post('city_id'));
        $agency_id = trim($this->input->post('agency_id'));
        $data = array();
        if (!empty($search_flag)) {
            $post['column_order'] = array();
            $post['column_search'] = array('agency_escorts_profile.agency_id', 'agency_escorts_profile.name', 'agency_escorts_profile.mobile_number', 'agency_escorts_profile.is_active');
            $post['where'] = " escorts_image_list.active = 1 AND agency_escorts_profile.agency_id = " . $agency_id;

            if (!empty($city_id)) {
                $post['where'] .= " AND agency_escorts_profile.city_id = " . $city_id;
            }

            $select = " agency_escorts_profile.id, agency_escorts_profile.name, agency_escorts_profile.mobile_number, agency_escorts_profile.occupation, agency_escorts_profile.is_active, country.country_name, cities.city_name, escorts_image_list.original_image, escorts_type.escort_type ";
            $list = $this->agency_model->get_escort_list($post, $select);

            $data = array();
            $no = $post['start'];
            foreach ($list as $escort_list) {
                $no++;
                $row = $this->get_escort_list_table($escort_list, $no);
                $data[] = $row;
            }
        }
        return array(
            'data' => $data,
            'post' => $post
        );
    }

    function get_escort_list_table($escort_list, $no) {
        $row = array();
        $row[] = $no;
        
        if (empty($escort_list->original_image)) {
            $logo = base_url() . "images/default-logo.png";
        } else {
            $logo = base_url() . "images/escorts-image/" . $escort_list->original_image;
        }

        $row[] = "<img src='".$logo."' style='width: 35px;height: 35px;'>";
        $row[] = $escort_list->id;
        $row[] = $escort_list->name;
        $row[] = $escort_list->mobile_number;
        $row[] = $escort_list->city_name;
        $row[] = $escort_list->occupation;
        $row[] = $escort_list->escort_type;
               
        $row[] = "<a href='#' class='edit_c'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></a>";
        if ($escort_list->is_active == 1) {
            $row[] = "<button type='button' class='btn btn-default' style='background-color: #d9534f; border-color: #fff; width: 90px; color: #fff;' id='manage_courier_status'>Deactivate</button>";
        } else {
            $row[] = "<button type='button' class='btn btn-danger' style='background-color: #01903a; border-color: #fff; width: 90px; color: #fff;' id='manage_courier_status'>Activate</button>";
        }

        return $row;
    }
    
    
            
    function sign_in_agency(){
        $agency_id = trim($this->input->post('agency_id'));
        if ($agency_id) {
            $select = "users.id, users.name, users.email, users.mobile_no, users.user_type, users.active";
            $where = array(
                'users.id' => $agency_id,
                'users.user_type' => 2
            );
            
            $users_details = $this->surgery_model->getUsersDetails($select, $where);
           
            $session = array();
            if (!empty($users_details)) {
                $string_arr = explode(" ", trim($users_details[0]->name));
                $short_name = '';
                if (!empty($string_arr)) {
                    $first = substr($string_arr[0], 0, 1);
                    if(count($string_arr) > 1){
                       $last = substr($string_arr[1], 0, 1); 
                       $short_name = $first . " " . $last;
                    }else {
                        $short_name = $first . " " . substr($string_arr[0], (strlen($string_arr[0]) - 1), 1);
                    }
                }

                $session['id'] = $users_details[0]->id;
                $session['name'] = $users_details[0]->name;
                $session['short_name'] = $short_name;
                $session['email'] = $users_details[0]->email;
                $session['user_type'] = $users_details[0]->user_type;
                $session['mobile_no'] = $users_details[0]->mobile_no;
                               
                $this->setSession($session);
                
                if(!empty($users_details)){
                  echo json_encode(array('message' => 'Login succss'));  
                } else {
                  echo json_encode(array('message' => 'Your email or password invalid.'));   
                }
                
            } else {
                echo json_encode(array("message" => 'Your email or password invalid.'));
            }
        } else {
            echo json_encode(array("message" => 'Your email should not be blank.'));
        } 
    }
    
    
    public function agency_dashboard(){
               
       $total_escorts = $this->agency_model->getAgencyEscortsDetails("agency_escorts_profile.id", array("agency_escorts_profile.agency_id" => $this->session->userdata("userID")), '', '');
       $active_escorts = $this->agency_model->getAgencyEscortsDetails("agency_escorts_profile.id", array("agency_escorts_profile.agency_id" => $this->session->userdata("userID"), "agency_escorts_profile.is_active"=> 1), '', '');
       $indeactive_escort = $this->agency_model->getAgencyEscortsDetails("agency_escorts_profile.id", array("agency_escorts_profile.agency_id" => $this->session->userdata("userID"), "agency_escorts_profile.is_active"=> 0), '', '');
       $city_details = $this->agency_model->agencyServiceAreaDetails('agency_service_area.id', array("agency_service_area.agency_id" => $this->session->userdata("userID")));
       $agency_escorts = array();
       $agency_escorts = $this->agency_model->get_agency_escorts_profile("agency_escorts_profile.id", array("agency_escorts_profile.is_active" => 1));      
       $escorts_profile = array();
       $escorts_profile = $this->surgery_model->getIndependentEscortsList("users.id as escort_id", array("individual_escorts_profile.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1));       
       $profile_details = $this->agency_model->getAgencyDetails("escorts_agency_details.owner_name", array("escorts_agency_details.status" => 1));          
       $data['total_escort'] = count($total_escorts);
       $data['total_city'] = count($city_details);
       $data['active_escort'] = count($active_escorts);
       $data['indeactive_escort'] = count($indeactive_escort);
       $this->checkLoginAgencySession();
       $this->load->view('admin-panel/admin_header');
       $this->load->view('admin-panel/agency_sidebar');
       $this->load->view("admin-panel/agency_dashboard",$data); 
       $this->load->view('admin-panel/admin_footer');
    }
    
    
    
    
   
    
    
    
    
    
    
    /* ////////////////////////////////////////////////////////////// 
     *                                                             *
     * @AUTHOR:   GORAKH NATH MEHTA (2020-2021)                    *
     *                                                             *
     * ////////////////////////////////////////////////////////////*/
    
    function add_new_patient() {
        $this->checkLoginAdminSession();
        $data = array();
        $data['doctor_list'] = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        if($this->session->userdata['userType'] == 1){
            $data['surgery_list'] = $this->surgery_model->getSurgeryTypeList("*", array());
            $data['patient_list'] = $this->surgery_model->getPatientDetails("*", array());
        }
        
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/add_patient",$data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    function process_add_opd_patient() {
        log_message('info', __METHOD__ . " " . json_encode($_POST, TRUE));

        if (!empty($this->input->post("opd_number_id"))) {
            $opd_patient_list = $this->surgery_model->getPatientDetails("patient_details.id, patient_details.opd_number_id", array("patient_details.opd_number_id" => trim($this->input->post("opd_number_id"))), false);
            if (empty($opd_patient_list)) {
                $data = array(
                    "patient_details.opd_number_id" => $this->input->post("opd_number_id"),
                    "patient_details.patient_name" => $this->input->post("patient_name"),
                    "patient_details.contact_number" => $this->input->post("contact_number"),
                    "patient_details.date" => $this->input->post("date"),
                    "patient_details.valid_date" => $this->input->post("valid_date"),
                    "patient_details.shift" => $this->input->post("shift"),
                    "patient_details.department" => $this->input->post("department"),
                    "patient_details.guardian_name" => $this->input->post("guardian_name"),
                    "patient_details.doctor_id" => $this->input->post("doctor_id"),
                    "patient_details.address" => $this->input->post("address")
                );
            }
        } else {
            $data = array();
        }

        if (!empty($data)) {
            $inserted_id = $this->surgery_model->insertPatientDetails($data);
            if ($inserted_id) {
                $this->session->set_flashdata("status", "Successfully added.");
            } else {
                $this->session->set_flashdata("error", "Please try again..");
            }
        } else {
            $this->session->set_flashdata("error", "Already exists in our system.");
        }

        redirect(base_url() . "add_opd_patient");
    }

    function edit_opd_patient($patient_id = '') {
        $this->checkLoginAdminSession();
        $data = array();
        $patient_details = $this->surgery_model->getPatientDetails("*", array("patient_details.id" => $patient_id));
        if (!empty($patient_details)) {
            $data['patient_list'] = $patient_details[0];
            $doctor_details = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        }
       
        $data['doctor_list'] = $doctor_details = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/edit_opd_patient", $data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    function process_edit_opd_patient() {

        $data = array(
            "patient_details.opd_number_id" => $this->input->post("opd_number_id"),
            "patient_details.patient_name" => $this->input->post("patient_name"),
            "patient_details.contact_number" => $this->input->post("contact_number"),
            "patient_details.date" => $this->input->post("date"),
            "patient_details.valid_date" => $this->input->post("valid_date"),
            "patient_details.shift" => $this->input->post("shift"),
            "patient_details.department" => $this->input->post("department"),
            "patient_details.guardian_name" => $this->input->post("guardian_name"),
            "patient_details.doctor_id" => $this->input->post("doctor_id"),
            "patient_details.address" => $this->input->post("address")
        );

        if (!empty($this->input->post('patient_id'))) {
            $this->surgery_model->updatePatientDetails($data, array("patient_details.id" => $this->input->post('patient_id')));
            $this->session->set_flashdata("status","Successfully added."); 
        } else {
           $this->session->set_flashdata("error","Please try again.."); 
        }
        
        redirect(base_url() . "opd_patient_list");
    }

    function upload_opd_patient_file() {
        $this->checkLoginAdminSession();
        $data = array();
        $data['doctor_list'] = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/upload_opd_patient_file",$data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    function process_upload_opd_patient() {
        date_default_timezone_set("Asia/Calcutta");

        $file_type_respose = $this->get_upload_file_type();
        if ($file_type_respose['file_name_lenth']) {
            if ($file_type_respose['status']) {
                $data = $this->read_upload_file_header($file_type_respose);
                $excel_header = array('department', 'opd_id', 'shift', 'opd_type', 'app_no', 'opd_date', 'patient_name', 'guardian_name', 'paddress', 'contact_no', 'amount', 'paid_amt', 'doc_name', 'cancel');
                $check_header = $this->check_column_exist($excel_header, $data['header_data']);

                if ($check_header['status']) {
                    $bulkData = array();
                    for ($row = 2; $row <= $data['highest_row']; $row++) {

                        $rowData_array = $data['sheet']->rangeToArray('A' . $row . ':' . $data['highest_column'] . $row, NULL, TRUE, FALSE);
                        $sanitizes_row_data = array_map('trim', $rowData_array[0]);
                        if (!empty($sanitizes_row_data)) {
                            $rowData = array_combine($data['header_data'], $rowData_array[0]);
                        }

                        if (!empty($rowData['doc_name'])) {
                            $doc_nameArr = explode('.', $rowData['doc_name']);
                            $doctorList = $this->surgery_model->getDoctorLists("doctor_details.id", array("doctor_details.name" => trim($doc_nameArr[1])));
                            if (!empty($doctorList)) {
                                $doctor_id = $doctorList[0]['id'];
                            } else {
                                $doctor_id = '';
                            }
                        }

                        if (!empty($rowData['opd_id'])) {
                            $opd_patient_list = $this->surgery_model->getPatientDetails("patient_details.id, patient_details.opd_number_id", array("patient_details.opd_number_id" => trim($rowData['opd_id'])), false);
                            if (empty($opd_patient_list)) {
                                $data_array = array(
                                    "department" => strtolower($rowData['department']),
                                    "shift" => strtolower($rowData['shift']),
                                    "opd_type" => strtolower($rowData['opd_type']),
                                    "app_no" => $rowData['app_no'],
                                    "opd_number_id" => $rowData['opd_id'],
                                    "patient_name" => strtolower($rowData['patient_name']),
                                    "date" => date('Y-m-d', strtotime(date('Y-m-d H:i:s'))),
                                    "valid_date" => date('Y-m-d', strtotime(date('Y-m-d H:i:s') . "+ 20 day")),
                                    "contact_number" => $rowData['contact_no'],
                                    "guardian_name" => strtolower($rowData['guardian_name']),
                                    "doctor_id" => $doctor_id,
                                    "address" => strtolower($rowData['paddress']),
                                    "amount" => $rowData['amount'],
                                    "paid_amount" => $rowData['paid_amt'],
                                    "cancelation" => strtolower($rowData['cancel'])
                                );
                                array_push($bulkData, $data_array);
                            }
                        }
                    }
                    if (!empty($bulkData)) {
                        $this->surgery_model->insertPatientDetailInBulk($bulkData);
                        $this->session->set_flashdata("status", "Successfully uploaded.");
                    } else {
                        $this->session->set_flashdata("error", "Excel file already uploaded.");
                    }
                } else {
                    $this->session->set_flashdata("error", "Header incorrect of excel file..");
                }
            } else {
                $this->session->set_flashdata("error", "Header incorrect of excel file..");
            }
        }

        redirect(base_url() . "upload_opd_patient_file");
    }

    function excelDataToArray($highestRow, $objWorksheet, $highestColumn, $headingsArray) {
        $namedDataArray = array();
        $r = -1;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $dataRow = $objWorksheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, null, true, true, true);
            if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                ++$r;
                foreach ($headingsArray as $columnKey => $columnHeading) {
                    $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                }
            }
        }
        return $namedDataArray;
    }


    private function get_upload_file_type() {
        log_message('info', __FUNCTION__ . "=> upload file type");
        if (!empty($_FILES['file']['name']) && strlen($_FILES['file']['name']) > 0 && strlen($_FILES['file']['name']) <= 44) {
            if (!empty($_FILES['file']['name']) && $_FILES['file']['size'] > 0) {
                $pathinfo = pathinfo($_FILES["file"]["name"]);                
                switch ($pathinfo['extension']) {
                    case 'xlsx':
                        $response['file_tmp_name'] = $_FILES['file']['tmp_name'];
                        $response['file_ext'] = 'Excel2007';
                        break;
                    case 'xls':
                        $response['file_tmp_name'] = $_FILES['file']['tmp_name'];
                        $response['file_ext'] = 'Excel5';
                        break;
                }
                if (!empty($response['file_ext'])) {
                    $response['status'] = True;
                    $response['file_name_lenth'] = True;
                    $response['message'] = 'File has been uploaded successfully. ';
                } else {
                    $response['status'] = False;
                    $response['file_name_lenth'] = false;
                    $response['message'] = 'File type is not supported. Allowed extentions are xls or xlsx. ';
                }
            } else {
                log_message('info', __FUNCTION__ . ' Empty File Uploaded');
                $response['status'] = False;
                $response['file_name_lenth'] = True;
                $response['message'] = 'File upload Failed. Empty file has been uploaded';
            }
        } else if (!empty($_FILES['file']['name']) && strlen($_FILES['file']['name']) > 44) {
            log_message('info', __FUNCTION__ . 'File Name Length Is Long');
            $response['status'] = False;
            $response['file_name_lenth'] = false;
            $response['message'] = 'File upload Failed. File name length is long.';
        } else {
            log_message('info', __FUNCTION__ . 'No File Selected!! ');
            $response['status'] = False;
            $response['file_name_lenth'] = True;
            $response['message'] = 'File upload Failed. No File Selected!! ';
        }
        return $response;
    }
    
    private function read_upload_file_header($file) {
        log_message('info', __FUNCTION__ . "=> getting upload file header");
        try {
            $objReader = PHPExcel_IOFactory::createReader($file['file_ext']);
            $objPHPExcel = $objReader->load($file['file_tmp_name']);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($file['file_tmp_name'], PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        $file_name = $_FILES["file"]["name"];
//        move_uploaded_file($file['file_tmp_name'], TMP_FOLDER . $file_name);
//        chmod(TMP_FOLDER . $file_name, 0777);
        //  Get worksheet dimensions
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestDataRow();
        $highestColumn = $sheet->getHighestDataColumn();
        $response['status'] = TRUE;
        //Validation for Empty File
        if ($highestRow <= 1) {
            log_message('info', __FUNCTION__ . ' Empty File Uploaded');
            $response['status'] = False;
        }

        $headings = $sheet->rangeToArray('A1:' . $highestColumn . 1, NULL, TRUE, FALSE);
        $headings_new = array();
        foreach ($headings as $heading) {
            $heading = str_replace(array("/", "(", ")", "."), "", $heading);
            array_push($headings_new, str_replace(array(" "), "_", $heading));
        }

        $headings_new1 = array_map('strtolower', $headings_new[0]);

        $response['file_name'] = $file_name;
        $response['header_data'] = $headings_new1;
        $response['sheet'] = $sheet;
        $response['highest_row'] = $highestRow;
        $response['highest_column'] = $highestColumn;
        return $response;
    }
    
    function check_column_exist($actual_header, $upload_file_header) {

        $is_all_header_present = array_diff($actual_header, $upload_file_header);
        if (empty($is_all_header_present)) {
            $return_data['status'] = TRUE;
            $return_data['message'] = '';
        } else {
            $this->Columfailed = "<b>" . implode($is_all_header_present, ',') . " </b> column does not exist.Please correct these and upload again. <br><br><b> For reference,Please use previous successfully upload file from CRM</b>";
            $return_data['status'] = FALSE;
            $return_data['message'] = $this->Columfailed;
        }

        return $return_data;
    }
    
    public function opd_patient_list() {
        $this->checkLoginAdminSession();
        $data = array();
        $data['doctor_list'] = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/opd_patient_list", $data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    private function get_post_data() {
        $post['length'] = $this->input->post('length');
        $post['start'] = $this->input->post('start');
        $search = $this->input->post('search');
        $post['search_value'] = $search['value'];
        $post['order'] = $this->input->post('order');
        $post['draw'] = $this->input->post('draw');
        return $post;
    }

    function get_opt_patient_details() {
        $data = $this->get_opt_patient_list_data();
        
        $post = $data['post'];
        if (!empty($data['data'])) {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->surgery_model->count_all_patient_list($post),
                "recordsFiltered" => $this->surgery_model->count_patient_list($post),
                "data" => $data['data'],
            );
        } else {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data['data'],
            );
        }
        echo json_encode($output);
    }

    function get_opt_patient_list_data() {
        $post = $this->get_post_data();
        $search_flag = trim($this->input->post('search_flag'));
        $start_date = trim($this->input->post('start_date'));
        $end_date = trim($this->input->post('end_date'));
        $doctor_id = trim($this->input->post('doctor_id'));
       
        $data = array();
        if (!empty($search_flag)) {
            $post['column_order'] = array();
            $post['column_search'] = array('doctor_details.name','patient_details.opd_number_id');
            $post['where'] = '';
            
            if (!empty($start_date)) {
                if(empty($post['where'])){
                    $post['where'] .= " patient_details.date >= '" . $start_date . "' AND  patient_details.date <= '" . $end_date . "'";
                }else{
                   $post['where'] .= " AND patient_details.date >= '" . $start_date . "' AND  patient_details.date <= '" . $end_date . "'"; 
                }
                
            }

            if (!empty($doctor_id)) {
                if(empty($post['where'])){
                    $post['where'] .= " patient_details.doctor_id =" . $doctor_id;
                }else{
                   $post['where'] .= " AND patient_details.doctor_id =" . $doctor_id; 
                }
                
            }

            $select = "patient_details.id, patient_details.opd_number_id, "
                    . "patient_details.patient_name, patient_details.valid_date, "
                    . "patient_details.date, patient_details.cancelation, "
                    . "patient_details.paid_amount, patient_details.amount, patient_details.contact_number,"
                    . "patient_details.guardian_name, patient_details.address, patient_details.app_no, patient_details.opd_type, patient_details.department, patient_details.shift,"
                    . "doctor_details.name, patient_details.active as is_active";
            
            $list = $this->surgery_model->getPatientList($post, $select);
           
            $data = array();
            $no = $post['start'];
            foreach ($list as $patient_list) {
                $no++;
                $row = $this->get_patient_list_table($patient_list, $no);
                $data[] = $row;
            }
        }
        return array(
            'data' => $data,
            'post' => $post
        );
    }
    
    function get_patient_list_table($patient_list, $no) {
        $row = array();
        $row[] = $no;
        $row[] = $patient_list->opd_number_id;
        $row[] = $patient_list->patient_name;
        $row[] = $patient_list->department;
        $row[] = date("F j, Y", strtotime($patient_list->date));
        $row[] = date("F j, Y", strtotime($patient_list->valid_date));
        $row[] = $patient_list->shift;
        $row[] = $patient_list->opd_type;
        $row[] = $patient_list->guardian_name;
        $row[] = $patient_list->name;
        $row[] = "<span style='word-wrap: break-word;'>" . $patient_list->address . "</span>";
        $row[] = '<a href="'.base_url().'edit_opd_patient/'.$patient_list->id.'" class="edit_c" style="background:#36b5c7;"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

//        if ($patient_list->is_active == 1) {
//            $row[] = "<button type='button' class='btn btn-default' style='background-color: #d9534f; border-color: #fff; width: 90px; color: #fff; font-size: 13px;' id='manage_courier_status'>Deactivate</button>";
//        } else {
//            $row[] = "<button type='button' class='btn btn-danger' style='background-color: #01903a; border-color: #fff; width: 90px; color: #fff; font-size: 13px;' id='manage_courier_status'>Activate</button>";
//        }
        
        return $row;
    }
    
    function process_add_patient_surgery_list() {
        $data = array();
    
        $patient_file_name = $_FILES["patient_risk_bound"]["name"];
        $patient_file_error = $_FILES['patient_risk_bound']['error'];
        $patient_tmp_file = $_FILES['patient_risk_bound']['tmp_name'];
        $patient_file_size = $_FILES["patient_risk_bound"]["size"];

        $referrer_file_name = $_FILES["referrer_file"]["name"];
        $referrer_file_error = $_FILES['referrer_file']['error'];
        $referrer_tmp_file = $_FILES['referrer_file']['tmp_name'];
        $referrer_file_size = $_FILES["referrer_file"]["size"];
        
        $data['patient_id'] = $this->input->post("surgery_patient_id");
        $data['surgery_type_id'] = $this->input->post("surgery_type");
        $data['doctor_id'] = $this->input->post("doctor_id");
        $data['surgery_date'] = date('Y-m-d H:i:s', strtotime($this->input->post("surgery_date")));
        $data['surgery_amount'] = $this->input->post("surgery_amount");
        $data['discount_amount'] = $this->input->post("discount_amount");
        $data['advance_amount'] = $this->input->post("advance_amount");
        $data['pending_amount'] = $this->input->post("pending_amount");
        $data['advance_taken'] = $this->input->post("advance_taken");
        $data['patient_adhar_number'] = $this->input->post("patient_adhar_number");
        $data['surgery_patient_details.user_id'] = $this->session->userdata('userID');
       
            $patient_return = $this->upload_multiple_images($patient_file_name, $patient_file_error, $patient_tmp_file, $patient_file_size, 'patient-risk-bound-file');
            if (!empty($patient_return)) {
                $data['patient_risk_bound_file'] = $this->input->post("image");
                $_POST['image'] = '';
                if (!empty($referrer_file_name)) {
                    $referrer_return = $this->upload_multiple_images($referrer_file_name, $referrer_file_error, $referrer_tmp_file, $referrer_file_size, 'referrer-patient-file');
                    if (!empty($referrer_return)) {
                        $data['patient_referrer_file'] = $this->input->post("image");
                        $this->surgery_model->insertSurgeryPatientDetails($data);
                        $this->session->set_flashdata("status", "Surgery Details Successfully Added.");
                    } else {
                        $this->session->set_flashdata("error", "Check File Extensions Referrer Risk Bound.");
                    }
                } else {
                    $this->surgery_model->insertSurgeryPatientDetails($data);
                    $this->session->set_flashdata("status", "Surgery Details Successfully Added.");
                }
            } else {
                $this->session->set_flashdata("error", "Check File Extensions Patient Risk Bound.");
            }
      

        redirect(base_url() . "surgery_patient_list");
    }

    
    function surgery_patient_list(){
        $this->checkLoginAdminSession();
        $data = array();
        $data['patient_list'] = $this->surgery_model->getPatientDetails("patient_details.id as partient_id, patient_details.patient_name", array(), TRUE);
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/surgery_patient_list", $data);
        $this->load->view('admin-panel/admin_footer');
    }
            
    function get_surgery_patient_details() {
        $data = $this->get_surgery_patient_list_data();
        
        $post = $data['post'];
        if (!empty($data['data'])) {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => $this->surgery_model->count_all_surgery_patient_list($post),
                "recordsFiltered" => $this->surgery_model->count_surgery_patient_list($post),
                "data" => $data['data'],
            );
        } else {
            $output = array(
                "draw" => $this->input->post('draw'),
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => $data['data'],
            );
        }
        echo json_encode($output);
    }
    
    
    function get_surgery_patient_list_data() {
        $post = $this->get_post_data();
        $search_flag = trim($this->input->post('search_flag'));
        $start_date = trim($this->input->post('start_date'));
        $end_date = trim($this->input->post('end_date'));
        $discharge_start_date = trim($this->input->post('discharge_start_date'));
        $discharge_end_date = trim($this->input->post('discharge_end_date'));
        $patient_id = trim($this->input->post('patient_id'));
        
        $doctor_id = trim($this->input->post('doctor_id'));
        $advance_taken = trim($this->input->post('advance_taken'));
        $surgery_type_id = trim($this->input->post('surgery_type_id'));
        
        
        $chanage_start_date = '';
        if (!empty($start_date)) {
            $chanage_start_date = date('Y-m-d', strtotime('+29 days', strtotime(trim($this->input->post('start_date')))));
        }
        
        $discharge_start_date = '';
        if (!empty($discharge_start_date)) {
            $discharge_date = date('Y-m-d', strtotime('+29 days', strtotime(trim($this->input->post('discharge_start_date')))));
        }

        $data = array();
        if (!empty($search_flag)) {
            $post['column_order'] = array();
            $post['column_search'] = array('doctor_details.name', 'patient_details.opd_number_id', 'patient_details.contact_number','surgery_patient_details.patient_adhar_number');
            $post['where'] = '';

            if (!empty($start_date) && (strtotime($chanage_start_date) != strtotime($end_date))) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.surgery_date >= '" . $start_date . "' AND  surgery_patient_details.surgery_date <= '" . $end_date . "'";
                } else {
                    $post['where'] .= " AND surgery_patient_details.surgery_date >= '" . $start_date . "' AND  surgery_patient_details.surgery_date <= '" . $end_date . "'";
                }
            }

            if (!empty($discharge_start_date) && strtotime($discharge_date) != strtotime($discharge_end_date)) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.discarge_date >= '" . $discharge_start_date . "' AND  surgery_patient_details.discarge_date <= '" . $discharge_end_date . "'";
                } else {
                    $post['where'] .= " AND surgery_patient_details.discarge_date >= '" . $discharge_start_date . "' AND  surgery_patient_details.discarge_date <= '" . $discharge_end_date . "'";
                }
            }


            if (!empty($doctor_id)) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.doctor_id =" . $doctor_id;
                } else {
                    $post['where'] .= " AND surgery_patient_details.doctor_id =" . $doctor_id;
                }
            }
            
            if (!empty($surgery_type_id)) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.surgery_type_id =" . $surgery_type_id;
                } else {
                    $post['where'] .= " AND surgery_patient_details.surgery_type_id =" . $surgery_type_id;
                }
            }
            
            
            if (!empty($advance_taken)) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.advance_taken =" . $advance_taken;
                } else {
                    $post['where'] .= " AND surgery_patient_details.advance_taken =" . $advance_taken;
                }
            }
            
            
            
            if (!empty($patient_id)) {
                if (empty($post['where'])) {
                    $post['where'] .= " surgery_patient_details.patient_id =" . $patient_id;
                } else {
                    $post['where'] .= " AND surgery_patient_details.patient_id =" . $patient_id;
                }
            }

            $select = "surgery_patient_details.id, patient_details.opd_number_id, "
                    . "patient_details.patient_name, patient_details.valid_date, "
                    . "patient_details.date, patient_details.contact_number, "
                    . "patient_details.shift, patient_details.department, "
                    . "patient_details.guardian_name, patient_details.address, "
                    . "doctor_details.name, doctor_details.department, patient_details.active as is_active,"
                    . "surgery_patient_details.surgery_date, surgery_patient_details.surgery_amount, "
                    . "surgery_patient_details.discount_amount, surgery_patient_details.advance_amount, "
                    . "surgery_patient_details.pending_amount, surgery_patient_details.advance_taken, "
                    . ",surgery_patient_details.surgery_date, surgery_patient_details.patient_risk_bound_file"
                    . ",surgery_patient_details.patient_adhar_number, surgery_patient_details.surgery_date"
                    . ", surgery_patient_details.patient_referrer_file, surgery_patient_details.discarge_date"
                    . ", surgery_type.surgery_name, doctor_details.name as doctor_name";


            $list = $this->surgery_model->getSurgeryPatientList($post, $select);

            $data = array();
            $no = $post['start'];
            foreach ($list as $patient_list) {
                $no++;
                $row = $this->get_surgery_patient_list_table($patient_list, $no);
                $data[] = $row;
            }
        }
        return array(
            'data' => $data,
            'post' => $post
        );
    }

    function get_surgery_patient_list_table($patient_list, $no) {
        $row = array();
        $row[] = $no;
       
        $row[] = ucfirst($patient_list->patient_name);
        $row[] = ucfirst($patient_list->surgery_name);
        $row[] = "Dr. ".ucfirst($patient_list->doctor_name);
        $row[] = date("F j, Y", strtotime($patient_list->surgery_date));
        $row[] = $patient_list->surgery_amount;
        $row[] = $patient_list->discount_amount;
        $row[] = $patient_list->advance_amount;
        $row[] = $patient_list->pending_amount;
        $row[] = ucfirst($patient_list->advance_taken);
        
        $row[] = "<span style='word-wrap:break-word;'>" . $patient_list->patient_adhar_number . "</span>";
        $row[] ='<a href="'.base_url().'download_patient_file/'. base64_encode($patient_list->patient_risk_bound_file).'" target="_blank"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cloud-download" fill="currentColor" style="color:#4ab733;">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"></path>
                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"></path>
		</svg></a>';
        if(!empty($patient_list->patient_referrer_file)){
        $row[] ='<a href="'.base_url().'download_referrer_file/'. base64_encode($patient_list->patient_referrer_file).'" target="_blank"><svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cloud-download" fill="currentColor" style="color:#4ab733;">
                    <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"></path>
                    <path fill-rule="evenodd" d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"></path>
		</svg></a>';
        } else {
          $row[] ='No doc';  
        }
        
        if(!empty($patient_list->discarge_date)){
        $row[] = date("F j, Y", strtotime($patient_list->discarge_date));
        } else {
            $row[] = 'Not found';
        }
        
      
        $row[] = '<a href="'.base_url().'download_hospital_surgery_file/'.($patient_list->id).'" target="_blank">Click Here</a>';
        
        $row[] = '<a href="'.base_url().'edit_surgery_patient_details/'.($patient_list->id).'" class="edit_c" style="background:#36b5c7;" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

//        if ($patient_list->is_active == 1) {
//            $row[] = "<button type='button' class='btn btn-default' style='background-color: #d9534f; border-color: #fff; width: 90px; color: #fff; font-size: 13px;' id='manage_courier_status'>Deactivate</button>";
//        } else {
//            $row[] = "<button type='button' class='btn btn-danger' style='background-color: #01903a; border-color: #fff; width: 90px; color: #fff; font-size: 13px;' id='manage_courier_status'>Activate</button>";
//        }
        
        return $row;
    }

            
    function get_patient_lists() {
        $patient_list = $this->surgery_model->getPatientDetails("*", array());
        $select = '<ul id="country-list">';
        foreach ($patient_list as $value) {
            $select .= '<li onClick="selectPatientName(\'' . $value["id"] . '\',\'' . trim($value["patient_name"]) . '\');">' . $value["patient_name"] . '</li>';
        }
        $select .= '</ul>';
        echo $select;
    }

    function upload_multiple_images($file_name, $file_error, $tmp_file, $file_size, $folder_name) {
        $allowedExts = array("png", "jpg", "jpeg","pdf", "JPG", "JPEG", "PNG","PDF");
        $temp = explode(".",$file_name);
        $extension = end($temp);
        if (($file_error != 4) && !empty($tmp_file)) {
            if ($file_name != null) {
                if (($file_size) && in_array($extension, $allowedExts)) {
                    if ($file_error > 0) {
                        return FALSE;
                    } else {
                        $pic = md5(uniqid(rand()));
                        $picName = $pic . "." . $extension;
                        $_POST['image'] = $picName;
                        move_uploaded_file($tmp_file, FCPATH . "images/".$folder_name."/" . $picName);
                        return TRUE;
                    }
                }
            }
        }
    }
    
    
    function download_hospital_surgery_file($id) {
        $this->checkLoginAdminSession();
        $data = array();
        $data['surgery_list'] = $this->surgery_model->get_hopital_surgery_details("surgery_patient_details.id, surgery_patient_details.discarge_date, doctor_details.name as doctor_name, patient_details.patient_name, surgery_patient_document.hospital_surgery_file, surgery_type.surgery_name", array("surgery_patient_details.id" => $id));
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/hospital_surgery_file_list", $data);
        $this->load->view('admin-panel/admin_footer');
    }

    function edit_surgery_patient_details($id) {
        $this->checkLoginAdminSession();
        $data = array();
        if (!empty($id)) {
            $select = "surgery_patient_details.id, patient_details.opd_number_id, patient_details.id as patient_id, "
                    . "patient_details.patient_name, patient_details.valid_date, patient_details.doctor_id,"
                    . "patient_details.date, patient_details.contact_number, surgery_patient_details.surgery_type_id,"
                    . "patient_details.shift, patient_details.department, "
                    . "patient_details.guardian_name, patient_details.address, "
                    . "doctor_details.name, doctor_details.department, patient_details.active as is_active,"
                    . "surgery_patient_details.surgery_date, surgery_patient_details.surgery_amount, "
                    . "surgery_patient_details.discount_amount, surgery_patient_details.advance_amount, "
                    . "surgery_patient_details.pending_amount, surgery_patient_details.advance_taken, "
                    . ", surgery_patient_details.surgery_date, surgery_patient_details.patient_risk_bound_file"
                    . ", surgery_patient_details.surgery_date"
                    . ", surgery_patient_details.patient_referrer_file, surgery_patient_details.discarge_date"
                    . ", surgery_type.surgery_name, doctor_details.name as doctor_name, surgery_patient_details.patient_adhar_number";
            $post['where'] = " surgery_patient_details.id =" . $id;
            $data['doctor_list'] = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
            $data['surgery_list'] = $this->surgery_model->getSurgeryTypeList("*", array());
            $data['patient_list'] = $this->surgery_model->getPatientDetails("patient_details.id, patient_details.patient_name", array());
            $surgery_details = $this->surgery_model->getSurgeryPatientList($post, $select, TRUE);
            if(!empty($surgery_details)){
            $data['surgery_patient'] = $surgery_details[0]; 
            }
            $data['surgery_files'] = $this->surgery_model->getSurgeryDocuments("surgery_patient_document.id, surgery_patient_document.surgery_patient_id, surgery_patient_document.hospital_surgery_file", array("surgery_patient_document.surgery_patient_id" => $id));
        }

        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/edit_surgery_patient", $data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    function process_edit_patient_surgery(){

        $data = array();
      
        $patient_file_name = $_FILES["patient_risk_bound"]["name"];
        $patient_file_error = $_FILES['patient_risk_bound']['error'];
        $patient_tmp_file = $_FILES['patient_risk_bound']['tmp_name'];
        $patient_file_size = $_FILES["patient_risk_bound"]["size"];

        $referrer_file_name = $_FILES["referrer_file"]["name"];
        $referrer_file_error = $_FILES['referrer_file']['error'];
        $referrer_tmp_file = $_FILES['referrer_file']['tmp_name'];
        $referrer_file_size = $_FILES["referrer_file"]["size"];
        $data['surgery_patient_details.user_id'] = $this->session->userdata('userID');
        if (!empty($this->input->post("surgery_patient_id"))) {
            $data['patient_id'] = $this->input->post("surgery_patient_id");
        }

        if (!empty($this->input->post("surgery_type"))) {
            $data['surgery_type_id'] = $this->input->post("surgery_type");
        }
        
        if (!empty($this->input->post("patient_adhar_number"))) {
            $data['patient_adhar_number'] = $this->input->post("patient_adhar_number");
        }

        if (!empty($this->input->post("doctor_id"))) {
            $data['doctor_id'] = $this->input->post("doctor_id");
        }

        if(!empty($this->input->post("surgery_date"))){
            $data['surgery_date'] = date('Y-m-d H:i:s', strtotime($this->input->post("surgery_date")));
        }
        
        if(!empty($this->input->post("surgery_amount"))){
           $data['surgery_amount'] = $this->input->post("surgery_amount"); 
        }
        
        if (!empty($this->input->post("discount_amount"))){
           $data['discount_amount'] = $this->input->post("discount_amount"); 
        }
        
        if (!empty($this->input->post("advance_amount"))) {
            $data['advance_amount'] = $this->input->post("advance_amount");
        }
        
        if (!empty($this->input->post("pending_amount"))) {
            $data['pending_amount'] = $this->input->post("pending_amount");
        }

        if (!empty($this->input->post("advance_taken"))) {
            $data['advance_taken'] = $this->input->post("advance_taken");
        }
        
        
        if (!empty($patient_file_name)) {
            $patient_return = $this->upload_multiple_images($patient_file_name, $patient_file_error, $patient_tmp_file, $patient_file_size, 'patient-risk-bound-file');
            if (!empty($patient_return)) {
                $data['patient_risk_bound_file'] = $this->input->post("image");
                $_POST['image'] = '';
            } else {
                $this->session->set_flashdata("error", "Check File Extensions Patient Risk Bound.");
            }
        }

        if (!empty($referrer_file_name)) {
            $referrer_return = $this->upload_multiple_images($referrer_file_name, $referrer_file_error, $referrer_tmp_file, $referrer_file_size, 'referrer-patient-file');
            if (!empty($referrer_return)) {
                $data['patient_referrer_file'] = $this->input->post("image");
                $_POST['image'] = '';
            } else {
                $this->session->set_flashdata("error", "Check File Extensions Referrer Risk Bound.");
            }
        }
        
        if (!empty($patient_file_name)) {
            $patient_return = $this->upload_multiple_images($patient_file_name, $patient_file_error, $patient_tmp_file, $patient_file_size, 'patient-risk-bound-file');
            if (!empty($patient_return)) {
                $data['patient_risk_bound_file'] = $this->input->post("image");
                $_POST['image'] = '';
            } else {
                $this->session->set_flashdata("error", "Check File Extensions Patient Risk Bound.");
            }
        }
        
        $image = array();
        $ImageCount = count($_FILES['patient_surgery_file']['name']);

        if ($ImageCount > 0) {
            for ($i = 0; $i < $ImageCount; $i++) {
                $file_name = $_FILES["patient_surgery_file"]["name"][$i];
                $file_error = $_FILES['patient_surgery_file']['error'][$i];
                $tmp_file = $_FILES['patient_surgery_file']['tmp_name'][$i];
                $file_size = $_FILES["patient_surgery_file"]["size"][$i];
                if (isset($file_name)) {
                    $this->upload_multiple_images($file_name, $file_error, $tmp_file, $file_size, 'patient-surgery-file');
                    $image[] = array("surgery_patient_document.surgery_patient_id" => $this->input->post("edit_id"), "surgery_patient_document.hospital_surgery_file" => $this->input->post("image"), "surgery_patient_document.user_id" => $this->session->userdata('userID'));
                    $_POST['image'] = '';
                }
            }           
            $this->surgery_model->insertPatientSurgeryfileInBulk($image);
            //$this->surgery_model->deletePatientSurgeryFile(array("surgery_patient_document.surgery_patient_id" => $this->input->post("edit_id")));
//            foreach ($this->input->post("old_patient_surgery_file") as $value) {
//                unlink(FCPATH . 'images/patient-surgery-file/' . $value);
//            }
        }
        
        if (!empty($data)) {
            $this->surgery_model->updatePatientSurgeryDetails($data, array("surgery_patient_details.id" => $this->input->post("edit_id")));
            $this->session->set_flashdata("status", "Surgery Details Successfully updated.");
        } else {
            $this->session->set_flashdata("error", "Please Try Again.....");
        }

        redirect(base_url() . "surgery_patient_list");
        
    }
    
    function download_patient_file($image) {
        $file = base64_decode($image);
        $this->load->helper('download');
        force_download('images/patient-risk-bound-file/' . $file, NULL);
        redirect(base_url() . "surgery_patient_list");   
    }
    
    function download_parent_file($image) {
        $file = base64_decode($image);
        $this->load->helper('download');
        force_download('images/parent-risk-bound-file/' . $file, NULL);
        redirect(base_url() . "surgery_patient_list");   
    }
    
    
    function download_referrer_file($image) {
        $file = base64_decode($image);
        $this->load->helper('download');
        force_download('images/referrer-patient-file/' . $file, NULL);
        redirect(base_url() . "surgery_patient_list");   
    }
    
    function download_patient_surgery_file($image, $id) {
        $this->load->helper('download');
        force_download('images/patient-surgery-file/' . $image, NULL);
        redirect(base_url() . "download_hospital_surgery_file/" . $id);
    }
    
    function advance_search_surgery_patient(){
        $this->checkLoginAdminSession();
        $data = array();
        $data['patient_list'] = $this->surgery_model->getPatientDetails("patient_details.id as partient_id, patient_details.patient_name", array(), TRUE);
        $data['doctor_list'] = $this->surgery_model->getDoctorLists("doctor_details.id, doctor_details.name", array());
        $data['surgery_list'] = $this->surgery_model->getSurgeryTypeList("*", array());
        $data['advance_taken_by'] = $this->surgery_model->getAdvanceTakenPersonList("surgery_patient_details.advance_taken", array(), "surgery_patient_details.advance_taken");

        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/advance_search_patient_list", $data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    
    function create_new_user_account(){
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/create_new_user_account");
        $this->load->view('admin-panel/admin_footer');
    }
    
    function process_create_new_user_account() {
        $user_type = $this->input->post("user_type");
        $name = $this->input->post("user_name");
        $email = $this->input->post("user_email");
        $mobile_no = $this->input->post("user_phone");
        $data = array();
        if (!empty($email)) {
            $data["user_type"] = $user_type;
            $data["name"] = $name;
            $data["email"] = $email;
            $data["mobile_no"] = $mobile_no;
            $data["clear_password"] = $this->input->post("password");
            $data["has_key_password"] = md5($this->input->post("password"));
            $data["terms_condition_status"] = true;
            if ($this->input->post("password") == $this->input->post("confirm_password")) {
                $users_details = $this->surgery_model->getUsersDetails('users.id,users.email', array('users.email' => $email));
                if (empty($users_details)) {
                    if (!empty($data)) {
                        $user_id = $this->surgery_model->insertUsersDetails($data);
                        $this->session->set_flashdata("status", "Successfully.");
                    }
                } else {
                    $this->session->set_flashdata("error", "Account already exits...");
                }
            } else {
                $this->session->set_flashdata("error", "Your password & confirm password should be equal.");
            }
        } else {
            $this->session->set_flashdata("error", "Enter valid email...");
        }
        redirect(base_url() . "surgery_patient_list");
    }

    public function users_list() {
        $this->checkLoginAdminSession();
        $data = array();
        $data['users_list'] = $this->surgery_model->getUsersDetails("users.id, users.name, users.email, users.user_type, users.active, users.mobile_no", array());
        $this->load->view('admin-panel/admin_header');
        $this->load->view('admin-panel/admin_sidebar');
        $this->load->view("admin-panel/users_list", $data);
        $this->load->view('admin-panel/admin_footer');
    }
    
    function manageuser_account() {
        $user_id = $this->input->post("user_id");
        $data = array();
        if ($this->input->post("status") == 1) {
            $data['users.active'] = 0;
        } else {
            $data['users.active'] = 1;
        }
        if (!empty($data)) {
            $this->surgery_model->updateUsersDetails($data, array("users.id" => $user_id));
            $this->session->set_flashdata("status", "Successfully Updated.");
            echo json_encode(array("status"=>'sucess'));
        }
    }

    private function setSession($data) {
        $userSession = array(
            'session_id' => md5(uniqid(mt_rand(), true)),
            'userID' => $data['id'],
            'name' => $data['name'],
            'short_name' => $data['short_name'],
            'email' => $data['email'],
            'phone' => $data['mobile_no'],
            'sess_expiration' => 3000,
            'loggedIn' => TRUE,
            'session_hander' => 'admin',
            'userType' => $data['user_type'],
        );

        $this->session->set_userdata($userSession);
    }
    

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    function checkLoginAdminSession() {
        if (($this->session->userdata('loggedIn') == TRUE) && ($this->session->userdata('userType') == 3 || $this->session->userdata('userType') == 1)) {
            return TRUE;
        } else {
            echo PHP_EOL . 'Terminal Access Not Allowed' . PHP_EOL;
            redirect(base_url());
        }
    }
    
    function checkLoginAgencySession() {
        if (($this->session->userdata('loggedIn') == TRUE) && ($this->session->userdata('userType') == 2)) {
            return TRUE;
        } else {
            echo PHP_EOL . 'Terminal Access Not Allowed' . PHP_EOL;
            redirect(base_url());
        }
    }
 
}
