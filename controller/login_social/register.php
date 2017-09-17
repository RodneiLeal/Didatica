<?php
class User {
    
     function checkUser($oauth_provider,$oauth_uid,$username,$email,$picture)
	 {
		include '../_db.php';
		
        if(!empty($oauth_provider)){
            // Check whether user data already exists in database
            $prevQuery = "SELECT * FROM usuario WHERE usuario_rede_social = '".$oauth_provider."' AND usuario_rede_social_id = '".$oauth_uid."'";
            $prevResult = mysqli_fetch_assoc(mysqli_query($mysqli,$prevQuery));
			
            if(!empty($prevResult['usuario_id']))
			{
                // Update user data if already exists
                $query = "UPDATE usuario SET usuario_nome = '".$username."', usuario_email = '".$email."', usuario_foto = '".$picture."'  WHERE usuario_rede_social = '".$oauth_provider."' AND usuario_rede_social_id = '".$oauth_uid."'";
                $update =  mysqli_query($mysqli, $query);
				
				$_SESSION['usuarioID'] = $prevResult['usuario_id'];
            }else{
                // Insert user data
				$new_pass= md5($oauth_uid.'_'.date("s"));
                $query = "INSERT INTO usuario SET usuario_rede_social = '".$oauth_provider."', usuario_rede_social_id = '".$oauth_uid."', usuario_nome = '".$username."', usuario_email = '".$email."',usuario_pass = '".$new_pass."', usuario_foto = '".$picture."', usuario_tipo=1, usuario_data_cadastro = '".date("Y-m-d H:i:s")."', usuario_ativo=1";
                $insert = mysqli_query($mysqli,$query);
				
				$_SESSION['usuarioID'] = mysqli_insert_id($mysqli);
            }
            
            // Get user data from the database
            $userData = mysqli_fetch_assoc(mysqli_query($mysqli,$prevQuery));
         }
        
        // Return user data
        return $userData;
    }
}
?>