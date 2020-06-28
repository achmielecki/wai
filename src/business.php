<?php


use MongoDB\BSON\ObjectID;


function get_db()
{
    $mongo = new MongoDB\Client(
        "mongodb://localhost:27017/wai",
        [
            'username' => 'wai_web',
            'password' => 'w@i_w3b',
        ]);

    $db = $mongo->wai;

    return $db;
}

function get_photos()
{
    $db = get_db();
    return $db->photos->find()->toArray();
}

function get_photo($id)
{
    $db = get_db();
    return $db->photos->findOne(['_id' => new ObjectID($id)]);
}

function save_photo($id, $photo)
{
    $db = get_db();
    if ($id == null) {
        $insertResult = $db->photos->insertOne($photo);
    } else {
        $insertResult = $db->photos->replaceOne(['_id' => new ObjectID($id)], $photo);
    }
    $name = $insertResult->getInsertedId();
    $znakwodny = $photo['znakwodny'];
    save_file($name,$znakwodny);
    return true;

}
function deleteColl()
{
    $db= get_db();
    $db->photos->drop();
    $files = glob('/var/www/dev/src/web/upload/*'); // get all file names
    foreach($files as $file){
        if(is_file($file))
            unlink($file);
    }
    return;
}
function delete_photo($id){
    $db = get_db();
    $ext = $db->photos->findOne(['_id' => new ObjectID($id)])['ext'];
    $db->photos->deleteOne(['_id' => new ObjectId($id)]);
    unlink('/var/www/dev/src/web/upload/'.$id.'.'.$ext);
}
function save_file($id,$znakwodny){
    $upload_dir = '/var/www/dev/src/web/upload/';

    $file = $_FILES['zdjecie'];
    $file_name = $id;
    $path = $_FILES['zdjecie']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);

    $target = $upload_dir . $file_name.'.'. $ext;
    $tmp_path = $file['tmp_name'];


    move_uploaded_file($tmp_path,$target);


    $image = scaleImageFileToBlob($target);
    $upload_dir = '/var/www/dev/src/web/upload/'. $file_name.'_thumb'.'.'. $ext;
    file_put_contents($upload_dir,$image);

    $image = addWatermark($target,$znakwodny,$file_name);
    $upload_dir = '/var/www/dev/src/web/upload/'. $file_name.'_watermark'.'.png';
    file_put_contents($upload_dir,$image);


}
function scaleImageFileToBlob($file) {

    $source_pic = $file;
    $max_width = 200;
    $max_height = 125;

    list($width, $height, $image_type) = getimagesize($file);

    switch ($image_type)
    {
        case 1: $src = imagecreatefromgif($file); break;
        case 2: $src = imagecreatefromjpeg($file);  break;
        case 3: $src = imagecreatefrompng($file); break;
        default: return '';  break;
    }
    $tn_height = $max_height;
    $tn_width = $max_width;
    $tmp = imagecreatetruecolor($tn_width,$tn_height);

    /* Check if this image is PNG or GIF, then set if Transparent*/
    if(($image_type == 1) OR ($image_type==3))
    {
        imagealphablending($tmp, false);
        imagesavealpha($tmp,true);
        $transparent = imagecolorallocatealpha($tmp, 255, 255, 255, 127);
        imagefilledrectangle($tmp, 0, 0, $tn_width, $tn_height, $transparent);
    }
    imagecopyresampled($tmp,$src,0,0,0,0,$tn_width, $tn_height,$width,$height);

    ob_start();

    switch ($image_type)
    {
        case 1: imagegif($tmp); break;
        case 2: imagejpeg($tmp, NULL, 100);  break; // best quality
        case 3: imagepng($tmp, NULL, 0); break; // no compression
        default: echo ''; break;
    }

    $final_image = ob_get_contents();

    ob_end_clean();

    return $final_image;
}
function addWatermark($file,$znakwodny,$filename){
    list($width, $height, $image_type) = getimagesize($file);

    switch ($image_type)
    {
        case 1: $im = imagecreatefromgif($file); break;
        case 2: $im = imagecreatefromjpeg($file);  break;
        case 3: $im = imagecreatefrompng($file); break;
        default: return '';  break;
    }

    $stamp = imagecreatetruecolor(100, 70);
    imagefilledrectangle($stamp, 0, 0, 99, 69, 0x0000FF);
    imagefilledrectangle($stamp, 9, 9, 90, 60, 0xFFFFFF);
    imagestring($stamp, 5, 20, 20, $znakwodny, 0x0000FF);

    $marge_right = 10;
    $marge_bottom = 10;
    $sx = imagesx($stamp);
    $sy = imagesy($stamp);

    imagecopymerge($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp), 50);

    ob_start();
    imagepng($im, NULL,0);
   $final_image = ob_get_contents();
    ob_end_clean();


    return $final_image;

}
function reguser($login,$pass,$email){
    $db=get_db();
    $hash = password_hash($pass, PASSWORD_DEFAULT);
    $users = $db ->users;
    $user = $db->users->findOne(['login' => $login]);

    if($user !== null){
        return false;
    }
    $db->users->insertOne([
        'login' => $login,
        'password' => $hash,
        'email' => $email
    ]);
    return true;
}
