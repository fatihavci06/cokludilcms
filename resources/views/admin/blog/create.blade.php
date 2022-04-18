@extends('layouts.admin.master')
@section('title','Blog Ekle')
@section('content')

          <div id="mainContent">
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
              <div class="masonry-item col-md-12">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Blog Ekle</h6>
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
                    <form method="post" action="{{route('blog.store')}}" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                        <div class="form-group col-md-6">
                          <select class="form-control" id="dil" name="language_id" aria-label="Default select example">

                            <option value="" >Dil Seçiniz</option>
                            @foreach($language as $l)
                            <option value="{{$l->id}}" >{{$l->name}}</option>
                            
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                           
                          <select class="form-control" name="isAktive" aria-label="Default select example">
                            <option  value="">Durum Seçiniz</option>
                            <option value="1" @if(old('isAktive')==1) selected @endif>Aktif</option>
                            <option value="2" @if(old('isAktive')==2) selected @endif>Pasif</option>
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
                          <input type="text" class="form-control" name="title" value="{{old('title')}}" >
                        </div>
                       </div>
                      
                       <div class="row">
                        <div class="form-group col-md-12">
                           <textarea name="editor1">{{old('editor1')}}</textarea>
                        </div>
                        
                       </div>
                       <div class="row">
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Açıklama</label>
                          <input type="text" class="form-control" name="description" value="{{old('description')}}" >
                        </div>
                        <div class="form-group col-md-6">
                          <label for="exampleInputEmail1">Tarih</label>
                          <input type="date" class="form-control" name="date" value="{{old('date')}}" >
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-6" >
                          <label for="exampleInputEmail1">Keywords</label>
                          <input type="text" class="form-control" name="keywords" value="{{old('keywords')}}" >
                        </div>
                        <div class="form-group col-md-6" style="display:none;" id="kat_div">
                          <label for="exampleInputEmail1 ">Kategori</label>
                             <select class="select form-control" name="category[]" id="kategori_dil" multiple>
                              
                           
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
      
      $.ajax({
            data: {id:id},
            type: "get",
            url: "{{route('blog.kategoricek')}}",
            success: function(Cevap){
                    console.log(Cevap);
                    $('#kat_div').show();
                    $('#kategori_dil').html(Cevap);


                                    
            }
        });
      
    });
});
</script>
@endsection