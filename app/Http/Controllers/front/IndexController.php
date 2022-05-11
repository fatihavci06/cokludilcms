<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\SliderContent;
use App\Models\Setting;
use App\Models\Services;
use App\Models\Project;
use App\Models\Takim;
use App\Models\Blog;
use App\Models\blogCategory;
use App\Models\Page;
use App\Models\Referens;
use App\Models\setting_text;
use App\Models\Newlestter;
use App\Models\Comment;
use App;
use Mail;
use Log;
use Carbon\Carbon;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public static function Setting(){

            $data=Setting::first();
            return $data;
        }
        public static function pageGet($lang){
            $dil=App::getlocale();
            if($lang=='tr'){
                $lang_id=1;
            }
            else if($lang=='en'){
                $lang_id=10;
            }
            $data=Page::where('isAktive',1)->where('language_id',$lang_id)->orderBy('order_number','asc')->get();
            return $data;
        }
        public static function servicesGet($lang){
            $dil=App::getlocale();
            if($lang=='tr'){
                $lang_id=1;
            }
            else if($lang=='en'){
                $lang_id=10;
            }
            $data=Services::where('isAktive',1)->where('language_id',$lang_id)->orderBy('order_number','asc')->get();
            return $data;
        }
        public static function diller(){

            $data=Language::all();
            return $data;
        }
        public static function uygulamadili(){

            $uygulamadil=App::getlocale();
            return $uygulamadil;
        }

        public static function kisalt($kelime, $str = 60){


        
        if (strlen($kelime) > $str)
        {
            if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
            else $kelime = substr($kelime, 0, $str).'..';
        }
        return $kelime;
    }

    // Kullanımı
  
    public static function getCategory(){
        $lang=App::getlocale();
            if($lang=='tr'){
                $lang_id=1;
            }
            else if($lang=='en'){
                $lang_id=10;
            }
        $data=blogCategory::with('cat_count')->where('language_id',$lang_id)->get();
        return $data;
    }      
    public static function getRandomBlog(){
        $lang=App::getlocale();
            if($lang=='tr'){
                $lang_id=1;
            }
            else if($lang=='en'){
                $lang_id=10;
            }
        $data=Blog::inRandomOrder('id')->limit(5)->get();
        return $data;
    }  
    public function contactpost(Request $request){
        $validator = \Validator::make($request->all(), [
             'name' => 'required',
             'email'=>'required',
             'icerik'=>'required',
                
            ]);
        $dil=$request->segment(1);//urlden 1.segmeyi aldık http://cokludilcms.test/en/contactpost  yani eni
        App::setlocale($dil);//uygulama dilini gelen dile göre ayarladık
        if ($validator->fails())
         {
        return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $all=$request->all();

        try{

        mail::send('mail.contact',$all,function($text){
            $text->subject('Online Contact');
            $text->to('66fatihavci@gmail.com');
        });

       return response()->json(['success'=>trans('general.offer_success')]); //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar.gelen dile göre success mesajını terun ettik. offer_alert

        }
        catch(\Exception $e){

            Log::info($e->getText());
            return response()->json(['success'=>trans('general.offer_alert')]); //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar
        }
    }
    public function index(Request $request)
    {       
                

       /* $dilcount=Language::where('code',$dil)->count();
        if(empty($dil) || $dilcount<1 ){
            $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
            
        }
        
         
        ; //gelen dile göre uygulama dilini değiştirdil
       
       */
        $dil=$request->segment(1);//urlden 1.segme
        App::setlocale($dil);
        $dils=Language::where('code',$dil)->first();

        $slider=SliderContent::where('language_id',$dils->id)->get();
        $project=Project::where('language_id',$dils->id)->where('isAktive',1)->orderBy('order_number', 'ASC')->get();
        $takim=Takim::where('language_id',$dils->id)->where('isAktive',1)->orderBy('order_number', 'ASC')->get();
        $services=Services::where('language_id',$dils->id)->where('isAktive',1)->orderBy('order_number', 'ASC')->get();
        $blogs=Blog::with('categories.category_name')->where('language_id',$dils->id)->where('isAktive',1)->orderBy('date', 'DESC')->limit(3)->get();
        $referans=Referens::orderBy('order_number', 'ASC')->get();
        $setting_text=Setting_text::where('language_id',$dils->id)->first();
        $settings=Setting::first();
        $lang=App::getlocale();
        

        return view('front.index',['slider'=>$slider,
        'services'=>$services,
        'project'=>$project,
        'takim'=>$takim,
        'blogs'=>$blogs,
        'referans'=>$referans,
        'setting_text'=>$setting_text,
        'lang'=>$lang,
        'setting'=>$settings    
    ]);
    }
     public function blog_cat($slug)
    {
      $data=blogCategory::with('cat_count.blogs')->where('slug',$slug)->paginate(1);
      
       return view('front.blog_category',['data'=>$data]);
    }
    public function blog_detail($slug){
       // return $slug;

        $data=Blog::with('categories.category_name')->where('slug',$slug)->first();
        //return $data;
        $comment=Comment::with('child_comment')->where('blog_id',$data->id)->where('parent_id',0)->get();
        $comment_count=Comment::where('blog_id',$data->id)->count();
        return view('front.blog_detail',['data'=>$data,'comment'=>$comment,'comment_count'=>$comment_count]);
    }
    public function about(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        $data=$request->segment(2);
        return view('front.about',['data'=>$data]);
    }
    public function map(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        $data=$request->segment(2);
        return $data;
    }
    public function contact(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        $data=$request->segment(2);
        return view('front.contact',['data'=>$data]);
    }
    public function newsletter(Request $request)
    {
        $dil=$request->segment(1);//urlden 1.segmeyi aldık http://cokludilcms.test/en/contactpost  yani eni
        App::setlocale($dil);
         $validator = \Validator::make($request->all(), [
             
            'email' => 'required|email'
             
                
            ]);
        if ($validator->fails())
         {
        return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $varmi=Newlestter::where('email',$request->email)->count();

        if($varmi>0){
            return response()->json(['success'=>trans('general.error')]);
        }
        else{
            $bul=new Newlestter;
            $bul->email=$request->email;
            $bul->save();
            return response()->json(['success'=>trans('general.success')]);
        }
        
    }
public function pages(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        $slug=$request->segment(3);
        if(App::getlocale()=='tr'){
            $lang_id=1;
        }
        if(App::getlocale()=='en'){
            $lang_id=10;
        }
        $datas=Page::where('slug',$slug)->where('language_id',$lang_id)->count();
        if($datas>0){
            $data=Page::where('slug',$slug)->where('language_id',$lang_id)->first();
             return view('front.page',['data'=>$data]);
        }
        else{
            return abort(404);
        }
        
        
    }
    public function blog(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        if(App::getlocale()=='en'){
            $l_id=10;
        }
        else{
            $l_id=1;
        }
        $data=Blog::where('language_id',$l_id)->where('isAktive',1)->paginate(1);
        //return response()->json($data);
        return view('front.blog',['data'=>$data]);
        
        
    }
    public function dilidbul()
    {
        if(App::getlocale()=='en'){
            $l_id=10;
        }
        else{
            $l_id=1;
        }
        return $l_id;
    }
    public function blog_search(Request $request)
    {   
        $dil=$this->dilidbul();
        if(isset($request->name)){
            $gelen=strip_tags(addslashes($request->name));
            $data=Blog::where('language_id',$dil)->where('content','like','%'.$gelen.'%')->paginate(1);
            return view('front.blog',['data'=>$data]);
            return $data;
        }
        else{
            return redirect()->back();
        }
        
    }
    public function services(Request $request)
    {
        //Eğer tarayıcıyı direkt adres yazarak gelirse tarayıcı diline göre ilgili anasayfaya yönlendirir
      //  $dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);
       // return redirect()->route('front.index',['dil'=>$dil]);
        $id=$request->segment(3);
        if(App::getlocale()=='tr'){
            $lang_id=1;
        }
        if(App::getlocale()=='en'){
            $lang_id=10;
        }
        $datas=Services::where('id',$id)->where('language_id',$lang_id)->count();
        if($datas>0){
            $data=$datas=Services::where('id',$id)->where('language_id',$lang_id)->first();
             return view('front.services',['data'=>$data]);
        }
        else{
            return abort(404);
        }
        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function offer(Request $request)
    {
        //
       // return response()->json($request->all());
        $validator = \Validator::make($request->all(), [
             'name' => 'required',
             'icerik'=>'required',
             'email'=>'required',
             'subject'=>'required',
                
            ]);
        if ($validator->fails())
         {
        return response()->json(['errors'=>$validator->errors()->all()]);
        }
        $all=$request->all();

        try{

        mail::send('mail.offer',$all,function($text){
            $text->subject('Online Teklif');
            $text->to('66fatihavci3@gmail.com');
        });

        return response()->json(['success'=>trans('general.offer_success')]); //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar

        }
        catch(\Exception $e){

            Log::info($e->getText());
            return response()->json(['error'=>'Hata var']);; //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar
        }
        


    }
    public function blog_comment(Request $request,$blog_id,$parent_id=0)
    {
        //
       // return response()->json($request->all());
        if($parent_id==0){
            $request->validate([
            'name'=>'required|min:5',
                'email'=>'required',
                'comment'=>'required'
           ]);
            $data=new Comment;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->comment=$request->comment;
            $data->blog_id=$blog_id;
            $data->parent_id=$parent_id;
            $succ=$data->save();

            if(!$succ){
                return redirect()->back()->with('status','Hata');
            }
            else{
                return redirect()->back()->with('status','Başarılı');
            }
        }
        else{
           $validator = \Validator::make($request->all(), [
             'name' => 'required',
             'email'=>'required',
                'comment'=>'required'
                
            ]);
        if ($validator->fails())
         {
        return response()->json(['errors'=>$validator->errors()->all()]);
        }
            $data=new Comment;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->comment=$request->comment;
            $data->blog_id=$blog_id;
            $data->parent_id=$parent_id;
            $succ=$data->save();
            if(!$succ){
               return response()->json(['success'=>$request->name ]);
            }
            else{
                return response()->json(['success'=>'it is saved' ]);
            }
            
        }



        


    }
    public function blog_comment_ajax(Request $request)
    {
        //
       // return response()->json($request->all());
       
       
           $validator = \Validator::make($request->all(), [
             'name' => 'required',
             'email'=>'required',
                'comment'=>'required'
                
            ]);
        if ($validator->fails())
         {
        return response()->json(['errors'=>$validator->errors()->all()]);
        }
            $data=new Comment;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->comment=$request->comment;
            $data->blog_id=$request->blog_id;
            $data->parent_id=$request->parent_id;
            $succ=$data->save();
            if(!$succ){
               return response()->json(['success'=>$request->name ]);
            }
            else{
                return response()->json(['success'=>'it is saved' ]);
            }
            
    



        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
