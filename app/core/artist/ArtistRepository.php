<?php

namespace App\core\artist;

use Illuminate\Support\Facades\Auth;
use App\Models\TimeTable;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ArtistRepository implements ArtistInterface
{
    public function getAllArtist()
    {
       
        if(Auth::guard('admins')->check()){
            return User::whereNotIn('id', [1])->where('type', 'artist')->orderBy('id', 'DESC')->get();
        }else{
            return User::whereNotIn('id', [1])->where('type', 'artist')->where('created_by', Auth::guard('sales')->id())->orderBy('id', 'DESC')->get();
        }
        
    }

    public function storeArtistData(array $data, $timeData)
    {
        if (isset($data['profile_image']) && $data['profile_image'] != null) {
            $content_db = time() . rand(0000, 9999) . "." . $data['profile_image']->getClientOriginalExtension();
            $data['profile_image']->storeAs("public/ProfileImage", $content_db);
            $data['profile_image'] = $content_db;
        }

        if (isset($data['banner_image']) && $data['banner_image'] != null) {
            $content_ban = time() . rand(0000, 9999) . "." . $data['banner_image']->getClientOriginalExtension();
            $data['banner_image']->storeAs("public/BannerImage", $content_ban);
            $data['banner_image'] = $content_ban;
        }
        $data['password'] = Hash::make($data['password']);
        
        if(Auth::guard('admins')->check()){
            $data['created_by'] = 0;
        }else{
            $data['created_by'] = Auth::guard('sales')->id();
        }

        $user = User::create($data);

        //Create default timeslots data in time slot table
        $timeData = [
            "user_id" => $user->id,
            "sunday_from" => "09:00",
            "sunday_to" => "17:00",
            "monday_from" => "09:00",
            "monday_to" => "17:00",
            "tuesday_from" => "09:00",
            "tuesday_to" => "17:00",
            "wednesday_from" => "09:00",
            "wednesday_to" => "17:00",
            "thrusday_from" => "09:00",
            "thrusday_to" => "17:00",
            "friday_from" => "09:00",
            "friday_to" => "17:00",
            "saterday_from" => "09:00",
            "saterday_to" => "17:00",
        ];

        return TimeTable::create($timeData);
    }

    public function getSingleArtist($id)
    {
        $find =  User::with('artworks', 'artworks.views', 'artworks.likes',  'artworks.comments', 'timeData', 'bannerImages')->where('id', $id)->first();
        if ($find) {
            return $find;
        } else {
            return 'Not Found';
        }
    }

    public function updateArtist($data, $id, $timeData, $close)
    {
        //dd($data);
        $find =  User::where('id', $id)->first();
        if ($find) {
          
                 $check_if_time =  TimeTable::where('user_id', $id)->first();
                 if($check_if_time) {
                    if(isset($close['tuesday_close']) && $close['tuesday_close'] == "on"){
                        $timeData['tuesday_from'] ="00:00";
                        $timeData['tuesday_to'] ="00:00";
                    }

                    if(isset($close['friday_close']) && $close['friday_close'] == "on"){
                        $timeData['friday_from'] ="00:00";
                        $timeData['friday_to'] ="00:00";
                    }
                    if(isset($close['saterday_close']) && $close['saterday_close'] == "on"){
                        $timeData['saterday_from'] ="00:00";
                        $timeData['saterday_to'] ="00:00";
                    }
                    
                    if(isset($close['sunday_close']) && $close['sunday_close'] == "on"){
                        $timeData['sunday_from'] ="00:00";
                        $timeData['sunday_to'] ="00:00";
                    }

                    if(isset($close['monday_close']) && $close['monday_close'] == "on"){
                        $timeData['monday_from'] ="00:00";
                        $timeData['monday_to'] ="00:00";
                    }

                    if(isset($close['wednesday_close']) && $close['wednesday_close'] == "on"){
                        $timeData['wednesday_from'] ="00:00";
                        $timeData['wednesday_to'] ="00:00";
                    }
                    
                    if(isset($close['thrusday_close']) && $close['thrusday_close'] == "on"){
                        $timeData['thrusday_from'] ="00:00";
                        $timeData['thrusday_to'] ="00:00";
                    }

                    //dd($timeData);
                    
                    $check_if_time->update($timeData);
                 }else{
                    $timeData['user_id']= $id;
                    TimeTable::create($timeData);

                 }
            if (isset($data['profile_image']) && $data['profile_image'] != null) {
                File::delete(public_path("storage/ProfileImage/" . $find->profile_image));
                $content_db = time() . rand(0000, 9999) . "." . $data['profile_image']->getClientOriginalExtension();
                $data['profile_image']->storeAs("public/ProfileImage", $content_db);
                $data['profile_image'] = $content_db;
            }

            if (isset($data['banner_image']) && $data['banner_image'] != null) {
                File::delete(public_path("storage/ProfileImage/" . $find->banner_image));
                $content_ban = time() . rand(0000, 9999) . "." . $data['banner_image']->getClientOriginalExtension();
                $data['banner_image']->storeAs("public/BannerImage", $content_ban);
                $data['banner_image'] = $content_ban;
            }
            if (isset($data['password']) && $data['password'] != null) {
                $data['password'] = Hash::make($data['password']);
            }else{
                $data['password'] = $find->password;
            }
            return $find->update($data);
        }else{
            return 'No data';
        }
    }


    public function deleteArtist($id){
        $find =  User::where('id', $id)->first();
        if($find) {
            foreach($find->artworks as $art){
                $art->delete();
            }

            foreach($find->bannerImages as $bannerImage){
                $bannerImage->delete();
            }
            
            return $find->delete();
        }
        return 'not found';
    }
}
