<?php  



	/**
	 * File Uploading System 
	 */
	function fileUpload($file, $location = '', $file_type = ['jpg','png','gif','jpeg'], $size = 1024){

		// File informatuion 
		$file_name = $file['name'];
		$file_tmp_name = $file['tmp_name'];
		$file_size = $file['size'] / 1024 ;

		// file Extension 
		$file_array = explode('.', $file_name);
		$file_extension = strtolower(end($file_array));


		// Unique name 
		$unique = md5(time().rand()).'.'. $file_extension;

		// File size manage
		if ( $file_size >  $size ) {
			$file_size_check = false;
		}else {
			$file_size_check = true;
		}

		$mess = null;
		// File type check
		if ( in_array( $file_extension , $file_type) == false ) {
			$mess = '<p class=\'alert alert-danger\'>Invalid file formate ! <button class=\'close\' data-dismiss=\'alert\'>&times;</button></p>';
		}elseif( $file_size_check == false ){
			$mess = '<p class=\'alert alert-danger\'>File size is Large ! <button class=\'close\' data-dismiss=\'alert\'>&times;</button></p>';
		}else {
			// Upload image 
			move_uploaded_file( $file_tmp_name, $location . $unique);
		}


		// Return value 
		return [
			'file_name'		=> $unique,
			'mess'			=> $mess,
		];
		



	}





	/**
	 * Data Check 
	 */
	function dataCheck( $connection , $table, $col, $data ){


		// Data check
		$sql = "SELECT $col FROM $table WHERE $col='$data'";
		$email_data = $connection -> query($sql);
		$num_email =  $email_data -> num_rows ; 
		if ( $num_email > 0 ) {
			return false;
		}else {
			return  true;
		}
		


		

	}
