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
use App\Models\Page;
use App\Models\Referens;
use App\Models\setting_text;
use App;
use Mail;
use Log;

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
      
        $lang=App::getlocale();
        

        return view('front.index',['slider'=>$slider,
        'services'=>$services,
        'project'=>$project,
        'takim'=>$takim,
        'blogs'=>$blogs,
        'referans'=>$referans,
        'setting_text'=>$setting_text,
        'lang'=>$lang    
    ]);
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
            $text->to('66fatihavci@gmail.com');
        });

        return response()->json(['success'=>'Başarılı']); //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar

        }
        catch(\Exception $e){

            Log::info($e->getText());
            return response()->json(['error'=>'Hata var']);; //trans : @langın aynısıdır dil dosyasında aktif dile göre çekme işlemi yapar
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