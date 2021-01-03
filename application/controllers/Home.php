<?php

/**
 * Description of Home Controller
 *
 * @author Gorakh
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __Construct() {
        parent::__Construct();
        $this->load->model("surgery_model");
        $this->load->model("agency_model");
        $this->load->library('session');
        $this->load->helper('cookie');
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('admin-panel/login');
        $this->load->view('admin-panel/admin_footer.php');
    }
    
    
    

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America"
        );
            if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ip = '';
            $ipdat = json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => $ipdat->geoplugin_city,
                            "state"          => $ipdat->geoplugin_regionName,
                            "country"        => $ipdat->geoplugin_countryName,
                            "country_code"   => $ipdat->geoplugin_countryCode,
                            "continent"      => $continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => $ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = $ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = $ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = $ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = $ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = $ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
    
    function array_interlace() {
        $args = func_get_args();
        $total = count($args);

        if ($total < 2) {
            return FALSE;
        }

        $i = 0;
        $j = 0;
        $arr = array();

        foreach ($args as $arg) {
            foreach ($arg as $v) {
                $arr[$j] = $v;
                $j += $total;
            }

            $i++;
            $j = $i;
        }

        ksort($arr);
        return array_values($arr);
    }
    
    function escorts_view_profile($escort_is, $escort_id) {
        $data = array();
        if ($escort_is == 1) {
           
            if (!empty($escort_id)) {
                $select = "users.id as escort_id, users.mobile_no,individual_escorts_profile.dob, individual_escorts_profile.height, individual_escorts_profile.eye_color, individual_escorts_profile.skin_color, individual_escorts_profile.hair_color, individual_escorts_profile.bust,"
                        . " individual_escorts_profile.weight, individual_escorts_profile.waist, individual_escorts_profile.hips, individual_escorts_profile.hobbies, individual_escorts_profile.occupation, individual_escorts_profile.smoker, individual_escorts_profile.drink,"
                        . " individual_escorts_profile.country_id, individual_escorts_profile.city_id, individual_escorts_profile.address, individual_escorts_profile.pincode_id, individual_escorts_profile.full_name as name, individual_escorts_profile.about_me, cities.city_name, individual_escorts_profile.is_active,"
                        . "escorts_type.escort_type, pincode_list.pincode, escorts_image_list.original_image, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, individual_escorts_profile.dob) ), '%y Years') AS age, country.country_name, users.user_type as escart_is, individual_escorts_profile.escort_type_id";
                $escorts_profile = $this->surgery_model->getIndependentEscortsList($select, array("individual_escorts_profile.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1));
                
                if (!empty($escorts_profile)) {
                    $data['profile_details'] = $escorts_profile[0];
                    $data['similar_escort_profile'] = $this->surgery_model->getIndependentEscortsList($select, array("individual_escorts_profile.escort_type_id" => $escorts_profile[0]['escort_type_id'],"individual_escorts_profile.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1));
                    $data['escorts_service_area'] = $this->surgery_model->getIndependentEscortsServiceAreaDetails('cities.city_name', array("individual_escorts_service_area.user_id" => $escort_id));
                    
                } else {
                    $data['error'] = "Profile Id '" . $escort_id . "' Details Does Not Exist In Our Database.";
                }
            } else {
                $data['error'] = "Profile Id Is Incurrect.";
            }
        } else {
            if (!empty($escort_id)) {
                $select = "agency_escorts_profile.id as escort_id, agency_escorts_profile.agency_id, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, agency_escorts_profile.dob) ), '%y Years') AS age, agency_escorts_profile.name, agency_escorts_profile.height,"
                        . " agency_escorts_profile.eye_color, agency_escorts_profile.mobile_number, agency_escorts_profile.skin_color, agency_escorts_profile.hair_color, agency_escorts_profile.bust, agency_escorts_profile.weight, agency_escorts_profile.hips, "
                        . "agency_escorts_profile.hobbies, agency_escorts_profile.occuption, agency_escorts_profile.smoker, agency_escorts_profile.drink, agency_escorts_profile.about_me, agency_escorts_profile.escort_type_id, escorts_image_list.original_image, escorts_type.escort_type, '2' as 'escart_is', agency_escorts_profile.waist";
                $where = array("agency_escorts_profile.id" => $escort_id, "agency_escorts_profile.is_active" => 1, "escorts_type.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1);
                $escorts_profile = $this->agency_model->getAgencyEscortsCount($select, $where);
                if (!empty($escorts_profile)) {
                    $data['profile_details'] = $escorts_profile[0];
                    $data['similar_escort_profile'] = $this->agency_model->getAgencyEscortsCount($select, array("agency_escorts_profile.escort_type_id" => $escorts_profile[0]['escort_type_id'], "agency_escorts_profile.is_active" => 1, "escorts_type.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1));
                } else {
                    $data['error'] = "Profile Id '" . $escort_id . "' Details Does Not Exist In Our Database.";
                }
            } else {
                $data['error'] = "Profile Id Is Incurrect.";
            }
        }
        
        if (!empty($escort_id)) {
            $data['profile_image_list'] = $this->agency_model->getEscortImageList("escorts_image_list.original_image", array("escorts_image_list.escort_id" => $escort_id, "escorts_image_list.user_type" => $escort_is));
            $data['service_rate_details'] = $this->agency_model->getEscortRateDetails("escorts_rate.id, escorts_rate.durations_time, escorts_rate.amount, escorts_rate.currency_symbol, escorts_rate.currency_code", array("escorts_rate.escort_id" => $escort_id, "escorts_rate.user_type" => $escort_is));
            $data['escorts_service_area'] = $this->agency_model->getAgencyEscortServiceableArea('cities.city_name', array("agency_escorts_service_area.escort_id" => $escort_id));
            $data['escorts_feature_service'] = $this->agency_model->getEscortFeaturedService('escorts_featured_services_details.service_type', array("escorts_featured_services_details.escort_id" => $escort_id, "escorts_featured_services_details.user_type" => $escort_is));
            $data['escorts_specialisation'] = $this->agency_model->getEscortSpecialisationList("escort_services.service", array("escorts_specialisation.escort_id" => $escort_id,  "escorts_specialisation.user_type" => $escort_is));
            $data['languages_list'] = $this->surgery_model->getEscortsLanguageDetails("languages_list.language", array("escorts_languages_mapping.escort_id" => $escort_id, "escorts_languages_mapping.user_type" => $escort_is));
            
        } else {
            $data['error'] = "Profile Id Is Incurrect.";
        }

//        echo '<pre/>';
//        print_r($data);
//        die();
        $this->load->view('website/header');
        $this->load->view('website/view_escort_profile', $data);
        $this->load->view('website/footer');
    }

    function users_registration() {
        log_message('info', __METHOD__ . " " . json_encode($_POST, true));

        $user_type = $this->input->post("user_type");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        //$mobile_no = $this->input->post("mobile_no");

        if ($user_type == 1) {
            $group = 'agency';
            $department = 'agency_owner';
            $mail_template = "AGENCY_NEW_REGISTER";
        } else {
            $group = 'escort';
            $department = 'escort';
            $mail_template = "scorts_new_regiter";
        }
       
        $data = array();
        if (!empty($email)) {
            $data["user_type"] = $user_type;
            $data["name"] = $name;
            $data["email"] = $email;
            //$data["mobile_no"] = $mobile_no;
            $data["clear_password"] = $this->input->post("clear_password");
            $data["has_key_password"] = md5($this->input->post("clear_password"));
            $data["terms_condition_status"] = true;
        }
        $session = array();
        if (!empty($email)) {
            $users_details = $this->surgery_model->getUsersDetails('users.id,users.email', array('users.email' => $email));
            if (empty($users_details)) {
                
                if (!empty($data)) {
                    $user_id = $this->surgery_model->insertUsersDetails($data);
                    if (!empty($user_id) && $user_type == 1) {
                        $inserted_id = $this->surgery_model->insertIndividualEscorts(array('user_id' => $user_id));
                        $session['link_access'] = FALSE;
                    } else {
                        $inserted_id = $this->agency_model->insertEscortsAgencyProfileDetails(array('user_id' => $user_id)); 
                        $session['link_access'] = true;
                    }
                    
                    $string_arr = explode(" ", trim($name));
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
                    
                    if (!empty($inserted_id)) {
                        $session['id'] = $inserted_id;
                        $session['name'] = $name;
                        $session['short_name'] = $short_name;
                        $session['email'] = $email;
                        $session['user_type'] = $user_type;
                        $session['mobile_no'] = '';
                        $this->setSession($session);
                        echo json_encode(array("message" => 'Registration has been sucess',"flag" => $user_type));
                        $select = "email_template.tag, email_template.subject, email_template.template, email_template.from, email_template.to, email_template.cc";
                        $where = array("email_template.tag" => $mail_template);
                        //$templete = $this->surgery_model->getEmailTemplate($select, $where);
                    } else {
                        echo json_encode(array("message" => 'Something gone wrong fails'));
                    }
                }
            } else {
                echo json_encode(array("message" => 'Email already exits.'));
            }
        }
    }
    
    function users_login() {
        log_message('info', __METHOD__ . " " . json_encode($_POST, true));
        $email = $this->input->post("email");
        $clear_password = $this->input->post("clear_password");
        $has_key_password = md5($this->input->post("clear_password"));
        if ($email) {
            $select = "users.id, users.name, users.email, users.mobile_no, users.user_type, users.active";
            $where = array(
                'users.email' => $email,
                'users.clear_password' => $clear_password,
                'users.has_key_password' => $has_key_password,
                'users.user_type != 3' => NULL
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
                if($users_details[0]->user_type == 2){
                    $escorts_agency_details = $this->agency_model->getEscortsAgency("escorts_agency_details.country_id, escorts_agency_details.city_id", array("escorts_agency_details.user_id" => $users_details[0]->id));
                    if(!empty($escorts_agency_details)){
                      $session['link_access'] = true;  
                    } else {
                      $session['link_access'] = false;    
                    }
                
                }else{
                  $session['link_access'] = false;      
                }
                $this->setSession($session);
                if($users_details[0]->user_type == 2){
                  echo json_encode(array('message' => 'login succss', "flag" => 2));  
                } else {
                  echo json_encode(array('message' => 'login succss', "flag" => 1));   
                }
                
            } else {
                echo json_encode(array("message" => 'Your email or password invalid.'));
            }
        } else {
            echo json_encode(array("message" => 'Your email should not be blank.'));
        }
    }
    
    
    
    function escorts_advance_search(){
        log_message('info', __METHOD__ . " " . json_encode($_GET, true));
        $data = array();
        $agency_arr = array();
        $indipendent_arr =array();
        $inde_where = array();
        $agency_where = array();
//        echo '<pre/>';
//        print_r($this->input->get());
//              die();
        $city_id = $this->input->get("city_id");
        $escort_type_id = $this->input->get("type_id");
        $cat = $this->input->get("cat");
        $charges = $this->input->get("charges");
        $age = $this->input->get('age'); 
        
        if (!empty($city_id)) {
            $city_details = $this->surgery_model->getCityList("cities.id, cities.country_id, cities.city_name, cities.status", array("cities.id" => $city_id, "cities.status" => 1));

            $inde_where = array("individual_escorts_profile.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1);
            $agency_where = array("agency_escorts_profile.is_active" => 1, "escorts_type.is_active" => 1, "escorts_image_list.is_active_profile_image" => 1);
            

            if (!empty($city_details[0]['country_id'])) {
                $wisecurrency = $this->surgery_model->getCountryWiseCurrencyDetails("country_wise_currency.currency_image", array("country_wise_currency.country_id" => $city_details[0]['country_id']));
                $data['currency_image'] = $wisecurrency[0]['currency_image'];
                $inde_where["individual_escorts_profile.country_id"] = $city_details[0]['country_id'];
                $agency_where["agency_escorts_profile.country_id"] = $city_details[0]['country_id'];
            }

            if (!empty($city_id)) {
                $data['city_id'] = $city_id;
                $inde_where["individual_escorts_profile.city_id"] = $city_id;
                $agency_where["agency_escorts_profile.city_id"] = $city_id;
            } else {
                $data['city_id'] = '';
            }

            if (!empty($escort_type_id)) {
                $data['type_id'] = $escort_type_id;
                $inde_where["individual_escorts_profile.escort_type_id"] = $escort_type_id;
                $agency_where["agency_escorts_profile.escort_type_id"] = $escort_type_id;
            } else {
                $data['type_id'] = '';
            }
            
            if (!empty($charges)) {
                $data['charges'] = $charges;
                $rate = str_replace('-', ',', $charges); 
                $inde_where["escorts_rate.amount IN($rate)"] = null;
                $agency_where["escorts_rate.amount IN($rate)"] = null;
                
            } else {
                $data['charges'] = '';
            }
            
            if (!empty($age)) {
                $data['age'] = $age;
                $age_arr = explode("-", $age);
               
                $inde_where["DATE_FORMAT(FROM_DAYS( DATEDIFF(CURRENT_DATE, individual_escorts_profile.dob)),'%y') >= $age_arr[0] AND DATE_FORMAT(FROM_DAYS( DATEDIFF(CURRENT_DATE, individual_escorts_profile.dob)),'%y')  <= $age_arr[1] "] = NULL;
                $agency_where["DATE_FORMAT(FROM_DAYS( DATEDIFF(CURRENT_DATE, agency_escorts_profile.dob)),'%y') >= $age_arr[0] AND DATE_FORMAT(FROM_DAYS( DATEDIFF(CURRENT_DATE, agency_escorts_profile.dob)),'%y')  <= $age_arr[1] "] = NULL;
                //$agency_where["agency_escorts_profile.age"] = NULL;
            } else {
                $data['age'] = '';
            }

            if (!empty($cat)) {
                $data['category'] = $cat;
                if ($cat == 1) {
                    $ind_select = "users.id as escort_id, users.mobile_no,individual_escorts_profile.dob, individual_escorts_profile.height, individual_escorts_profile.eye_color, individual_escorts_profile.skin_color, individual_escorts_profile.hair_color, individual_escorts_profile.bust,"
                            . " individual_escorts_profile.weight, individual_escorts_profile.waist, individual_escorts_profile.hips, individual_escorts_profile.hobbies, individual_escorts_profile.occupation, individual_escorts_profile.smoker, individual_escorts_profile.drink,"
                            . " individual_escorts_profile.country_id, individual_escorts_profile.city_id, individual_escorts_profile.address, individual_escorts_profile.pincode_id, individual_escorts_profile.full_name as name, individual_escorts_profile.about_me, cities.city_name, individual_escorts_profile.is_active,"
                            . "escorts_type.escort_type, pincode_list.pincode, escorts_image_list.original_image, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, individual_escorts_profile.dob) ), '%y Years') AS age, country.country_name, users.user_type as escart_is";
                    $indipendent_arr = $this->surgery_model->getIndependentEscortsList($ind_select, $inde_where, true);
                } else {
                    $agency_select = "agency_escorts_profile.id as escort_id, agency_escorts_profile.agency_id, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, agency_escorts_profile.dob) ), '%y Years') AS age, agency_escorts_profile.name, agency_escorts_profile.height,"
                            . " agency_escorts_profile.eye_color, agency_escorts_profile.mobile_number, agency_escorts_profile.skin_color, agency_escorts_profile.hair_color, agency_escorts_profile.bust, agency_escorts_profile.weight, agency_escorts_profile.hips, "
                            . "agency_escorts_profile.hobbies, agency_escorts_profile.occuption, agency_escorts_profile.smoker, agency_escorts_profile.drink, agency_escorts_profile.about_me, agency_escorts_profile.escort_type_id, escorts_image_list.original_image, escorts_type.escort_type, '2' as 'escart_is', agency_escorts_profile.waist";
                    $agency_arr = $this->agency_model->getAgencyEscortsCount($agency_select, $agency_where, true);
                }
            } else {
                $ind_select = "users.id as escort_id, users.mobile_no,individual_escorts_profile.dob, individual_escorts_profile.height, individual_escorts_profile.eye_color, individual_escorts_profile.skin_color, individual_escorts_profile.hair_color, individual_escorts_profile.bust,"
                        . " individual_escorts_profile.weight, individual_escorts_profile.waist, individual_escorts_profile.hips, individual_escorts_profile.hobbies, individual_escorts_profile.occupation, individual_escorts_profile.smoker, individual_escorts_profile.drink,"
                        . " individual_escorts_profile.country_id, individual_escorts_profile.city_id, individual_escorts_profile.address, individual_escorts_profile.pincode_id, individual_escorts_profile.full_name as name, individual_escorts_profile.about_me, cities.city_name, individual_escorts_profile.is_active,"
                        . "escorts_type.escort_type, pincode_list.pincode, escorts_image_list.original_image, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, individual_escorts_profile.dob) ), '%y Years') AS age, country.country_name, users.user_type as escart_is";
                $indipendent_arr = $this->surgery_model->getIndependentEscortsList($ind_select, $inde_where, true);

                $agency_select = "agency_escorts_profile.id as escort_id, agency_escorts_profile.agency_id, DATE_FORMAT( FROM_DAYS( DATEDIFF(CURRENT_DATE, agency_escorts_profile.dob) ), '%y Years') AS age, agency_escorts_profile.name, agency_escorts_profile.height,"
                        . " agency_escorts_profile.eye_color, agency_escorts_profile.mobile_number, agency_escorts_profile.skin_color, agency_escorts_profile.hair_color, agency_escorts_profile.bust, agency_escorts_profile.weight, agency_escorts_profile.hips, "
                        . "agency_escorts_profile.hobbies, agency_escorts_profile.occuption, agency_escorts_profile.smoker, agency_escorts_profile.drink, agency_escorts_profile.about_me, agency_escorts_profile.escort_type_id, escorts_image_list.original_image, escorts_type.escort_type, '2' as 'escart_is', agency_escorts_profile.waist";
                $agency_arr = $this->agency_model->getAgencyEscortsCount($agency_select, $agency_where, true);
                $data['category'] = '';
            }
            
            $data['escorts_lists'] = $this->array_interlace($indipendent_arr, $agency_arr);
        }
        
      $data['profile_type_list'] = $this->surgery_model->getEscortsTypeList("escorts_type.id, escorts_type.escort_type", array("escorts_type.is_active" => 1));
       
//        print_r($data['escorts_lists']);
//        print_r($agency_where);
//             
//             print_r($wisecurrency);
//             
//        die();
//       
        




        
        $this->load->view('website/header');
        $this->load->view('website/escorts_advance_search', $data);
        $this->load->view('website/footer');
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
            'userType' => $data['user_type'],
            'link_access'=> $data['link_access']                
        );

        $this->session->set_userdata($userSession);
    }
    
    function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    /*
     * @dynamic routing
     */
    
    function getSlug() {
        $slug = $this->uri->segment(1);
        echo 'testing';
    }

function testing(){
  
$to = "gorakhnath1992@gmail.com";
$subject = "My subject";
$txt = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";
$headers = "From: gorakhnath1992@gmail.com" . "\r\n" .
"CC: gorakhnath1992@gmail.com";

mail($to,$subject,$txt,$headers);

}

}
