@extends('layouts.admin.master')
@section('title','Bülten')
@section('content')

          
           
          <div class="container-fluid">
             
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Bülten</h4>
                    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>İd</th>
                <th>Email</th>
               
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
        ajax: "{{ route('newlestter.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'email', name: 'email'}, 
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