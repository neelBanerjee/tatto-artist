<?php
namespace App\core\banner;

use App\Models\BannerImage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BannerRepository implements BannerInterface {
    public function getAllBanners(){
        if(auth()->guard('artists')->check()){
            return BannerImage::where('user_id', auth()->guard('artists')->id())->with('artist')->orderBy('id', 'DESC')->get();
        }
        return BannerImage::with('artist')->orderBy('id', 'DESC')->get();
    }

    public function getArtistBanners(){
        $salespersonId = Auth::guard('sales')->id(); // Get the logged-in salesperson's ID

        $artists = User::where('created_by', $salespersonId)->get(); // Get all artists created by this salesperson

        $artworks = BannerImage::whereIn('user_id', $artists->pluck('id'))->paginate(5); 

        return $artworks;
    }

    public function storeBannerImage($data) {
        if (isset($data['banner_image']) && $data['banner_image'] != null) {
            $content_db = time().rand(0000, 9999) . "." . $data['banner_image']->getClientOriginalExtension();
            $data['banner_image']->storeAs("public/BannerImage", $content_db);
            $data['banner_image'] = $content_db;
        }
        return BannerImage::create($data);
    }

    public function deleteBannerImage($id) {
        $find =  BannerImage::where('id', $id)->first();
        if($find) {
            return $find->delete();
        }
        return 'not found';
    }
}