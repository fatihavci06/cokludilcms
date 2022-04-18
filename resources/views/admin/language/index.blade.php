@extends('layouts.admin.master')
@section('title','Diller')
@section('content')

          
           
          <div class="container-fluid">
             
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Diller</h4>
                    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>İd</th>
                <th>Dil Adı</th>
                <th>Dil Kodu</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
        </thead>
        <tbody >
          @foreach($data as $d)
            <tr >
                <td>{{$d->id}}</td>
                <td>{{$d->name}}</td>
                <td>{{$d->code}}</td>
                <td><a class="btn btn-primary" href="{{route('language.edit',$d->id)}}">Düzenle</a></td>
                <td><a  onclick="silmedenSor({{'"'.route('language.delete',$d->id).'"'}});return false" class="edit btn btn-danger btn-sm">Sil</a></td>
            </tr>
          @endforeach
            
        </tbody>
        <tfoot>
            <tr>
                <th>İd</th>
                <th>Dil Adı</th>
                <th>Dil Kodu</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </tfoot>
    </table>
                  </div>
                </div>
              </div>
            </div>
        


@endsection
@section('js')

<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable({
        "order": [[ 1, "asc" ]]
    });

} );

</script>

 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">


function silmedenSor (gidilecekLink) {
  
  swal({
  title: "Silmek istediğine emin misin?",
  text: "Silinen kayıt geri alınamaz.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  buttons: {    
        cancel: "İptal", //string, true, false
        confirm: "Evet",
        
      }
})
.then((willDelete) => {
  if (willDelete) {
  swal({title:"Silme başarılı.", icon: "success",button: {    
        text: "Tamam", //string, true, false
        
        
      }});
        setTimeout(function(){   
        window.location=gidilecekLink;
        //3 saniye sonra yönlenecek
        }, 1000);
  } else {
    swal({title:"Silme işleminden vazgeçtiniz.", icon: "warning",button: {    
        text: "Tamam", //string, true, false
        
        
      },});
  }
});
  
}
  


</script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#sortable" ).sortable({
        

        update:function(){
         var siralama=$('#sortable').sortable('serialize');
         console.log(siralama);
         $.get("{{route('page.sortable')}}?",siralama,function(data,status){
            console.log(data);
         });
        }
    });
  } );
  </script>
@endsection