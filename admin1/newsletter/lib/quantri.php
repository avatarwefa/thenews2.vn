<?php

function DanhSachTheLoai()
{
	$conn = MyConnect();
	$qr = "select * from theloai
	order by idTL DESC
	";
	return mysqli_query($conn,$qr);
	
}

function ChiTietTheLoai($idTL)
{
	$conn = MyConnect();
	$qr = "select * from theloai 
	where idTL = '$idTL'";
	$row= mysqli_query($conn,$qr);
	return mysqli_fetch_array($row);
}

function DanhSachLoaiTin()
{
	$conn = MyConnect();
	$qr = "select * from loaitin,theloai
	where theloai.idTL = loaitin.idTL
	order by idLT DESC
	";
	return mysqli_query($conn,$qr);
}


function ChiTietLoaiTin($idLT)
{
	$conn = MyConnect();
	$qr = "select * from loaitin
	where idLT = '$idLT'
	";
	$loaitin = mysqli_query($conn,$qr);
	return mysqli_fetch_array($loaitin);
	
}

// Quản trị tin
function DanhSachTin()
{
	$conn = myConnect();
	$qr = " select tin.*,TenTL, Ten from tin, theloai, loaitin
	where tin.idTL = theloai.idTL
	and tin.idLT = loaitin.idLT
	order by idTin desc
	limit 0,20
	";
	return mysqli_query($conn,$qr);
	
}

function ChiTietTin($idTin){
		$conn 	= myConnect();
		$qr 	= "
			SELECT * FROM tin
			WHERE idTin = '$idTin'
		";
		$query 	= mysqli_query($conn, $qr);
		$result = mysqli_fetch_array($query);
		return $result;
			
	}

	//Quan tri quang cao
	function DanhSachQuangCao(){
		$conn 	= myConnect();
		$qr 	="
			SELECT * 
			FROM quangcao
			ORDER BY idQC DESC
			LIMIT 0,20
		";
		$result = mysqli_query($conn, $qr);
		return $result;
	
	}
	function ChiTietQuangCao($idQC){
		$conn 	= myConnect();
		$qr 	="
			SELECT * 
			FROM quangcao 
			WHERE idQC = '$idQC'
		";
		$query 	= mysqli_query($conn, $qr);
		$result = mysqli_fetch_array($query);
		return $result; 
	}
	



function stripUnicode($str){
	if(!$str) return false;
	$unicode = array(
		'a'=>'à|á|ả|ã|ạ|ă|ằ|ắ|ẳ|ẵ|ặ|â|ầ|ấ|ẩ|ẫ|ậ',
		'A'=>'À|Á|Ả|Ã|Ạ|Ă|Ằ|Ắ|Ẳ|Ẵ|Ặ|Â|Ầ|Ấ|Ẩ|Ẫ|Ậ',
		'd'=>'đ',
		'D'=>'Đ',
		'e'=>'è|é|ẻ|ẽ|ẹ|ê|ề|ế|ể|ễ|ệ',
		'E'=>'È|É|Ẻ|Ẽ|Ẹ|Ê|Ề|Ế|Ể|Ễ|Ệ',
		'i'=>'ì|í|ỉ|ĩ|ị',
		'I'=>'Ì|Í|Ỉ|Ĩ|Ị',
		'o'=>'ò|ó|ỏ|õ|ọ|ô|ồ|ố|ổ|Ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ợ',
		'O'=>'Ò|Ó|Ỏ|Õ|Ọ|Ô|Ồ|Ố|Ổ|Ỗ|Ộ|Ơ|Ờ|Ớ|Ở|Ỡ|Ợ',
		'u'=>'ù|ú|ủ|ũ|ụ|ư|ừ|ứ|ử|ữ|ự',
		'U'=>'Ù|Ú|Ủ|Ũ|Ụ|Ư|Ừ|Ứ|Ử|Ữ|Ự',
		'y'=>'ỳ|ý|ỷ|ỹ|ỵ',
		'Y'=>'Ỳ|Ý|Ỷ|Ỹ|Ỵ'
	);
	foreach($unicode as $khongdau=>$codau){
		$arr	= explode("|",$codau);
		$str 	= str_replace($arr,$khongdau, $str);
	}
	return $str;
}

function changeTitle($str){
	$str = trim($str);
	if($str=="") return "";
	$str = str_replace('"', '',$str);
	$str = str_replace("'", '',$str);
	$str = stripUnicode($str);
	$str = mb_convert_case($str, MB_CASE_TITLE, 'utf-8');
	
	//MB_CASE_UPPER / MB_CASE_TITLE/ MB_CASE_LOWER
	$str = str_replace(' ', '-', $str);
	$str = str_replace('/', '-', $str);
	return $str;
}

?>