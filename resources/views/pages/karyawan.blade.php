@extends('layout')

@section('css')
<style type="text/css">
  #row-tampilan div label{
    display: block;
  }
</style>
@stop

@section('content')
	<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">pelanggan {{$jenis}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">pelanggan</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
      <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create">Tambah Pelanggan</button>
          <button class="btn btn-primary" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-create-2" id="open-send-modal">Send</button>
          <button class="btn btn-warning" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import">Import Karyawan Excel</button>
          <a download class="btn btn-success" style="margin-bottom: 1rem;" href="{{url('')}}/karyawan/export">Export Karyawan Excel</a>
          @if($CHILDTAG=='aktif')
          <button type="button" id="button-nonaktif-all" disabled onclick="nonAktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Non Aktifkan</button>
          @else
          <button type="button" id="button-aktif-all" disabled onclick="aktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Aktifkan</button>
          @endif
          <button disabled type="button" class="btn btn-success" style="margin-bottom: 1rem;" id="button-export-terpilih" onclick="exportKaryawanTerpilih()">Export Karyawan Terpilih</button>
          <div class="card">
            <div class="card-header">
            <h3 class="card-title">Data Karyawan</h3>
            </div>
            <div class="card-body">
              <div class="row" id="row-tampilan">
                <div class="col-md-12">
                  <h4>Pilih Tampilan</h4>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="" checked="true"> Nama
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="2" checked="true"> merk meter
                  </label>
                </div>
                <div class="col-md-3">
                <label>
                    <input type="checkbox" class="tampilan" data-kolom="3" checked="true"> merk comm device
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="4" checked="true"> Telp
                  </label>
                  </div>
                  <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="5" checked="true"> provider
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="6"> ip_address
                  </label>
              </div>
              </div>
              <div class="row">
</div>
<div class="divider"></div>
<div class="table-responsive">
  <table id="table" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>
          <input type="checkbox" id="head-cb">
        </th>
                    <th>Nama</th>
                    <th>merk meter</th>
                    <th>merk comm device</th>
                    <th>TELP</th>
                    <th>provider</th>
                    <th>ip_address</th>
                    <th>###</th>
                  </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="modal-create">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-create" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data pelanggan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>MERK METER <small class="text-danger">*</small></label>
              <input type="text" name="merk_meter" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>MERK COMM DEVICE <small class="text-danger">*</small></label>
              <input type="text" name="merk_comm_device" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>provider</label>
              <input type="text" name="provider" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="ip_address" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-create-2">
    <div class="modal-dialog modal-lg">
        <form method="post" id="form-create-2" action="{{ url('karyawan') }}" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim SMS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @csrf
                <div class="form-group">
                    <label>Nomor Telepon <small class="text-danger">*</small></label>
                    <input type="text" name="nomor_telepon" class="form-control" id="nomorTeleponInput" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea name="body" class="form-control" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="kirimSMS()">Kirim SMS</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk mengirim SMS
    function kirimSMS() {
        // Dapatkan nilai dari input
        var nomorTelepon = $('#nomorTeleponInput').val();

        // Periksa apakah nilai tidak kosong
        if (nomorTelepon.trim() === '') {
            alert('Nomor Telepon harus diisi.');
            return;
        }

        // Kirim SMS menggunakan Twilio (ganti '/kirim-sms' dengan URL yang sesungguhnya)
        $.ajax({
            type: 'POST',
            url: '/kirim-sms',
            data: { nomor_telepon: nomorTelepon, _token: '{{ csrf_token() }}' },
            success: function (response) {
                // Tangani respons atau tindakan yang sesuai di sini
                console.log(response);

                // Tutup modal
                $('#modal-create-2').modal('hide');
            },
            error: function (error) {
                // Tangani kesalahan jika ada
                console.log(error);
            },
        });
    }
</script>

  <div class="modal fade" id="modal-edit">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-edit" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data pelanggan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{csrf_field()}}
          <input type="hidden" name="id">
          {{method_field('PATCH')}}
          <div class="row">
            <div class="col-md-12">
              <label>Nama <small class="text-danger">*</small></label>
              <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>MERK METER <small class="text-danger">*</small></label>
              <input type="text" name="merk_meter" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>MERK COMM DEVICE <small class="text-danger">*</small></label>
              <input type="text" name="merk_comm_device" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Telp <small class="text-danger">*</small></label>
              <input type="text" name="telp" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>provider</label>
              <input type="text" name="provider" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="ip_address" accept="image/*">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-import">
    <div class="modal-dialog modal-lg">
      <form method="post" id="form-import" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Import Data pelanggan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <p>Import data pelanggan sesuai format contoh berikut.<br/><a href="{{url('')}}/excel-karyawan.xlsx"><i class="fas fa-download"></i> File Contoh Excel pelanggan</a></p>
            </div>
            <div class="col-md-12">
              <label>File Excel pelanggan</label>
              <input type="file" name="excel-karyawan" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <form action="{{url('')}}/karyawan/export_terpilih" method="post" id="form-export-terpilih" class="hidden">
    <input type="hidden" name="ids">
    <button class="hidden" style="display: none;" type="submit">S</button>
  </form>
@stop

@section('js')
<script type="text/javascript">
  let list_karyawan = [];
  let organisasi = $("#filter-organisasi").val()
  
  const table = $('#table').DataTable({
    "pageLength": 100,
    "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'semua']],
    "bLengthChange": true,
    "bFilter": true,
    "bInfo": true,
    "processing":true,
    "bServerSide": true,
    "order": [[ 1, "desc" ]],
    "autoWidth": false,
    "ajax":{
      url: "{{url('')}}/karyawan/data/{{$jenis}}",
      type: "POST",
      data:function(d){
        d.organisasi = organisasi;
        return d
      }
    },
    "initComplete": function(settings, json) {
      const all_checkbox_view = $("#row-tampilan div input[type='checkbox']")
      $.each(all_checkbox_view,function(key,checkbox){
        let kolom = $(checkbox).data('kolom')
        let is_checked = checkbox.checked
        table.column(kolom).visible(is_checked)
      })
      setTimeout(function(){
        table.columns.adjust().draw();
      },3000)
    },
    columnDefs: [
      {
        "targets": 0,
        "class":"text-nowrap",
        "sortable":false,
        "render": function(data, type, row, meta){
          return `<input type="checkbox" class="cb-child" value="${row.id}">`;
        }
      },
      {
        "targets": 1,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          list_karyawan[row.id] = row;
          return row.merk_comm_device;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nama;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.merk_meter;
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.telp;
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.provider;
        }
      },
      {
        "targets": 6,
        "class":"text-nowrap",
        "sortable":false,
        "render": function(data, type, row, meta){
          if(row.ip_address==null){
            return `<img style="max-width:85px;max-height:85px;" src="{{url('')}}/dist/img/default.png"/>`
          }else{
            return `<a href="{{url('')}}/karyawan/ip_address/${row.id}" target="_blank"><img style="max-width:85px;max-height:85px;" src="{{url('')}}/karyawan/ip_address/${row.id}"/></a>`
          }
        }
      },
      {
        "targets": 7,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = `
            <a target="_blank" href="{{url('')}}/karyawan/download_pdf/${row.id}" class="btn btn-sm btn-primary btn-block">Download Pdf</a>
            <button onclick="showDetailKaryawan('${row.id}')" class="btn btn-sm btn-warning btn-block">Edit</button>
          `;
          if(row.status=='aktif'){
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-danger btn-block">Nonaktifkan</button>`
          }else{
            tampilan+=`<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-success btn-block">Aktifkan</button>`
          }
          return tampilan;
        }
      }
      
    ]
  });

  $("#row-tampilan input[type='checkbox']").on('change',function(){
    let checkbox = $(this)
    let kolom = $(this).data('kolom')
    let is_checked = checkbox[0].checked
    table.column(kolom).visible(is_checked)
  })

  function filterTampilan(){
    let all_columns = $("#view-tampilan div label input")
    
  }

  $("#form-create").on('submit',function(e){
    e.preventDefault()
    

    $("#form-create").ajaxSubmit({
      success:function(res){
        table.ajax.reload(null,false)
        // SET SEMUA KE DEFAULT
        $("#form-create input:not([name='_token'])").val('')
        $("#form-create textarea").val('')
        $("#form-create select:not([name='status'])").val('')


        $("#modal-create").modal('hide')
      }
    })
  })

  function showDetailKaryawan(id) {
    const karyawan = list_karyawan[id]
    $("#modal-edit").modal('show')
    // SET SEMUA KE DEFAULT
    $("#form-edit input:not([name='_token']):not([name='_method'])").val('')
    $("#form-edit textarea").val('')
    $("#form-edit select:not([name='status'])").val('')


    $("#form-edit [name='id']").val(id)
    $("#form-edit [name='nama']").val(karyawan.nama)
    $("#form-edit [name='merk_meter']").val(karyawan.merk_meter)
    $("#form-edit [name='merk_comm_device']").val(karyawan.merk_comm_device)
    $("#form-edit [name='telp']").val(karyawan.telp)
    $("#form-edit [name='provider']").val(karyawan.provider)
    $("#form-edit [name='status']").val(karyawan.status)
  }

  $("#form-edit").on('submit',function(e){
    e.preventDefault()
    $("#form-edit").ajaxSubmit({
      success:function(res){
        if(res===true){
          alert("BERHASIL UPDATE KARYAWAN")
          table.ajax.reload(null,false)
          $("#modal-edit").modal('hide')
        }
      }
    })
  })

  function toggleStatus(id) {
    const _c = confirm("Anda yakin akan melakukan operasi ini ?")
    if(_c===true){
      let karyawan = list_karyawan[id]
      let status_update = ''
      if(karyawan.status=='aktif'){
        status_update = 'non aktif'
      }else{
        status_update = 'aktif'
      }
      $.ajax({
        url:'{{url('')}}/karyawan/update_status',
        method:'POST',
        data:{id:id,status:status_update,_token:'{{csrf_token()}}'},
        success:function(res){
          if(res===true){
            table.ajax.reload(null,false)
          }
        }
      })
    }
  }

  $("#head-cb").on('click',function(){
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked',isChecked)
    $("#button-nonaktif-all,#button-export-terpilih").prop('disabled',!isChecked)
    $("#button-aktif-all,#button-export-terpilih").prop('disabled',!isChecked)
  })

  $("#table tbody").on('click','.cb-child',function(){
    if($(this).prop('checked')!=true){
      $("#head-cb").prop('checked',false)
    }

    let semua_checkbox = $("#table tbody .cb-child:checked")
    let button_non_aktif_status = (semua_checkbox.length>0)
    let button_export_terpilih_status = button_non_aktif_status;
    $("#button-nonaktif-all,#button-export-terpilih").prop('disabled',!button_non_aktif_status)
    $("#button-aktif-all,#button-export-terpilih").prop('disabled',!button_non_aktif_status)
  })

  function nonAktifkanTerpilih () {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    $("#button-nonaktif-all").prop('disabled',true)
    $.ajax({
      url:"{{url('')}}/karyawan/non-aktifkan",
      method:'post',
      data:{ids:semua_id},
      success:function(res){
        table.ajax.reload(null,false)
        $("#button-nonaktif-all").prop('disabled',false)
        $("#head-cb").prop('checked',false)
      }
    })
  }

  function aktifkanTerpilih () {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    $("#button-nonaktif-all").prop('disabled',true)
    $.ajax({
      url:"{{url('')}}/karyawan/aktifkan",
      method:'post',
      data:{ids:semua_id},
      success:function(res){
        table.ajax.reload(null,false)
        $("#button-aktif-all").prop('disabled',false)
        $("#head-cb").prop('checked',false)
      }
    })
    // console.log(semua_id)
    // console.log("YANG TERPILIH AKAN DINONAKTIFKAN")
  }

  $(".filter").on('change',function(){
    organisasi = $("#filter-organisasi").val()
    table.ajax.reload(null,false)
  })

  function exportKaryawanTerpilih() {
    let checkbox_terpilih = $("#table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih,function(index,elm){
      semua_id.push(elm.value)
    })
    let ids = semua_id.join(',')
    $("#button-export-terpilih").prop('disabled',true)
    $("#form-export-terpilih [name='ids']").val(ids)
    $("#form-export-terpilih").submit()
    $.ajax({
      url:"{{url('')}}/karyawan/export_terpilih",
      method:'POST',
      data:{ids:semua_id},
      success:function(res){
        console.log(res)
        $("#button-export-terpilih").prop('disabled',false)
      }
    })
  }
</script>
@stop