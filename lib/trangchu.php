<?php
	function TinHotNhat_BaTin(){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			WHERE TinNoiBat=1
			ORDER BY idTin DESC 
			LIMIT 0,3
		";
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}

	function Generate_TenLoaiTin($idLT)
	{
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM loaitin 
			WHERE idLT=$idLT
		";	
		
		$result = mysqli_query($conn, $qr);
		return mysqli_fetch_array($result);
	}

	function TinMoiNhat_BaTin($runner){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			WHERE TinNoiBat=0
			ORDER BY idTin DESC
			LIMIT $runner ,3
		";	
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}
	function TinMoiNhat_10tin(){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			ORDER BY idTin DESC
			LIMIT 2,10
		";	
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}

	function TinMoiNhat_TheoTheLoai_10tin($idTL){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			WHERE tin.idTL = $idTL
			ORDER BY idTin DESC
			LIMIT 0,10
		";	
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}


	
	function TinMoiNhat_TheoTheLoai($idTL){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			WHERE tin.idTL = $idTL
			ORDER BY idTin DESC
			LIMIT 0,30
		";	
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}
	function view_TenTheLoai($idTL)
	{
		$conn = myConnect();
		$qr = 
		"	
			SELECT * from theloai
			where idTL = $idTL
		"
		;
		$result = mysqli_query($conn, $qr);
		return mysqli_fetch_array($result);

	}
	
	function TinXemNhieuNhat($runner){
		$conn 	= myConnect();
		$qr 	= "
			SELECT * FROM tin
			ORDER BY SoLanXem DESC
			LIMIT $runner,6
		";
		$result = mysqli_query($conn, $qr);
		return $result;

		}



	function TinMoiNhat_TheoLoaiTin_MotTin($idLT){
		
		$conn  	= myConnect();
		$qr 	= "
			SELECT * FROM tin 
			WHERE idLT = $idLT
			ORDER BY idTin DESC
			LIMIT 0,1
		";
		
		$result = mysqli_query($conn, $qr);
		return $result;
		
	}
	function TinMoiNhat_TheoLoaiTin_BonTin($idLT){
		$conn 	= myConnect();
		$qr 	= "
			SELECT * FROM tin
			WHERE idLT = $idLT
			ORDER BY idTin DESC
			LIMIT 1,6
		";
		$result = mysqli_query($conn, $qr);
		return $result;
	}
	
	function TenLoaiTin($idLT)
	{
		$conn = myConnect();
		$qr = "SELECT Ten From loaitin
		where idLT = $idLT"
		;
		$loaitin = mysqli_query($conn,$qr);
		$row = mysqli_fetch_array($loaitin);
		return $row['Ten'];
	}


	
	function QuangCao($vitri)
	{
		$conn = myConnect();
		$qr = "
		Select * from quangcao
		where vitri = $vitri
		";
		return mysqli_query($conn,$qr);
	}
	
	function DanhSachTheLoai()
	{
		$conn = myConnect();
		$qr = "
		select * from theloai
		";
		return mysqli_query($conn,$qr);
	}
	function DanhSachTheLoai1()
	{
		$conn = myConnect();
		$qr = "
		select * from theloai
		limit 0,4
		";
		return mysqli_query($conn,$qr);
	}
	function DanhSachTheLoai2()
	{
		$conn = myConnect();
		$qr = "
		select * from theloai
		limit 5,10
		";
		return mysqli_query($conn,$qr);
	}

	function DanhSachLoaiTin_Theo_TheLoai($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from loaitin
		where idTL =$idTL
	";
	return mysqli_query($conn,$qr);
	}

	function DanhSachLoaiTin_Theo_TheLoai1($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from loaitin
		where idTL =$idTL
		limit 0,4
	";
	return mysqli_query($conn,$qr);
	}

	function DanhSachLoaiTin_Theo_TheLoai2($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from loaitin
		where idTL =$idTL
		limit 5,10
	";
	return mysqli_query($conn,$qr);
	}

	function TinTheoTheLoai($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idTL =$idTL
		order by idTin DESC
	";
	return mysqli_query($conn,$qr);
	}
	
	function TinTheoLoaiTin ($idLT)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idLT =$idLT
		order by idTin DESC
	";
	
	return mysqli_query($conn,$qr);
	}
	
	function TinTheoLoaiTin_PhanTrang ($idLT,$from, $sotin1trang)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idLT =$idLT
		order by idTin DESC
		LIMIT $from , $sotin1trang
	";
	
	return mysqli_query($conn,$qr);
	}
	
	function breadCrumb($idLT)
	{$conn = myConnect();
		$qr = "
		select TenTL, Ten 
		from theloai, loaitin
		where theloai.idTL = loaitin.idTL
		and idLT =$idLT
		";
		return mysqli_query($conn,$qr);
	}
	
	function TinMoi_BenTrai($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idTL = $idTL
		order by idTin desc
		limit 0,1
		";
		return mysqli_query($conn,$qr);
	}
	
	function TinMoi_BenPhai($idTL)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idTL = $idTL
		order by idTin desc
		limit 1,2
		";
		return mysqli_query($conn,$qr);
	}
	
	function ChiTietTin($idTin)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idTin = $idTin
				";
		return mysqli_query($conn,$qr);
	}
	
	function TinCungLoaiTin($idTin,$idLT)
	{
		$conn = myConnect();
		$qr = "
		select * from tin
		where idTin <> $idTin
		and idLT = $idLT
		order by rand()
		limit 0,4
				";
		return mysqli_query($conn,$qr);
	}

	function viewTacGia($idUser)
	{
		$conn = myConnect();
		$qr = "
		select * from users
		where users.idUser = $idUser
				";
		$result =  mysqli_query($conn,$qr);
		return mysqli_fetch_array($result);
	}
	
	function CapNhatSoLanXemTin($idTin){
		$conn	= myConnect();
		$qr 	= "
			UPDATE tin
			SET SoLanXem = SoLanXem + 1
			WHERE idTin = $idTin;
		";
		$result = mysqli_query($conn, $qr);
	}	
	function TimKiem($tukhoa,$runner)
	{
		$conn	= myConnect();
		$qr 	= "
				select * from tin
				where TieuDe REGEXP '$tukhoa'
				order by idTin desc
				limit $runner,3
					";
		return mysqli_query($conn, $qr);
	}
	
	function viewComment($idTin)
	{
		$conn	= myConnect();
		$qr 	= "
			select * from comment
			where comment.idTin=$idTin
			order by datetime desc
		";
		$result = mysqli_query($conn, $qr);
		return $result;
	}
	
?>