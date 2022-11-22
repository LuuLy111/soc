<? 
// Lyyyyy

	
	$post = array(
		'id'=>''
		,'created_at'=>''
		,'canceled'=>'0'
	);
	$result = array(
		'success' => '0'
		,'notifi' => ''
	);
	
	$post['id'] = $_POST['email'];
	
	// Lấy dữ liệu nhập
	foreach($_POST as $k=>$v){
		if(isset($post[$k])){
			$post[$k] = trim($v);
		}
	}

	// Kiểm tra dữ liệu
	if($post['id']==''){
		$result['notifi'] = lang('Email không được để trống.');
	}elseif(!filter_var($post['id'],FILTER_VALIDATE_EMAIL)){
		$result['notifi'] = lang('Email không đúng.');
	}elseif(zfooter_email_exists($post['id'])){
		$result['notifi'] = lang('Email đã được theo dõi.');
	}
	
	if($result['notifi']){	// Nếu có lỗi
		
		
	}else{ 
		// Lấy ngày giờ hiện tại
		$post['created_at'] = time(); 
		if(!zfooter_insert($post)){  
			$result['notifi'] = lang('Lỗi từ server, vui lòng thử lại.');
		}else{ 
			$result['success'] = 1;
			$result['notifi'] = lang('Đăng ký nhận tin thành công!');
		}
	}	
	
	// Xuất ra kết quả
	header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json');
	echo json_encode($result);
	exit;
}




	
/*
| ------------------------------------------------------------------------------------------------------------------------ *
| //! Danh sách ngôn ngữ
| ------------------------------------------------------------------------------------------------------------------------ *
*/	

// Danh sách ngôn ngữ của web
$langList = $soc->lang->getList();





/*
| ------------------------------------------------------------------------------------------------------------------------ *
| //! Lấy dữ liệu 
| ------------------------------------------------------------------------------------------------------------------------ *
*/

$cats = $soc->db->redi(120, "SELECT `id`,`icon`,`name`, `display_type`, `inside`,`translate` FROM `menu` WHERE `show`='1' ORDER BY   `inside` ASC,`order` ASC");
$article = $soc->db->redi(120, "SELECT * FROM `fixed_content` WHERE `show`='1' ORDER BY `updated_at` DESC"); 
