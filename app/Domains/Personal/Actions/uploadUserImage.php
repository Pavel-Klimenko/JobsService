<?php
///**
// * Created by PhpStorm.
// * User: pavel
// * Date: 14/05/23
// * Time: 23:58
// */
//
//namespace App\Containers\Personal\Actions;
//
//use App\Constants;
//use App\Models\User;
//use App\Ship\Helpers\Helper;
//
//class uploadUserImage
//{
//    public function run($request) {
//
//        if (Helper::isCompany()) {
//            $imgPath = Constants::USER_IMAGE_FOLDERS['companies'];
//        } elseif (Helper::isCandidate()) {
//            $imgPath = Constants::USER_IMAGE_FOLDERS['candidates'];
//        }
//
//        $imageFullPath = $_SERVER['DOCUMENT_ROOT'].$imgPath;
//        $fileExtension = Helper::getExtension($_FILES["IMAGE"]["name"]);
//        $filename = uniqid() . '.' . $fileExtension;
//        move_uploaded_file($_FILES["IMAGE"]["tmp_name"], $imageFullPath.$filename);
//
//        $linkToImage = $imgPath.$filename;
//
//        $user = User::find(Auth::user()->id);
//        $user->IMAGE = $linkToImage;
//        $user->ACTIVE = 0;
//        $user->save();
//
//        //sending notification to admin
//        $date = (object) [
//            'entity' => 'user',
//            'message' =>  'User updated avatar',
//            'entity_id' => $user->id,
//        ];
//
//
//        return $date;
//    }
//}
