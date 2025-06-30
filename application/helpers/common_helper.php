<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**** Image Upload Function ****/
if (!function_exists('upload_file')) {
    function upload_file($field_name, $upload_path, $allowed_types = 'jpg|jpeg|png|txt', $max_size = 3072)
    {
		
        $CI =& get_instance();
        $CI->load->library('upload'); 
        $config['upload_path'] = $upload_path; 
        $config['allowed_types'] = $allowed_types; 
        $config['max_size'] = $max_size; 

        $CI->upload->initialize($config);

        if (!empty($_FILES[$field_name]['name'])) {
			//log_message('error', 'Helper function reached: ' . json_encode($_FILES));
            if ($CI->upload->do_upload($field_name)) {
                return [
                    'status' => true,
                    'file_path' => $upload_path . $CI->upload->data('file_name'),
                    'file_data' => $CI->upload->data()
                ];
            } else {
                return [
                    'status' => false,
                    'error' => $CI->upload->display_errors()
                ];
            }
        }
        return [
            'status' => false,
            'error' => 'No file uploaded.'
        ];
    }
}

### PRINTR FUNCTION ###
	if(!function_exists('pr')){
		function pr($array){
			echo "<pre>";
			print_r($array);
			exit;
		}
	}
?>