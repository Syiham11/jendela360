@extends('template.app')
@section('content')

        <style>
           .loader{
           visibility:hidden;
           }
        </style>

        <!-- Right side column. Contains the navbar and content of the page -->
        <aside class="right-side">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!--section starts-->
                <h1>Data Car</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="/">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="#">Data Car/Mobile</a>
                    </li>
                </ol>
            </section>
            <!--section ends-->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE TABLE PORTLET-->
                        <div class="portlet box primary">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="livicon" data-name="responsive" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i> Data Mobil
                                </div>
                            </div>
                            <div class="portlet-body flip-scroll">
                                <table class="table table-bordered data-table" id="user_table">
                                <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="btn btn-primary" href="javascript:void(0)" id="create_record">Tambah</a>
                                <br><hr>
                                    <thead class="flip-content">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Mobil</th>
                                            <th>Harga </th>
                                            <th>Stock</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END SAMPLE TABLE PORTLET-->
                    </div>
                </div>
            </section>
            <!-- content -->
        </aside>
        <!-- right-side -->
    </div>

    <!--MODAL-->
    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Data </h4>
                </div>
                <div class="modal-body">
                <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                        <label class="control-label col-md-4" >Nama Mobile : </label>
                        <div class="col-md-8">
                        <input type="text" name="nm_mobil" id="nm_mobil" class="form-control" required />
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4" >Harga : </label>
                        <div class="col-md-8">
                        <input type="number" name="harga" id="harga" class="form-control" required />
                        </div>
                        </div>
                        <div class="form-group">
                        <label class="control-label col-md-4" >Stock : </label>
                        <div class="col-md-8">
                        <input type="number" name="stock" id="stock" class="form-control" required />
                        </div>
                        </div>
                        <br />
                        <center><span class="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></center>
                        <br>
                        <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="submit" class="btn btn-info" name="action_button" id="action_button">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL-->
    <!--MODAL DELETE-->
    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">KONFIRMASI</h6>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">Apakah Anda ingin menghapus data ini?</h4>
                </div>
                <br>
                <center><span class="loader"><i class="fa fa-spinner fa-3x fa-spin"></i></span></center>
                <div class="modal-footer">
                 <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!--END MODAL DELETE-->

    <script>
    $(document).ready(function(){

    $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
        url: "{{ route('car.index') }}",
        },
        columns:[
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},

        {
        data: 'nm_mobil',
        name: 'nm_mobil'
        },
        {
        data: 'harga',
        name: 'harga'
        },
        {
        data: 'stock',
        name: 'stock'
        },
        {
        data: 'action',
        name: 'action',
        orderable: false
        }
        ]
     });

    $('#create_record').click(function(){
    $('.modal-title').text("Tambah Data");
    $('#action_button').val("Add");
    $('#action').val("Add");
    $('#formModal').modal('show');
    });

    $('#sample_form').on('submit', function(event){
        event.preventDefault();
        if($('#action').val() == 'Add')
        {
            $.ajax({
            url:"{{ route('car.store') }}",
            method:"POST",
            data: new FormData(this),
            contentType: false,
            cache:false,
            processData: false,
            dataType:"json",
            beforeSend: function(){
            $('.loader').css("visibility", "visible");
            },
            success:function(data)
            {
        var html = '';
        if(data.errors)
         {
            html = '<div class="alert alert-danger">';
            for(var count = 0; count < data.errors.length; count++)
            {
            html += '<p>' + data.errors[count] + '</p>';
            }
            html += '</div>';
         }
         if(data.success)
         {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            $('#sample_form')[0].reset();
            $('#user_table').DataTable().ajax.reload();
            }
            $('#form_result').html(html);
            $('#formModal').modal('hide');
        },
            complete: function(){
            $('.loader').css("visibility", "hidden");
            }
          })
        }

        if($('#action').val() == "Edit")
        {
            $.ajax({
            url:"{{ route('car.update') }}",
            method:"POST",
            data:new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType:"json",
            beforeSend: function(){
            $('.loader').css("visibility", "visible");
            },
            success:function(data)
            {
            var html = '';
            if(data.errors)
            {
            html = '<div class="alert alert-danger">';
            for(var count = 0; count < data.errors.length; count++)
            {
            html += '<p>' + data.errors[count] + '</p>';
            }
            html += '</div>';
            }
            if(data.success)
            {
            html = '<div class="alert alert-success">' + data.success + '</div>';
            $('#sample_form')[0].reset();
            $('#user_table').DataTable().ajax.reload();
            }
            $('#form_result').html(html);
            $('#formModal').modal('hide');
            },
            complete: function(){
            $('.loader').css("visibility", "hidden");
            }
            });
          }
        });

        $(document).on('click', '.edit', function(){
            var id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
            url:"/car/"+id+"/edit",
            dataType:"json",
            success:function(html){
            $('#nm_mobil').val(html.data.nm_mobil);
            $('#harga').val(html.data.harga);
            $('#stock').val(html.data.stock);
            $('#hidden_id').val(html.data.id);
            $('.modal-title').text("Edit Data");
            $('#action_button').val("Edit");
            $('#action').val("Edit");
            $('#formModal').modal('show');
            }
          })
        });

    var id;

    $(document).on('click', '.delete', function(){
            id = $(this).attr('id');
            $('#confirmModal').modal('show');
            $('.modal-title').text("Hapus Data");
        });

        $('#ok_button').click(function(){
            $.ajax({
            url:"car/destroy/"+id,
            beforeSend:function(){
            $('.loader').css("visibility", "visible");
            },
            success:function(data)
            {
            setTimeout(function(){
            $('#confirmModal').modal('hide');
            $('#user_table').DataTable().ajax.reload();
            }, 2000);
            },
            complete: function(){
            $('.loader').css("visibility", "hidden");
            }
            })
        });

    });
</script>

@endsection
