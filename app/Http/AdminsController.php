<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;

use Storage;

use Mail;

use Hash;

use Session;

use datetime;

use App\Models\Term;

use App\Models\Privacy;

use App\Models\Menu;

use App\Models\Gallery;

use App\Models\Admin;

use App\Models\User;

use App\Models\Page;

use App\Models\Slider;

use App\Models\Banner;

use App\Models\Page_Settings;

use App\Models\Message;

use App\Models\ReplyMessage;

use App\Models\Category;

use App\Models\SubCategory;

use App\Models\Product;

use App\Models\Services;

use App\Models\Portfolio;

use App\Models\Pricing;

use App\Models\Subscriber;

use App\Models\Update;

use App\Models\Payment;

use App\Models\Notifications;

use App\Models\Testimonial;

use App\Models\Service_Rendered;

use App\Models\Daily;

use App\Models\Blog;

use App\Models\Comment;

use App\Models\TraceServices;

use App\Models\Offer;

use App\Models\Review;

use App\Models\Coupon;

use App\Models\Discount;

use App\Models\orders;


class AdminsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //  Home Page
    public function index(){
        $Message = DB::table('messages')->where('status','0')->get();
        $Comments = DB::table('reviews')->where('status','0')->get();
        $page_title = 'Admin Home';
        $page_name = 'Admin Home';
        return view('admin.index',compact('page_title','page_name','Comments','Message'));
    }

    public function list(){
        $page_title = 'list';
        return view('admin.list',compact('page_title'));
    }

    public function form(){
        $page_title = 'form';
        return view('admin.form',compact('page_title'));
    }
    public function formfile(){
        $page_title = 'formfile';
        return view('admin.formfile',compact('page_title'));
    }
    public function formfiletext(){
        $page_title = 'formfiletext';
        return view('admin.formfiletext',compact('page_title'));
    }

    public function error403(){
        $page_title = 'Error';
        return view('admin.403',compact('page_title'));
    }

    public function error404(){
        $page_title = 'Error';
        return view('admin.404',compact('page_title'));
    }

    public function error405(){
        $page_title = 'Error';
        return view('admin.405',compact('page_title'));
    }

    public function error500(){
        $page_title = 'Error';
        return view('admin.500',compact('page_title'));
    }

    public function error503(){
        $page_title = 'Error';
        return view('admin.503',compact('page_title'));
    }


    public function under_construction(){
        $page_title = 'Website Is Under Construction';
        return view('admin.under_construction',compact('page_title'));
    }
    public function wizard(){
        $page_title = 'Wizard';
        return view('admin.wizard',compact('page_title'));
    }

    public function maps(){
        $page_title = 'Maps';
        $page_name = 'Maps';
        return view('admin.maps',compact('page_title','page_name'));
    }

    //sitesettings
    public function sitesettings(){
        $SiteSettings = DB::table('sitesettings')->get();
        $page_title = 'formfiletext';
        $page_name = 'Site Setting';
        return view('admin.sitesettings',compact('page_title','page_name','SiteSettings'));
    }

    public function savesitesettings(Request $request)
    {
        $path = 'uploads/logo';
        if(isset($request->logo)){
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $logo = $filename;
        }else{
            $logo = $request->logo_cheat;
        }
        $updateDetails = array(
            'sitename'=>$request->sitename,
            'logo'=>$logo,
            'email'=>$request->email,
            'email_one'=>$request->email_one,
            'mobile'=>$request->mobile,
            'mobile_one'=>$request->mobile_one,
            'mobile_two'=>$request->mobile_two,
            'tagline'=>$request->tagline,
            'url'=>$request->url,
            'location'=>$request->location,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'twitter'=>$request->twitter,
            'linkedin'=>$request->linkedin,
            'instagram'=>$request->instagram,
            'youtube'=>$request->youtube,
            'google'=>$request->google,
            'welcome'=>$request->welcome

        );
        DB::table('sitesettings')->update($updateDetails);
        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }
    public function copyright(){
        $Copyright = DB::table('copyright')->get();
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Copyright';
        return view('admin.copyright',compact('page_title','page_name','Copyright'));
    }
    public function edit_copyright(Request $request){
        $updateDetails = array(
            'content'=>$request->content
        );
        DB::table('copyright')->update($updateDetails);

        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }
    public function about(){
        $About = DB::table('about')->get();
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'About Us';
        return view('admin.about',compact('page_title','page_name','About'));
    }
    public function about_save(Request $request){
        $path = 'uploads/images';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'content'=>$request->content,
            'image'=>$image
        );
        DB::table('about')->update($updateDetails);

        Session::flash('message', "Changes have Been Saved");
        return Redirect::back();
    }

    public function addTerms(){
        $page_name = 'Add Terms & Conditions';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addTerms',compact('page_title','page_name'));
    }
    public function add_term(Request $request){
        $terms = new Term;
        $terms->title = $request->title;
        $terms->content = $request->content;
        $terms->save();
        Session::flash('message', "Content Has been Added");
        return Redirect::back();
    }

    public function terms(){
        $page_name = 'Terms & Conditions';
        $Terms = Term::All();
        $page_title = 'list';
        return view('admin.terms',compact('page_title','Terms','page_name'));
    }
    public function editTerm($id){
        $Terms = Term::find($id);
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = $Terms->title;
        return view('admin.editTerm')->with('Terms',$Terms)->with('page_title',$page_title)->with('page_name',$page_name);
    }

    public function edit_term(Request $request, $id){
       $updateDetails = array(
           'title'=>$request->title,
           'content' =>$request->content
       );
       DB::table('terms')->where('id',$id)->update($updateDetails);
       Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function delete_term($id){
        DB::table('terms')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function addPrivacy(){
        $page_name = 'Add Privacy Policy';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addPrivacy',compact('page_title','page_name'));
    }
    public function add_privacy(Request $request){
        $privacy = new Privacy;
        $privacy->title = $request->title;
        $privacy->content = $request->content;
        $privacy->save();
        Session::flash('message', "Content Has been Added");
        return Redirect::back();
    }

    public function privacy(){
        $Privacy = Privacy::All();
        $page_name = 'Privacy Policies';
        $page_title = 'list';
        return view('admin.privacy',compact('page_title','Privacy','page_name'));
    }
    public function editPrivacy($id){
        $Privacy = Privacy::find($id);
        $page_name = $Privacy->title;
        $page_title = 'formfiletext';//For Style Inheritance

        return view('admin.editPrivacy')->with('Privacy',$Privacy)->with('page_name',$page_name)->with('page_title',$page_title);
    }

    public function edit_privacy(Request $request, $id){
       $updateDetails = array(
           'title'=>$request->title,
           'content' =>$request->content
       );
       DB::table('privacy')->where('id',$id)->update($updateDetails);
       Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function delete_privacy($id){
        DB::table('privacy')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function gallery(){
        $page_title = 'Gallery';
        $page_name = 'Image Gallery';
        $Gallery = Gallery::all();
        return view('admin.gallery',compact('page_title','Gallery','page_name'));
    }

    public function editGallery($id){
        $page_title = 'formfiletext';
        $Gallery = Gallery::find($id);
        $page_name =  $Gallery->title;
        return view('admin.editGallery',compact('page_title','Gallery','page_name'));
    }

    public function addGallery(){
        $page_title = 'formfiletext';

        $page_name =  'Add Image';
        return view('admin.addGallery',compact('page_title','page_name'));
    }
    public function add_Gallery(Request $request){
            $path = 'uploads/gallery';
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
            $Gallery  = new Gallery;
            $Gallery->title = $request->title;
            $Gallery->content = $request->content;
            $Gallery->image = $image;
            $Gallery->save();
            Session::flash('message', "Image Added To Gallery");
            return Redirect::back();

    }

    public function save_gallery(Request $request, $id){
        $path = 'uploads/gallery';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'title'=>$request->title,
            'content' =>$request->content,
            'image' =>$image
        );
        DB::table('gallery')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function galleryList(){
        $page_title = 'list';
        $page_name = 'Image Gallery';
        $Gallery = Gallery::all();
        return view('admin.galleryList',compact('page_title','Gallery','page_name'));
    }

    public function deleteGallery($id){
        DB::table('gallery')->where('id',$id)->delete();
        return Redirect::back();
    }
    public function addAdmin(){
        $page_name = 'Add Site Admin';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addAdmin',compact('page_title','page_name'));
    }

    public function add_Admin(Request $request){
        $path = 'uploads/admins';

        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);
        $image = $filename;

        $password_inSecured = $request->password;
        //harshing password Here
        $password = Hash::make($password_inSecured);
         $Admin = new Admin;
         $Admin->name = $request->name;
         $Admin->email = $request->email;
         $Admin->password = $password;
         $Admin->image = $image;
         $Admin->save();
         Session::flash('message', "$request->name has been added as new admin");
         return Redirect::back();

    }
    public function admins(){
        $page_title = 'list';
        $page_name = 'Site Administrator';
        $Admin = Admin::all();
        return view('admin.admins',compact('page_title','Admin','page_name'));
    }

    public function editAdmin($id){
        $newID = Auth::user()->id;
        $Admin = Admin::find($newID);
        $page_title = 'formfiletext';//For Style Inheritance
        $page_name = 'Edit Site Administrator';

        return view('admin.editAdmin',compact('page_title','Admin','page_name'));
    }

    public function edit_Admin(Request $request, $id){
        $path = 'uploads/admins';
        if($request->email == Auth::user()->email ){
            if(isset($request->image)){
                $fileSize = $request->file('image')->getClientSize();
                if($fileSize>=1800000){
                   Session::flash('message', "File Exceeded the maximum allowed Size");
                   Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

                }else{

                    $file = $request->file('image');
                    $filename = str_replace(' ', '', $file->getClientOriginalName());
                    $timestamp = new Datetime();
                    $new_timestamp = $timestamp->format('Y-m-d');
                    $image_main_temp = $new_timestamp.'image'.$filename;
                    $image = str_replace(' ', '',$image_main_temp);
                    $file->move($path, $image);
                }
            }else{
                $image = $request->image_cheat;
            }
            $updateDetails = array(
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'facebook'=>$request->facebook,
                    'twitter'=>$request->twitter,
                    'linkedin'=>$request->linkedin,
                    'instagram'=>$request->instagram,
                    'youtube'=>$request->youtube,
                    'google'=>$request->google,
                    'content'=>$request->content,
                    'position'=>$request->position,
                    'image'=>$image
            );
            DB::table('admins')->where('id',$id)->update($updateDetails);
            Session::flash('message', "Your Changes Have Been Saved");
            return Redirect::back();
        }else{
            if(isset($request->image)){
                $fileSize = $request->file('image')->getClientSize();
                if($fileSize>=1800000){
                   Session::flash('message', "File Exceeded the maximum allowed Size");
                   Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

                }else{

                    $file = $request->file('image');
                    $filename = str_replace(' ', '', $file->getClientOriginalName());
                    $timestamp = new Datetime();
                    $new_timestamp = $timestamp->format('Y-m-d');
                    $image_main_temp = $new_timestamp.'image'.$filename;
                    $image = str_replace(' ', '',$image_main_temp);
                    $file->move($path, $image);
                }
            }else{
                $image = $request->image_cheat;
            }
            $updateDetails = array(
                'name'=>$request->name,
                'email'=>$request->email,
                'facebook'=>$request->facebook,
                'twitter'=>$request->twitter,
                'linkedin'=>$request->linkedin,
                'instagram'=>$request->instagram,
                'youtube'=>$request->youtube,
                'google'=>$request->google,
                'content'=>$request->content,
                'position'=>$request->position,
                'image'=>$image
            );
            DB::table('admins')->where('id',$id)->update($updateDetails);
            Auth::guard('admin')->logout();
            return Redirect::back();
        }
    }


    public function deleteAdmin($id){
        if($id==1){
            echo "<script>alert('You cannot Delete the Supper Admin)</script>";

            return Redirect::back();
        }else{
            DB::table('admins')->where('id',$id)->delete();
            return Redirect::back();
        }
    }

    public function addUser(){
        $page_name = 'Add USer';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addUser',compact('page_title','page_name'));
    }

    public function add_User(Request $request){
        $path = 'uploads/users';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $password_inSecured = $request->password;
        //harshing password Here
        $password = Hash::make($password_inSecured);
         $User = new User;
         $User->name = $request->name;
         $User->email = $request->email;
         $User->password = $password;
         $User->image = $image;
         $User->save();
         Session::flash('message', "$request->name has been added as new User");
         return Redirect::back();

    }
    public function users(){
        $page_title = 'list';
        $page_name = 'Site Users';
        $User = User::all();
        return view('admin.users',compact('page_title','User','page_name'));
    }

    public function deleteUser($id){
        if($id==1){
            echo "<script>alert('You cannot Delete the Supper Admin)</script>";

            return Redirect::back();
        }else{
            DB::table('users')->where('id',$id)->delete();
            return Redirect::back();
        }
    }

    public function slider(){
        $Slider = Slider::all();
        $page_title = 'list';
        $page_name = 'Home Page Slider';
        return view('admin.slider',compact('page_title','Slider','page_name'));
    }

    public function addSlider(){
        $page_title = 'formfiletext';
        $page_name = 'Add Home Page Slider';
        return view('admin.addSlider',compact('page_title','page_name'));
    }

    public function add_Slider(Request $request){
        $path = 'uploads/slider';
        $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $file->move($path, $filename);
        $image = $filename;
        $Slider = new Slider;
        $Slider->name = $request->name;
        $Slider->content = $request->content;
        $Slider->image = $image;
        $Slider->save();
        Session::flash('message', "Slider Image Has Been Added");
        return Redirect::back();
    }

    public function editSlider($id){
        $Slider = Slider::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Edit Home Page Slider';
        return view('admin.editSlider',compact('page_title','Slider','page_name'));
    }

    public function edit_Slider(Request $request, $id){
        $path = 'uploads/slider';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'name'=>$request->name,
            'content' =>$request->content,
            'image' =>$image
        );
        DB::table('slider')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function deleteSlider($id){
        DB::table('slider')->where('id',$id)->delete();
        return Redirect::back();
    }

    public function banners(){
        $Slider = Banner::all();
        $page_title = 'list';
        $page_name = 'Banners';
        return view('admin.banner',compact('page_title','Slider','page_name'));
    }

    public function editBanner($id){
        $Banner = Banner::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Site Banner';
        return view('admin.editBanner',compact('page_title','Banner','page_name'));
    }

    public function edit_Banner(Request $request, $id){
        $path = 'uploads/banners';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = str_replace(' ', '', $file->getClientOriginalName());

            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $updateDetails = array(
            'name'=>$request->name,
            'section' =>$request->section,
            'image' =>$image
        );
        DB::table('banners')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function addPage(){
        $page_title = 'formfiletext';//For Layout Inheritance
        $page_name = 'Add New Page';
        return view('admin.addPage',compact('page_title','page_name'));
    }

    public function add_Page(Request $request){

        $path = 'uploads/pages';
        if(isset($request->image_one)){
            $fileSize = $request->file('image_one')->getClientSize();
                if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                return Redirect::back();
                }else{

                $file = $request->file('image_one');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_one = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_one);
                }
        }else{
            $image_one = $request->pro_img_cheat;
        }

        if(isset($request->image_two)){
            $fileSize = $request->file('image_two')->getClientSize();
             if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

             }else{

                $file = $request->file('image_two');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_two = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_two);
             }
        }else{
            $image_two = $request->pro_img_cheat;
        }


        if(isset($request->image_three)){
            $fileSize = $request->file('image_three')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_three');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_three = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_three);
            }
        }else{
            $image_three = $request->pro_img_cheat;
        }
        //Additional images

        if(isset($request->image_four)){
            $fileSize = $request->file('image_four')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_four');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_four = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_four);
            }
        }else{
            $image_four = $request->pro_img_cheat;
        }



        if(isset($request->image_five)){
            $fileSize = $request->file('image_five')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_five');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_five = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_five);
            }
        }else{
            $image_five = $request->pro_img_cheat;
        }
        $Page = new Page;
        $Page->name = $request->name;
        $Page->content = $request->content;
        $Page->image_one = $image_one;
        $Page->image_two = $image_two;
        $Page->image_three = $image_three;
        $Page->image_four = $image_four;
        $Page->image_five = $image_five;
        $Page->save();


        $Page_Settings = new Page_Settings;
        $Page_Settings->page_name = $request->name;
        $Page_Settings->save();
        Session::flash('message', "A Page Has Been Added");
        return Redirect::back();
    }

    public function pages(){
        $Page = Page::all();
        $page_title = 'list';
        $page_name = 'All Dynamic Pages';
        return view('admin.pages',compact('page_title','Page','page_name'));
    }

    public function editPage($id){
        $Page = Page::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Edit Page';
        return view('admin.editPage',compact('page_title','Page','page_name'));
    }

    public function setPage($name){
        $Page = DB::table('pages_settings')->where('page_name',$name)->get();
        $page_title = 'formfiletext';
        $page_name = 'PageSettings';
        return view('admin.setPage',compact('page_title','Page','page_name'));
    }

    public function set_Page(Request $request, $name){

        $updateDetails = array(
            'sidebar'=>$request->sidebar,
            'sidebar_right' =>$request->sidebar_right,
            'slider' => $request->slider,
            'menu' => $request->menu,
        );

        DB::table('pages_settings')->where('page_name',$name)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function edit_Page(Request $request, $id){
        $path = 'uploads/pages';
        if(isset($request->image_one)){
            $fileSize = $request->file('image_one')->getClientSize();
                if($fileSize>=1800000){
                Session::flash('message', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
                return Redirect::back();
                }else{

                $file = $request->file('image_one');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_one = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_one);
                }
        }else{
            $image_one = $request->image_one_cheat;
        }

        if(isset($request->image_two)){
            $fileSize = $request->file('image_two')->getClientSize();
             if($fileSize>=1800000){
                Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
                Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

             }else{

                $file = $request->file('image_two');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_two = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_two);
             }
        }else{
            $image_two = $request->image_two_cheat;
        }


        if(isset($request->image_three)){
            $fileSize = $request->file('image_three')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_three');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_three = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_three);
            }
        }else{
            $image_three = $request->image_three_cheat;
        }
        //Additional images

        if(isset($request->image_four)){
            $fileSize = $request->file('image_four')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_four');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_four = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_four);
            }
        }else{
            $image_four = $request->image_four_cheat;
        }



        if(isset($request->image_five)){
            $fileSize = $request->file('image_five')->getClientSize();
            if($fileSize>=1800000){
               Session::flash('message_image_five', "File Exceeded the maximum allowed Size");
               Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

            }else{

                $file = $request->file('image_five');
                $filename = str_replace(' ', '', $file->getClientOriginalName());
                $timestamp = new Datetime();
                $new_timestamp = $timestamp->format('Y-m-d');
                $image_main_temp = $new_timestamp.'image'.$filename;
                $image_five = str_replace(' ', '',$image_main_temp);
                $file->move($path, $image_five);
            }
        }else{
            $image_five = $request->image_five_cheat;
        }

        $updateDetails = array(
            'name' => $request->name,
            'content' => $request->content,
            'image_one' =>$image_one,
            'image_two' =>$image_two,
            'image_three' =>$image_three,
            'image_four' =>$image_four,
            'image_five' =>$image_five,
        );
        DB::table('pages')->where('id',$id)->update($updateDetails);
        Session::flash('message', "Changes have been saved");
        return Redirect::back();
    }

    public function allMessages(){
        $Message = Message::all();
        $page_title = 'list';
        $page_name = 'Messages';
        return view('admin.allMessages',compact('page_title','Message','page_name'));
    }
    public function unread(){
        $Message = DB::table('messages')->where('status','0')->get();
        $page_title = 'list';
        $page_name = 'Messages';
        return view('admin.allMessages',compact('page_title','Message','page_name'));
    }
    public function read($id){
        $Message = Message::find($id);
        $page_title = 'formfiletext';
        $page_name = 'Messages';
        return view('admin.read',compact('page_title','Message','page_name'));
    }
    public function reply(Request $request,$id){
        $reply = $request->message;
        $subject = $request->subject;
        $name = $request->name;
        $email = $request->email;

        //Call The Generic Reply Class
        ReplyMessage::SendMessage($reply,$subject,$name,$email,$id);
    }
    public function deleteMessage($id){
        DB::table('messages')->where('id',$id)->delete();
        return Redirect::back();
    }


public function categories(){
    $Category = Category::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.categories',compact('page_title','Category','page_name'));
}

public function addCategory(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addCategory',compact('page_title','page_name'));
}

public function add_Category(Request $request){
    $path = 'uploads/categories';
    $file = $request->file('image');
    $filename = $file->getClientOriginalName();
    $file->move($path, $filename);
    $image = $filename;
    $Category = new Category;
    $Category->cat = $request->name;
    $Category->slung = \Str::slug($request->name);
    $Category->image = $image;

    $Category->save();
    Session::flash('message', "Category Has Been Added");
    return Redirect::back();
}

public function editCategories($id){
    $Category = Category::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editCategory',compact('page_title','Category','page_name'));
}

public function edit_Category(Request $request, $id){
    $path = 'uploads/categories';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
    $updateDetails = array(
        'cat'=>$request->name,
        'image'=>$image,
        'slung'=>\Str::slug($request->name),

    );
    DB::table('category')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteCategory($id){
    DB::table('category')->where('id',$id)->delete();
    return Redirect::back();
}

public function subCategories(){
    $Category = SubCategory::all();
    $page_title = 'list';
    $page_name = 'Categories';
    return view('admin.SubCategories',compact('page_title','Category','page_name'));
}

public function addSubCategory(){
    $page_title = 'formfiletext';
    $page_name = 'Add Category';
    return view('admin.addSubCategory',compact('page_title','page_name'));
}

public function add_SubCategory(Request $request){

    $SubCategory = new SubCategory;
    $SubCategory->name = $request->name;
    $SubCategory->cat_id = $request->cat_id;

    $SubCategory->save();
    Session::flash('message', "Category Has Been Added");
    return Redirect::back();
}

public function editSubCategories($id){
    $Category = SubCategory::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Home Page Slider';
    return view('admin.editSubCategory',compact('page_title','Category','page_name'));
}

public function edit_SubCategory(Request $request, $id){

    $updateDetails = array(
        'cat_id'=>$request->cat_id,
        'name' =>$request->name,

    );
    DB::table('sub_category')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteSubCategory($id){
    DB::table('sub_category')->where('id',$id)->delete();
    return Redirect::back();
}

public function addProduct(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'Add New Product';
    return view('admin.addProduct',compact('page_title','page_name'));
}

public function add_Product(Request $request){

    $path = 'uploads/menu';
    if(isset($request->image_one)){


            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){


            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);

    }else{
        $image_two = "0";
    }


    // if(isset($request->image_three)){
    //     $fileSize = $request->file('image_three')->getClientSize();
    //     if($fileSize>=1800000){
    //        Session::flash('message', "File Exceeded the maximum allowed Size");
    //        Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

    //     }else{

    //         $file = $request->file('image_three');
    //         $filename = str_replace(' ', '', $file->getClientOriginalName());
    //         $timestamp = new Datetime();
    //         $new_timestamp = $timestamp->format('Y-m-d');
    //         $image_main_temp = $new_timestamp.'image'.$filename;
    //         $image_three = str_replace(' ', '',$image_main_temp);
    //         $file->move($path, $image_three);
    //     }
    // }else{
    //     $image_three = $request->pro_img_cheat;
    // }
    //Additional images


    $Product = new Menu;
    $Product->title = $request->name;
    $Product->content = $request->content;
    $Product->meta = $request->meta;
    $Product->price = $request->price;
    $Product->code = $request->code;
    $Product->cat_id = $request->cat;
    $Product->slung = \Str::slug($request->title);
    $Product->thumbnail = $image_one;
    $Product->image = $image_two;
    // $Product->image_three = $image_three;
    $Product->price_raw = $request->price;

    $Product->save();

    Session::flash('message', "You have Added One New Product");
    return Redirect::back();
}

public function Products(){
    $Product = Menu::all();
    $page_title = 'list';
    $page_name = 'All in Menu';
    return view('admin.products',compact('page_title','Product','page_name'));
}

public function Products_featured(){
    $Product = Menu::all();
    $page_title = 'list';
    $page_name = 'All Products Featured';
    return view('admin.featured',compact('page_title','Product','page_name'));
}

public function Products_offer(){
    $Product = Menu::all();
    $page_title = 'list';
    $page_name = 'All Products On Offer';
    return view('admin.offer',compact('page_title','Product','page_name'));
}

public function swapoffer($id){
    $Product = Menu::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Give Offers';
    return view('admin.offerpage',compact('page_title','Product','page_name'));
}

public function swap_offer(Request $request, $id)
{
    $CheckOffer = DB::table('offer')->where('product_id',$id)->get();
    if($CheckOffer->isEmpty()){
        $path = 'uploads/product/offers';
        if(isset($request->image)){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $file->move($path, $filename);
            $image = $filename;
        }else{
            $image = $request->image_cheat;
        }
        $offer_type = $request->type;
        $offer_descriprion = $request->description;
        $offer_pecentage = $request->percentage;
        $offer_due = $request->due;

        $Offer = new Offer;
        $Offer->product_id = $id;
        $Offer->image = $image;
        $Offer->due = $offer_due;
        $Offer->percentage = $offer_pecentage;
        $Offer->status = 1;
        $Offer->description = $offer_descriprion;
        $Offer->save();
        //Get New Price
        $Price = Product::find($id);
        $productPrice = $Price->price;

        $offcut = ($offer_pecentage*$productPrice)/100;

        $newPrice = $productPrice - $offcut;


        if($request->type == 'hot'){
           $updateDetails = array('hot'=>1,'offer'=>1,'price'=>$newPrice);
        }else{
            $updateDetails = array('offer'=>1,'price'=>$newPrice);
         }
         DB::table('product')->where('id',$id)->update($updateDetails);
         Session::flash('message', "Offers Updated Successfully");
         return Redirect::back();
    }else{
        Session::flash('message', "The Product Is Already on Offer, Delete The Active Offer and Try Again");
         return Redirect::back();
    }

}

public function deleteOffer($id)
{
    $updateDetails = array('hot'=>0,'offer'=>0);
    DB::table('product')->where('id',$id)->update($updateDetails);
    DB::table('offer')->where('product_id',$id)->delete();
    return Redirect::back();
}
public function swap_status($id,$status){
    if($status == '1'){
       $newStatus = '0';
    }else{
        $newStatus = '1';
    }
    $updateDetails = array('featured'=>$newStatus);
    DB::table('product')->where('id',$id)->update($updateDetails);

    return Redirect::back();
}

public function editProduct($id){
    $Product = Menu::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Product';
    return view('admin.editProduct',compact('page_title','Product','page_name'));
}





public function edit_Product(Request $request, $id){
    $path = 'uploads/menu';
    if(isset($request->image_one)){


            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);

    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){


            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);

    }else{
        $image_two = $request->image_two_cheat;
    }


    if(isset($request->image_three)){

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);

    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images

    $updateDetails = array(
        'title' => $request->name,
        'slung' => \Str::slug($request->name),
        'content' => $request->content,
        'thumbnail' =>$image_one,
        'image' =>$image_two,
        'price' =>$request->price,
        'code' =>$request->code,
        'cat_id' =>$request->cat,
        'meta' =>$request->meta,
        'price_raw'=>$request->price,
    );
    DB::table('menus')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteProduct($id){
    DB::table('menus')->where('id',$id)->delete();
    return Redirect::back();
}

public function addService(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'Add New Service';
    return view('admin.addService',compact('page_title','page_name'));
}

public function add_Service(Request $request){

    $path = 'uploads/services';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }

    $Services = new Services;
    $Services->title = $request->name;
    $Services->content = $request->content;
    $Services->image_one = $image_one;
    $Services->image_two = $image_two;
    $Services->image_three = $image_three;

    $Services->save();

    Session::flash('message', "Service Has Been Added");
    return Redirect::back();
}

public function services(){
    $Services = Services::all();
    $page_title = 'list';
    $page_name = 'Services';
    return view('admin.services',compact('page_title','Services','page_name'));
}

public function editServices($id){
    $Services = Services::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Services';
    return view('admin.editServices',compact('page_title','Services','page_name'));
}


public function edit_Services(Request $request, $id){
    $path = 'uploads/services';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }



    $updateDetails = array(
        'title' => $request->name,
        'content' => $request->content,
        'image_one' =>$image_one,
        'image_two' =>$image_two,
        'image_three' =>$image_three,

    );
    DB::table('services')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteService($id){
    DB::table('services')->where('id',$id)->delete();

    return Redirect::back();
}

public function addPortfolio(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Portfolio';
    return view('admin.addPortfolio',compact('page_title','page_name'));
}

public function add_Portfolio(Request $request){

    $path = 'uploads/portfolio';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->pro_img_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->pro_img_cheat;
    }
    //Additional images

    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->pro_img_cheat;
    }



    if(isset($request->image_five)){
        $fileSize = $request->file('image_five')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_five');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_five = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_five);
        }
    }else{
        $image_five = $request->pro_img_cheat;
    }

    $Portfolio = new Portfolio;
    $Portfolio->title = $request->name;
    $Portfolio->content = $request->content;
    $Portfolio->client = $request->client;
    $Portfolio->link = $request->link;
    $Portfolio->service = $request->service;
    $Portfolio->image_one = $image_one;
    $Portfolio->image_two = $image_two;
    $Portfolio->image_three = $image_three;
    $Portfolio->image_four = $image_four;
    $Portfolio->image_five = $image_five;

    $Portfolio->save();

    Session::flash('message', "Portfolio Has Been Added");
    return Redirect::back();
}

public function portfolio(){
    $Portfolio = Portfolio::all();
    $page_title = 'list';
    $page_name = 'Portfolio';
    return view('admin.portfolio',compact('page_title','Portfolio','page_name'));
}

public function editPortfolio($id){
    $Portfolio = Portfolio::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Portfolio';
    return view('admin.editPortfolio',compact('page_title','Portfolio','page_name'));
}


public function edit_Portfolio(Request $request, $id){
    $path = 'uploads/portfolio';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images

    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->image_four_cheat;
    }



    if(isset($request->image_five)){
        $fileSize = $request->file('image_five')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_five', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_five');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_five = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_five);
        }
    }else{
        $image_five = $request->image_five_cheat;
    }



    $updateDetails = array(
        'title' => $request->name,
        'content' => $request->content,
        'service' => $request->service,
        'client' => $request->client,
        'link' => $request->link,
        'image_one' =>$image_one,
        'image_two' =>$image_two,
        'image_three' =>$image_three,
        'image_four' =>$image_four,
        'image_five' =>$image_five

    );
    DB::table('portfolio')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deletePortfolio($id){
    DB::table('portfolio')->where('id',$id)->delete();

    return Redirect::back();
}

public function pricing(){
    $Pricing = Pricing::all();
    $page_title = 'pricing';
    $page_name = 'Pricing';
    return view('admin.pricing',compact('page_title','Pricing','page_name'));
}

public function editPricing($id){
    $Pricing = Pricing::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Pricing';
    return view('admin.editPricing',compact('page_title','Pricing','page_name'));
}

public function addPricing(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Pricing';
    return view('admin.addPricing',compact('page_title','page_name'));
}

public function add_Pricing(Request $request){
    $Pricing = new Pricing;
    $Pricing->price = $request->price;
    $Pricing->frequency = $request->frequency;
    $Pricing->service = $request->service;
    $Pricing->content = $request->content;
    $Pricing->budget = $request->budget;
    $Pricing->save();

    Session::flash('message', "New Pricing has Been Added");
    return Redirect::back();
}

public function edit_Pricing(Request $request, $id){
    $updateDetails = array(

        'content' => $request->content,
        'service' => $request->service,
        'budget' => $request->budget,
        'price' => $request->price,
        'frequency' =>$request->frequency,


    );
    DB::table('pricing')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deletePricing($id){
    DB::table('pricing')->where('id',$id)->delete();

    return Redirect::back();
}

public function subscribers(){
    $Subscribers = Subscriber::all();
    $page_title = 'list';
    $page_name = 'Subscribers';
    return view('admin.subscribers',compact('page_title','Subscribers','page_name'));
}

public function mailSubscriber($email){
    //Collect info

    //mail subscriber
    ReplyMessage::mailSubscriber();
    return Redirect::back();

}
public function mailSubscribers($email){
    //Collect info

    //mail subscriber
    ReplyMessage::mailSubscribers();
    return Redirect::back();

}
public function deleteSubscriber($id){
    DB::table('subscribers')->where('id',$id)->delete();

    return Redirect::back();
}

public function updates(){
    $Update = Update::all();
    $page_title = 'list';
    $page_name = 'Updates';
    return view('admin.updates',compact('page_title','Update','page_name'));
}

public function update($id){
    $Update = Update::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Updates';
    return view('admin.update',compact('page_title','Update','page_name'));
}
public function mark($id){
    $updateDetails = array(
        'status'=>1
    );
    DB::table('updates')->where('id',$id)->update($updateDetails);
    return back();
}

public function payments(){
    $Payment = Payment::all();
    $page_title = 'list';
    $page_name = 'Payments';
    return view('admin.payments',compact('page_title','Payment','page_name'));
}

public function notifications(){
    $Notifications = Notifications::all();
    $page_title = 'list';
    $page_name = 'Notifications';
    return view('admin.notifications',compact('page_title','Notifications','page_name'));
}

public function notification($id){
    $Notifications = Notifications::all();
    $page_title = 'list';
    $page_name = 'Notification';
    return view('admin.notification',compact('page_title','Notifications','page_name'));
}

// Testimonials
public function addTestimonial(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addTestimonial';
    return view('admin.addTestimonial',compact('page_title','page_name'));
}

public function add_Testimonial(Request $request){

    $path = 'uploads/testimonials';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }





    $Testimonial = new Testimonial;
    $Testimonial->name = $request->name;
    $Testimonial->content = $request->content;
    $Testimonial->company = $request->company;
    $Testimonial->service = $request->service;
    $Testimonial->position = $request->position;
    $Testimonial->rating = $request->rating;
    $Testimonial->pull = $request->pull;
    $Testimonial->style = $request->style;
    $Testimonial->image = $image_one;

    $Testimonial->save();

    Session::flash('message', "Testimonial Has Been Added");
    return Redirect::back();
}

public function testimonials(){
    $Testimonial = Testimonial::all();
    $page_title = 'list';
    $page_name = 'Testimonial';
    return view('admin.testimonial',compact('page_title','Testimonial','page_name'));
}

public function editTestimonial($id){
    $Testimonial = Testimonial::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Testimonial';
    return view('admin.editTestimonial',compact('page_title','Testimonial','page_name'));
}


public function edit_Testimonial(Request $request, $id){
    $path = 'uploads/testimonials';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }




    $updateDetails = array(
        'name' => $request->name,
        'content' => $request->content,
        'service' => $request->service,
        'company' => $request->company,
        'position' => $request->position,
        'style'=>$request->style,
        'pull'=>$request->pull,
        'image' =>$image_one,


    );
    DB::table('testimonial')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteTestimonial($id){
    DB::table('testimonial')->where('id',$id)->delete();

    return Redirect::back();
}

// Service rendered
public function addService_rendered(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addService_rendered';
    return view('admin.addService_rendered',compact('page_title','page_name'));
}

public function add_Service_rendered(Request $request){
    $Service_Rendered = new Service_Rendered;
    $Service_Rendered->name = $request->name;
    $Service_Rendered->cat = $request->cat;
    $Service_Rendered->save();

    Session::flash('message', "Service Rendered Has Been Added");
    return Redirect::back();
}

public function service_rendered(){
    $Service_Rendered = Service_Rendered::all();
    $page_title = 'list';
    $page_name = 'Service_Rendered';
    return view('admin.service_rendered',compact('page_title','Service_Rendered','page_name'));
}

public function editService_rendered($id){
    $Service_Rendered = Service_Rendered::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Service_Rendered';
    return view('admin.editService_rendered',compact('page_title','Service_Rendered','page_name'));
}


public function edit_Service_rendered(Request $request, $id){


    $updateDetails = array(
        'name' => $request->name,
        'cat' => $request->cat,

    );
    DB::table('service_delivered')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteService_rendered($id){
    DB::table('service_delivered')->where('id',$id)->delete();

    return Redirect::back();
}
//Dailies
public function addDaily(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addDaily';
    return view('admin.addDaily',compact('page_title','page_name'));
}

public function add_Daily(Request $request){
    $Daily = new Daily;
    $Daily->author = $request->author;
    $Daily->content = $request->content;
    $Daily->save();

    Session::flash('message', "Daily Quote Has Been Added");
    return Redirect::back();
}

public function Daily(){
    $Daily = Daily::all();
    $page_title = 'list';
    $page_name = 'Daily';
    return view('admin.daily',compact('page_title','Daily','page_name'));
}

public function editDaily($id){
    $Daily = Daily::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Daily';
    return view('admin.editDaily',compact('page_title','Daily','page_name'));
}


public function edit_Daily(Request $request, $id){


    $updateDetails = array(
        'author' => $request->author,
        'content' => $request->content,

    );
    DB::table('daily')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteDaily($id){
    DB::table('daily')->where('id',$id)->delete();

    return Redirect::back();
}
// Blog Controls

public function addBlog(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'add Blog';
    return view('admin.addBlog',compact('page_title','page_name'));
}

public function add_Blog(Request $request){

    $path = 'uploads/blog';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->pro_img_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->pro_img_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->pro_img_cheat;
    }
    //Additional images

    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->pro_img_cheat;
    }





    $Blog = new Blog;
    $Blog->title = $request->title;
    $Blog->content = $request->content;
    $Blog->author = $request->author;
    $Blog->cat = $request->cat;
    $Blog->image_one = $image_one;
    $Blog->image_two = $image_two;
    $Blog->image_three = $image_three;
    $Blog->image_four = $image_four;


    $Blog->save();

    Session::flash('message', "Blog Has Been Added");
    return Redirect::back();
}

public function blog(){
    $Blog = Blog::all();
    $page_title = 'list';
    $page_name = 'Blog';
    return view('admin.blog',compact('page_title','Blog','page_name'));
}

public function editBlog($id){
    $Blog = Blog::find($id);
    $page_title = 'formfiletext';
    $page_name = 'Edit Blog';
    return view('admin.editBlog',compact('page_title','Blog','page_name'));
}


public function edit_Blog(Request $request, $id){
    $path = 'uploads/blog';
    if(isset($request->image_one)){
        $fileSize = $request->file('image_one')->getClientSize();
            if($fileSize>=1800000){
            Session::flash('message', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");
            return Redirect::back();
            }else{

            $file = $request->file('image_one');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_one = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_one);
            }
    }else{
        $image_one = $request->image_one_cheat;
    }

    if(isset($request->image_two)){
        $fileSize = $request->file('image_two')->getClientSize();
         if($fileSize>=1800000){
            Session::flash('message_image_two', "File Exceeded the maximum allowed Size");
            Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

         }else{

            $file = $request->file('image_two');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_two = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_two);
         }
    }else{
        $image_two = $request->image_two_cheat;
    }


    if(isset($request->image_three)){
        $fileSize = $request->file('image_three')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_three', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_three');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_three = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_three);
        }
    }else{
        $image_three = $request->image_three_cheat;
    }
    //Additional images

    if(isset($request->image_four)){
        $fileSize = $request->file('image_four')->getClientSize();
        if($fileSize>=1800000){
           Session::flash('message_image_four', "File Exceeded the maximum allowed Size");
           Session::flash('messageError', "An error occured, You may have exceeded the maximum size for an image you uploaded");

        }else{

            $file = $request->file('image_four');
            $filename = str_replace(' ', '', $file->getClientOriginalName());
            $timestamp = new Datetime();
            $new_timestamp = $timestamp->format('Y-m-d');
            $image_main_temp = $new_timestamp.'image'.$filename;
            $image_four = str_replace(' ', '',$image_main_temp);
            $file->move($path, $image_four);
        }
    }else{
        $image_four = $request->image_four_cheat;
    }







    $updateDetails = array(
        'title' => $request->title,
        'content' => $request->content,
        'author' => $request->author,
        'cat' => $request->cat,

        'image_one' =>$image_one,
        'image_two' =>$image_two,
        'image_three' =>$image_three,
        'image_four' =>$image_four,


    );
    DB::table('blog')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function delete_Blog($id){
    DB::table('blog')->where('id',$id)->delete();

    return Redirect::back();
}



public function approve($id,$type){
    if($type == 'review'){
        $updateDetails = array(
            'status'=>1
        );
        DB::table('reviews')->where('id',$id)->update($updateDetails);
        Session::flash('message-comment', "Review Has Been Approved");
        return Redirect::back();
    }else if($type == 'comment'){
        $updateDetails = array(
            'status'=>1
        );
        DB::table('comments')->where('id',$id)->update($updateDetails);
        Session::flash('message-comment', "Comment Has Been Approved");
        return Redirect::back();
    }
}

public function decline($id,$type){
    if($type == 'review')
    {
        DB::table('reviews')->where('id',$id)->delete();

        Session::flash('message-comment', "Comment Has Been Deleted");
        return Redirect::back();
    }else if($type == 'comment'){
        DB::table('comments')->where('id',$id)->delete();

        Session::flash('message-comment', "Comment Has Been Deleted");
        return Redirect::back();
    }
}
public function comments(){
    $Comment = Comment::all();
    $page_title = 'list';
    $page_name = 'Comment';
    return view('admin.comments',compact('page_title','Comment','page_name'));

}

public function reviews(){
    $Comment = Review::all();
    $page_title = 'list';
    $page_name = 'Reviews';
    return view('admin.reviews',compact('page_title','Comment','page_name'));

}


//Payable Services
public function traceServices(){
    $TraceServices = TraceServices::all();
    $page_title = 'list';
    $page_name = 'traceServices';
    return view('admin.traceServices',compact('page_title','TraceServices','page_name'));
}

public function editTraceServices($id){
    $TraceServices = TraceServices::find($id);
    $page_title = 'formfiletext';
    $page_name = 'TraceServices';
    return view('admin.editTraceServices',compact('page_title','TraceServices','page_name'));
}

public function addTraceServices(){
    $page_title = 'formfiletext';//For Layout Inheritance
    $page_name = 'addTraceServices';
    return view('admin.addTraceServices',compact('page_title','page_name'));
}

public function add_TraceServices(Request $request){
    $TraceServices = new TraceServices;
    $TraceServices->price = $request->price;
    $TraceServices->frequency = $request->frequency;
    $TraceServices->title = $request->title;
    $TraceServices->due = $request->due;
    $TraceServices->invoice = $request->invoice;
    $TraceServices->user_id = $request->user_id;
    $TraceServices->save();

    Session::flash('message', "New Traceble Service has Been Added");
    return Redirect::back();
}

public function edit_TraceServices(Request $request, $id){
    $updateDetails = array(


        'user_id' => $request->user_id,
        'invoice' => $request->invoice,
        'title' => $request->title,
        'due' =>$request->due,
        'price' => $request->price,
        'frequency' =>$request->frequency,


    );
    DB::table('traceservices')->where('id',$id)->update($updateDetails);
    Session::flash('message', "Changes have been saved");
    return Redirect::back();
}

public function deleteTraceServices($id){
    DB::table('traceservices')->where('id',$id)->delete();

    return Redirect::back();
}

public function coupons(){
    $Coupons = Coupon::all();
    $page_title = 'list';
    $page_name = 'Coupons';
    return view('admin.coupons',compact('page_title','Coupons','page_name'));

}

public function deleteCoupon($id){
    DB::table('coupons')->where('id',$id)->delete();

    return Redirect::back();
}

public function discounts(){
    $Discount = Discount::all();
    $page_title = 'list';
    $page_name = 'Discounts';
    return view('admin.discounts',compact('page_title','Discount','page_name'));

}
public function addCoupon(){
       $page_name = 'Add Coupon';
        $page_title = 'formfiletext';//For Style Inheritance
        return view('admin.addCoupon',compact('page_title','page_name'));
}

public function add_Coupon(Request $request){
    $Coupon = new Coupon;
    $Coupon->type = $request->type;
    $Coupon->price = $request->price;
    $Coupon->code = $request->code;
    $Coupon->save();
    Session::flash('message', "Coupon Code Has been Added");
        return Redirect::back();
}

public function orders(){
   $Orders = orders::all();
   $page_title = 'list';
   $page_name = 'Orders';
   return view('admin.orders',compact('Orders','page_title','page_name'));
}
public function mark_order($id){
    $updateDetails = array(
        'status'=>'Completed',
    );
    DB::table('orders')->where('id',$id)->update($updateDetails);
    return Redirect::back();
}
}




