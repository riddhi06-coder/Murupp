<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\BannerDetails;
use App\Models\NewArrival;
use App\Models\CollectionDetail;
use App\Models\ShopCategory;
use App\Models\ProductPolicy;
use App\Models\Testimonial;
use App\Models\SocialMedia;
use App\Models\Footer;
use App\Models\Wishlist;
use App\Models\About;

class HomeController extends Controller
{

    // === Home
    public function home(Request $request)
    {
        // $banners = BannerDetails::whereNull('deleted_at')->orderBy('created_at', 'asc')->get();

        $banners = BannerDetails::whereNull('banner_details.deleted_at')
                    ->leftJoin('master_collections', 'banner_details.banner_heading', '=', 'master_collections.collection_name')
                    ->orderBy('banner_details.created_at', 'asc')
                    ->select('banner_details.*', 'master_collections.slug')
                    ->get();


        $newArrivals = NewArrival::whereNull('new_arrivals.deleted_at')
                                ->leftJoin('product_details', 'product_details.id', '=', 'new_arrivals.product_name') 
                                ->leftJoin('master_collections', 'master_collections.id', '=', 'product_details.collection_id') 
                                ->select(
                                    'new_arrivals.*', 
                                    'product_details.id as product_id', 
                                    'product_details.product_name', 
                                    'product_details.slug as product_slug',
                                    'master_collections.id as collection_id', 
                                    'master_collections.slug as collection_slug' 
                                )
                                ->orderBy('new_arrivals.created_at', 'asc')
                                ->get();

    
        $collectionDetail = CollectionDetail::whereNull('deleted_at')->orderBy('created_at', 'asc')->first(); 
        $productPolicies = ProductPolicy::whereNull('deleted_at')->orderBy('created_at', 'asc')->get(); 
        $testimonials = Testimonial::whereNull('deleted_at')->orderBy('created_at', 'asc')->get(); 
        $socialMedia = SocialMedia::whereNull('deleted_at')->orderBy('created_at', 'asc')->first(); 

        $shopCategories = DB::table('home_shop_category')
                        ->whereNull('home_shop_category.deleted_at')
                        ->leftJoin('master_product_category', 'master_product_category.id', '=', 'home_shop_category.image_title')
                        ->select(
                            'home_shop_category.*',
                            'master_product_category.slug',
                            'master_product_category.category_name'
                        )
                        ->orderBy('home_shop_category.created_at', 'asc')
                        ->get();

        $user = auth()->user();
        $wishlistItems = collect(); 
        
        if ($user) {
            $wishlistItems = Wishlist::where('user_id', $user->id)->pluck('product_id');
        }
                        

        return view('frontend.index', compact('banners','newArrivals','collectionDetail','shopCategories','productPolicies','testimonials','socialMedia','wishlistItems','user'));
    }

    // === About Us
    public function about_us(Request $request)
    { 
        $terms = About::whereNull('deleted_by')->get();
        return view('frontend.about_us', compact('terms'));
    }


    // === Thank you
    public function thankyou(Request $request)
    {
        
        return view('frontend.thankyou');
    }
    

    // === Contact Us
    public function contact(Request $request)
    {
        return view('frontend.contact');

    }

    // === For Contact Us form submission
    public function contact_form(Request $request)
    {

        $request->validate([
            'name'    => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'], 
            'email'   => 'required|email', 
            'message' => 'required|string',
        ], [
            'name.regex'  => 'The name must not contain special characters or numbers.',
        ]);
    
        $emailData = [
            'name'    => $request->name,
            'email'   => $request->email,
            'message' => $request->message,
        ];

        Mail::send('frontend.contact-us-mail', ['emailData' => $emailData], function ($message) use ($request, $emailData) {
            $subject = "Contact Details " . ($emailData['name'] ?? 'name');
            $message->to('riddhi@matrixbricks.com')
                    ->cc('shweta@matrixbricks.com')
                    ->subject($subject);
        });
    
        
        
        return redirect()->route('thank.you');
    }

}