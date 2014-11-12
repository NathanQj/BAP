<?php

class frontUserAccount
{
	private  $_login = "";
	private  $_pwd 	= "";
	private  $_email = "";
	private  $_firstname ="";
	private $_lastname = "";
	private $_max = 0xffffff;
	public  $list = array();
	public  $group = array();
	public function userAccount()
	{
	}

	public function getUserList($curpage=1, $qty=0xffffff, $param=false)
	{
		//return $list;
	}
	
	public function getUserListForThisGroup($groupId, $param=false)
	{
		//return $list;
	}	
	
	
	public function getUser($id)
	{
		//return array_map('utf8_encode',$row);
	}
	
	public function updateUser($id, $data)
	{
		
		return true; 
	}
	
	public function insertUser($data)
	{
		
		return true;
	}
	public function removeUser($id)
	{
		return ;
	}
	public function checkLogin()
	{
		$_SESSION['login'] = $this->login;
		$_SESSION['code'] = $this->pwd;
		return true;
	}
	public function accrediteAjaxExplorer()
	{
		
	} 
	private function checkUnicity($login, $pwd)
	{
		return true; // or false
	}
	public function checkUnicityFB($login)
	{
		
		return true; // or false
	}
	
	/**
	 * Gère l'upload de l'avatar
	 * @return string
	 */
	public static function uploadAvatar()
	{
		$result = array( 'success' => FALSE, 'name' => '', 'error' => NULL );
        if( isset( $_FILES['avatar_file']) && 0 == $_FILES['avatar_file']['error'] ) {

			$tmp_path = $_FILES[ 'avatar_file' ][ 'tmp_name' ];

			// S'il s'agit bien d'un fichier
			if ( !is_file( $tmp_path ) || !is_uploaded_file( $tmp_path ) ){
				$result['success'] = FALSE;
				unlink( $tmp_path );
				return $result;
			}

			$finfo = finfo_open( FILEINFO_MIME_TYPE );
			$mimetype = finfo_file( $finfo, $tmp_path );

			// Si le type mime n'est pas autorisé
			if ( !in_array( $mimetype, array( 'image/jpg', 'image/jpeg', 'image/gif', 'image/png' ) ) ) {
				$result['success'] = FALSE;
				$result['error'] = 'format_photo';
				unlink( $tmp_path );
				return $result;
			}
			
			// Prépare le nouveau nom
			$path_info = pathinfo( $_FILES['avatar_file']['tmp_name'] );
			$url_tmp = __PATH_AVATAR_TMP.'__'.$path_info['filename'];
			$url_file = $url_tmp . '.jpg';
			
			// Renomme et déplace le fichier
			if ( !copy( $tmp_path, __FRONT_PATH.$url_tmp ) ){
				$result['success'] = FALSE;
				unlink( $tmp_path );
				return $result;
			}
			
			// Crop l'image
			system("convert ".__FRONT_PATH.$url_tmp." -resize \"180x180^\" -alpha background -background transparent -gravity center -extent 180x180 ".__FRONT_PATH.$url_file, $output);
			
            // Si erreur, suppression de l'image originale
            if (!empty($output)){
				$result['success'] = FALSE;
				@unlink( __FRONT_PATH.$url_tmp );
				@unlink( __FRONT_PATH.$url_file );
				return $result;
            }
			
			// Supprime le fichier temporaire
			unlink( __FRONT_PATH.$url_tmp );
			
			// Renomme et déplace le fichier
			$url_file_final = __PATH_AVATAR.Helper::getUserId().'.jpg';
			$file_final = __FRONT_PATH.$url_file_final;
			if ( !copy( __FRONT_PATH.$url_file, $file_final ) ){
				$result['success'] = FALSE;
				unlink( $tmp_path );
				return $result;
			}
			
			// Supprime le fichier temporaire
			unlink( __FRONT_PATH.$url_file );
			
			// Result
			$result['name'] = $url_file_final.'?'.Helper::getToken();
			$result['success'] = TRUE;
        }
  		
		return $result;
	}
}

?>