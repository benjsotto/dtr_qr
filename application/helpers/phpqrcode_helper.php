<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function phpqr($idno,$level='L',$size=4) {

	require_once(APPPATH . 'helpers/phpqrcode/qrlib.php');

        $target_path = 'assets/images/qrcodes'; // Relative to the root

        if(!is_dir($target_path)){
            mkdir($target_path,0755,TRUE);
        }
        
        $file_ext = 'png';
        $filename = $idno.'-qr';
		
        
        for($i=1;$i>0;$i++){
            
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $code = substr(str_shuffle($chars),0,3);
            
            if (file_exists($target_path . '/' . $filename.$code.'.'.$file_ext)){
            } else {
                $fileName2 = $filename.$code.'.'.$file_ext;
                break;
            }
        }
        
        
        QRcode::png($idno, $target_path.'/'.$fileName2, $level, $size, 2);  
        
        return $fileName2;


}