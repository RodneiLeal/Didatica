<?php
  include_once "../../loader.php";
  $crop = new CropAvatar(
    isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
    isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
    isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
  );

  $response = array(
    'state'  => 200,
    'message' => $crop -> getMsg(),
    'result' => str_replace('../', "", $crop -> getResult())
  );

  echo json_encode($response);
