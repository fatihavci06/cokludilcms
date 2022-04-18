@extends('layouts.admin.master')
@section('title','Bloglar')
@section('content')

          
           
          <div class="container-fluid">
             
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Bloglar</h4>
                    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>İd</th>
                <th>Title</th>
                <th>Aktiflik</th>
                <th>İmage </th>
                <th>Kategoriler </th>
                <th>Dil</th>
                <th>Edit</th>
                <th width="100px">Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
                  </div>
                </div>
              </div>
            </div>
        


@endsection
@section('js')

<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('blog.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'isAktive', name: 'isAktive'},
            {data: 'image', name: 'image'},
            {data: 'category', name: 'category'},
            {data: 'language_name', name: 'language_name'},
            {data: 'edit', name: 'edit', orderable: false, searchable: false},
            {data: 'delete', name: 'delete', orderable: false, searchable: false},

        ]
    });

    
  });
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
@endsection