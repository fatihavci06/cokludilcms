@extends('layouts.admin.master')
@section('title','Blog Düzenle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Blog Düzenle</h6>
                  <div class="mT-30">
                    @if(session('status'))
                     <div class="alert alert-primary">{{session('status')}}</div>
                    @endif
                     @if($errors->any()) 
                     <div class="alert alert-primary">
                        @foreach($errors->all() as $e)
                        <li>{{$e}}</li>
                        @endforeach

                      </div>
                    @endif
                    <form method="post" action="{{route('blog.update',['id'=>$data->id])}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <input type="hidden" id="blog_id" value="{{$data->id}}">
                        <div class="form-group col-md-6">
                          <select class="form-control" name="language_id" id="dil" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" @if($data->language_id==$l->id) selected @endif>{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                           
                          <select class="form-control" name="isAktive" aria-label="Default select example">
                            <option  value="">Durum Seçiniz</option>
                            <option value="1" @if($data->isAktive==1) selected @endif>Aktif</option>
                            <option value="2" @if($data->isAktive==2) selected @endif>Pasif</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Resim</label>
                          <input type="file" class="form-control" name="image"  >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Başlık</label>
                          <input type="text" class="form-control" name="title" value="{{$data->title}}" >
                        </div>
                       </div>
                      
                       <div class="row">
                        <div class="form-group col-md-12">
                           <textarea name="editor1">{{$data->content}}</textarea>
                        </div>
                        
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Açıklama</label>
                          <input type="text" class="form-control" name="description" value="{{$data->description}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Tarih</label>
                          <input type="date" class="form-control" name="date" value="{{$data->date}}" >
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Keywords</label>
                          <input type="text" class="form-control" name="keywords" value="{{$data->keywords}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1 ">Kategori</label>
                             <select class="select form-control" name="category[]" multiple id="kategori_dil">
                              @foreach($category as $c)
                               
                                 <option  value="{{$c->id}}" @foreach($data->categories as $dc)@if($dc->category_name->id==$c->id) selected  @endif @endforeach>{{$c->name}}</option>
                                
                              @endforeach
                          </select>
                        </div>
                      </div>
                      
                      <div class="row"><div class="col-md-6 mx-auto"><button  class="btn btn-primary form-control">Kaydet</button><div></div></div>
                    </form>
                  </div>
                </div>
              </div>
              
             
            </div>
          </div>
     



@endsection
@section('js')
<script>
$(document).ready(function() {
  $('#dil').change(function() {
     
      var id=$('#dil').val();
      var blog_id=$('#blog_id').val();
      
      $.ajax({
            data: {id:id,'blog_id':blog_id},
            type: "get",
            url: "{{route('blog.kategoricek.update')}}",
            success: function(Cevap){
                    console.log(Cevap);
                  
                    $('#kategori_dil').html(Cevap);


                                    
            }
        });
      
    });
});
</script>
@endsection