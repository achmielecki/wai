<?php
require_once 'business.php';



function photos(&$model)
{

    $_SESSION['f1'] = False;
    $_SESSION['f2'] = False;
    $db = get_db();
    $photos= get_photos();

    $model['pageSize']=3;
    $model['count'] = count($photos);
    $model['maxpage'] =  ($model['count']/3);
    if(!is_int($model['maxpage'])){
        $model['maxpage'] = (integer) ($model['count']/3) +1;
    }
    if($model['maxpage'] <5){

        $model['maxpage'] =5;
    }
    if(empty($model['count'])){
        $model['count'] = 0;
    }

    if(isset($_GET['page'])){
        $model['page'] = $_GET['page'];
        while($model['page']>$model['maxpage'] ){
            $model['page']--;
        }
        if($model['page']<1){
            $model['page']=1;
        }
    }else{
        $model['page']=1;
    }

    while($model['count'] < ($model['page'] -1)*$model['pageSize'] ){
        $model['page']--;
    }

    $model['menu1']=$model['page'];
    $model['menu5']=$model['maxpage'];
    $model['menu4']=$model['page']+3;
    while($model['menu4']>=$model['menu5']){
        $model['menu4']--;
    }

    $model['menu3']=$model['page']+2;
    while($model['menu3']>=$model['menu4']){
        $model['menu3']--;}

    $model['menu2']=$model['page']+1;
    while($model['menu2']>=$model['menu3']){
        $model['menu2']--;
    }
    while($model['menu1']>=$model['menu2']){
        $model['menu1']--;
    }

    $model['opts'] = [
        'skip' => ($model['page'] -1)*$model['pageSize'],
        'limit' => $model['pageSize']
    ];
    $photos= $db->photos->find([],$model['opts']);
    $model['photos'] = $photos;
    $otos = $db->photos->find([],$model['opts']);

    foreach($otos as $oto)
    {
        $name = (string) $oto['_id'];
        if(isset($_POST[$name]))
        $_SESSION[$name]=true;
    }

    return 'photos_view';
}
function main(&$model)
{
    return 'main_view';
}
function arr(&$model){
    return 'arr_view';
}
function search(&$model){


    if (isset($_POST['search']) ) {
        $db = get_db();
        $search = array();

        $query = [
            'tytul' => $_POST['search']
        ];
        $photos = get_photos();
        foreach ($photos as $photo){
            if(strpos($photo['tytul'],$_POST['search']) !== false)
                array_push($search,$photo);
        }
        $model['search'] = $search;
        return 'partial/searchp_view';
    }
    return 'search_view';
}
function fav(&$model){
    $db = get_db();
    $photos = get_photos();
    $fav = array();

    foreach ($photos as $photo){
        if(isset($_SESSION[(string)$photo['_id']])){
           array_push($fav, $photo);
            $name = (string) $photo['_id'];
            if(isset($_POST[$name]))
                unset($_SESSION[$name]);
        }
    }
    $model['fav'] = $fav;
    if($_SERVER['REQUEST_METHOD'] === 'POST') return 'redirect:fav';
    return 'fav_view';
}
function gallery(&$model)
{
    return 'gallery_view';
}
function usa(&$model)
{
    return 'gal/usa_view';
}
function zsrr(&$model)
{
    return 'gal/zsrr_view';
}
function ger(&$model)
{
    return 'gal/ger_view';
}
function delete_collection(&$model){
            deleteColl();
    $photos = get_photos();
    $model['photos'] = $photos;
    return photos($model);
}
function delete(&$model){
    if (!empty($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
            delete_photo($id);
            return 'redirect:photos';
    }
    http_response_code(404);
    exit;
}
function edit(&$model)
{
    $photo = [
        'tytul' => null,
        'autor' => null,
        'znakwodny' => null,
        '_id' => null,
        'ext' => null
    ];
    $_SESSION['f1'] = False;
    $_SESSION['f2'] = False;
    if($_SERVER['REQUEST_METHOD'] === 'POST')  {
        if(!empty($_POST['znakwodny'])){

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = @finfo_file($finfo, (string) $_FILES['zdjecie']['tmp_name'])?: null;
            if (!($mime_type === 'image/jpg') && !($mime_type === 'image/png') && !($mime_type === 'image/jpeg')) { $_SESSION['f2']= true;}
            $path = $_FILES['zdjecie']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if(filesize($_FILES['zdjecie']['tmp_name']) > 1048576) { $_SESSION['f1'] = True; }
            if($_SESSION['f1'] || $_SESSION['f2']){  return 'edit_view'; }
            $id = isset($POST['id']) ? $_POST['id'] : null;
        $photo = [
            'tytul' => $_POST['tytul'],
            'autor' => $_POST['autor'],
            'znakwodny' => $_POST['znakwodny'],
            'ext' => $ext,
        ];

        if(save_photo($id,$photo)){
            return 'redirect:edit';
        }
         }else{
            exit;
        }
    }
    $model['photo'] = $photo;

    return 'edit_view';
}
function photo(&$model)
{
    $model['id'] = $_GET['id'];

    return 'photo_view';
}
function login(&$model){

    $model['f4']= false;
    if($_SERVER['REQUEST_METHOD'] != 'POST') return 'partial/login_view';
    if(!isset($_POST['pass'])) return'partial/login_view';
    $db = get_db();
    $pass = $_POST['pass'];
    $login = $_POST['login'];

    $user = $db->users->findOne(['login' => $login]);
    if($user !== null &&
        password_verify($pass, $user['password'])){
        $_SESSION['user_id'] = $user['_id'];
        return 'partial/logout_view';

    }
    $model['f4']= true;
    return 'partial/login_view';
}
function register(&$model){
    $db = get_db();
    $model['f3']= false;
    $model['f5']= false;
    if($_SERVER['REQUEST_METHOD'] != 'POST') return 'register_view';

    $pass = $_POST['pass'];
    $passrep = $_POST['passrep'];
    $login = $_POST['login'];
    $email = $_POST['email'];
    if($pass!=$passrep){
        $model['f3']= true;
        return 'register_view';
    }
    if(!reguser($login,$pass,$email)) {
        $model['f5']= true;
        return 'register_view';
    }

    return 'redirect:main';
}
function logout(&$model){
    if($_SERVER['REQUEST_METHOD'] != 'POST'){session_destroy(); $_SERVER['REQUEST_METHOD'] = 'GET'; return 'redirect:main';}

    return 'partial/logout_view';
}