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
          <h1 class="m-0 text-dark">Pelanggan {{$jenis}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Pelanggan</li>
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
          <button class="btn btn-warning" style="margin-bottom: 1rem;" data-toggle="modal" data-target="#modal-import">Import Pelanggan Excel</button>
          <a download class="btn btn-success" style="margin-bottom: 1rem;" href="{{url('')}}/karyawan/export">Export Pelanggan Excel</a>
          @if($CHILDTAG=='aktif')
          <button type="button" id="button-nonaktif-all" disabled onclick="nonAktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Non Aktifkan</button>
          @else
          <button type="button" id="button-aktif-all" disabled onclick="aktifkanTerpilih()" class="btn btn-danger" style="margin-bottom: 1rem;">Aktifkan</button>
          @endif
          <button disabled type="button" class="btn btn-success" style="margin-bottom: 1rem;" id="button-export-terpilih" onclick="exportKaryawanTerpilih()">Export Pelanggan Terpilih</button>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pelanggan</h3>
            </div>
            <div class="card-body">
              <div class="row" id="row-tampilan">
                <div class="col-md-12">
                <h4>Pilih Tampilan</h4>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="1" checked="true"> id_pelanggan
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="2" checked="true"> name
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="3" checked="true"> address
                  </label>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="4" checked="true"> tariff
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="5" checked="true"> daya
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="6"> no_meter
                  </label>
                </div>
                <div class="col-md-3">
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="7"> merk_meter
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="8"> type_meter
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="9"> no_comm_device
                  </label>
                </div>
                <div class="col-md-3">
                <label>
                    <input type="checkbox" class="tampilan" data-kolom="10"> merk_comm_device
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="11"> type_comm_device
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="12"> port
                  </label>
                </div>
                <div class="col-md-3">
                <label>
                    <input type="checkbox" class="tampilan" data-kolom="13"> phone
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="14"> provider
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="15"> ip_address
                  </label>
                </div>
                <div class="col-md-3">
                <label>
                    <input type="checkbox" class="tampilan" data-kolom="16"> BPJS Kesehatan
                  </label>
                  <label>
                    <input type="checkbox" class="tampilan" data-kolom="17"> BPJS Ketenagakerjaan
                  </label>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <h4>Filter Pelanggan</h4>
                </div>
                <div class="col-md-4">
                  <label>MERK METER</label>
                  <select id="filter-organisasi" class="form-control filter">
                    <option value="">Pilih MERK METER</option>
                    @foreach($list_organisasi as $organisasi)
                    <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-4">
                  <label>MERK COMM DEVICE</label>
                  <select id="filter-bpjs-kesehatan" class="form-control filter">
                    <option value="">Filter MERK COMM DEVICE</option>
                    <option value="1">MERK COMM DEVICE Terdaftar</option>
                    <option value="0">MERK COMM DEVICE Belum Terdaftar</option>
                  </select>
                </div>
                <div class="col-md-4">
                  <label>MODEM MLIS</label>
                  <select id="filter-bpjs-ketenagakerjaan" class="form-control filter">
                    <option value="">Filter MODEM MLIS</option>
                    <option value="1">MODEM MLIS Terdaftar</option>
                    <option value="0">MODEM MLIS Belum Terdaftar</option>
                  </select>
                </div>
              </div>
              <div class="divider"></div>
              <div class="table-responsive">
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>
                      <input type="checkbox" id="head-cb">
                    </th>
                    <th>NO</th>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>ADDRESS</th>
                    <th>TARIFF</th>
                    <th>DAYA</th>
                    <th>N.MTR</th>
                    <th>M.MTR</th>
                    <th>T.MTR</th>
                    <th>N.CM.DVC</th>
                    <th>M.CM.DVC</th>
                    <th>T.CM.DVC</th>
                    <th>PORT</th>
                    <th>PHONE</th>
                    <th>PROVIDER</th>
                    <th>IP</th>
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
          <h4 class="modal-title">Tambah Data Pelanggan Baru</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <div class="col-md-12">
              <label>ID_PELANGGAN <small class="text-danger">*</small></label>
              <input type="text" name="id_pelanggan" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NAME <small class="text-danger">*</small></label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>ADDRESS <small class="text-danger">*</small></label>
              <input type="text" name="address" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>TARIFF <small class="text-danger">*</small></label>
              <input type="text" name="tariff" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>DAYA <small class="text-danger">*</small></label>
              <input type="text" name="daya" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>N.MTR</label>
              <input type="text" name="no_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>M.MTR</label>
              <input type="text" name="merk_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>T.MTR</label>
              <input type="text" name="type_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>N.CM.DVC</label>
              <input type="text" name="no_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>M.CM.DVC</label>
              <input type="email" name="merk_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>T.CM.DVC</label>
              <input type="email" name="type_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>PORT <small class="text-danger">*</small></label>
              <input type="text" name="port" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>PHONE <small class="text-danger">*</small></label>
              <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>PROVIDER <small class="text-danger">*</small></label>
              <input type="text" name="provider" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>IP <small class="text-danger">*</small></label>
              <input type="text" name="ip_address" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
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
        <form method="post" id="form-create" action="{{url('karyawan')}}" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Kirim sms</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{csrf_field()}}
                <div class="row">

                    <div class="col-md-12">
                        <label>Nomor Telepon <small class="text-danger">*</small></label>
                        <input type="text" name="nomor_telepon" class="form-control" required>
                    </div>
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
    function kirimSMS() {
        // Ambil nomor telepon dari input
        var nomorTelepon = $("input[name='nomor_telepon']").val();

        // Kirim SMS menggunakan Twilio
        $.ajax({
            type: "POST",
            url: "/kirim-sms", // Ganti dengan URL yang benar
            data: { nomor_telepon: nomorTelepon, _token: "{{ csrf_token() }}" },
            success: function (response) {
                // Tangani respons atau tindakan yang sesuai di sini
                console.log(response);

                // Tutup modal
                $("#modal-create-2").modal("hide");
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
          <h4 class="modal-title">Edit Data Pelanggan Baru</h4>
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
              <label>ID_PELANGGAN <small class="text-danger">*</small></label>
              <input type="text" name="id_pelanggan" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>NAME <small class="text-danger">*</small></label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>ADDRESS <small class="text-danger">*</small></label>
              <input type="text" name="address" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>TARIFF <small class="text-danger">*</small></label>
              <input type="text" name="tariff" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>DAYA <small class="text-danger">*</small></label>
              <input type="text" name="daya" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>N.MTR</label>
              <input type="text" name="no_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>M.MTR</label>
              <input type="text" name="merk_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>T.MTR</label>
              <input type="text" name="type_meter" class="form-control">
            </div>
            <div class="col-md-12">
              <label>N.CM.DVC</label>
              <input type="text" name="no_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>M.CM.DVC</label>
              <input type="email" name="merk_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>T.CM.DVC</label>
              <input type="email" name="type_comm_device" class="form-control">
            </div>
            <div class="col-md-12">
              <label>PORT <small class="text-danger">*</small></label>
              <input type="text" name="port" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>PHONE <small class="text-danger">*</small></label>
              <input type="text" name="phone" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>PROVIDER <small class="text-danger">*</small></label>
              <input type="text" name="provider" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>IP <small class="text-danger">*</small></label>
              <input type="text" name="ip_address" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Status</label>
              <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non aktif">Non Aktif</option>
              </select>
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Kesehatan</label>
              <input type="text" name="nomor_bpjs_kesehatan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Nomor BPJS Ketenagakerjaan</label>
              <input type="text" name="nomor_bpjs_ketenagakerjaan" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Organisasi</label>
              <select name="organisasi_id" class="form-control" required>
                <option value="">Pilih Organisasi</option>
                @foreach($list_organisasi as $organisasi)
                <option value="{{$organisasi->id}}">{{$organisasi->nama}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-12" style="margin-top: 4px;">
              <input type="file" name="foto" accept="image/*">
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
          <h4 class="modal-title">Import Data Pelanggan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{method_field('PUT')}}
          {{csrf_field()}}
          <div class="row">
            <div class="col-md-12">
              <p>Import data Pelanggan sesuai format contoh berikut.<br/><a href="{{url('')}}/excel-karyawan.xlsx"><i class="fas fa-download"></i> File Contoh Excel Karyawan</a></p>
            </div>
            <div class="col-md-12">
              <label>File Excel Pelanggan</label>
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
  ,bpjs_kesehatan = $("#filter-bpjs-kesehatan").val()
  ,bpjs_ketenagakerjaan = $("#filter-bpjs-ketenagakerjaan").val()
  
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
        d.bpjs_kesehatan = bpjs_kesehatan;
        d.bpjs_ketenagakerjaan = bpjs_ketenagakerjaan;
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
          return row.id_pelanggan;
        }
      },
      {
        "targets": 2,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.name;
        }
      },
      {
        "targets": 3,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.address;
        }
      },
      {
        "targets": 4,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.tariff;
        }
      },
      {
        "targets": 5,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nama_organisasi;
        }
      },
      {
        "targets": 6,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.daya;
        }
      },
      {
        "targets": 7,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.no_meter;
        }
      },
      {
        "targets": 8,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.merk_meter;
        }
      },
      {
        "targets": 9,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.type_meter;
        }
      },
      {
        "targets": 10,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.no_comm_device;
        }
      },
      {
        "targets": 11,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.merk_comm_device;
        }
      },
      {
        "targets": 12,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.type_comm_device;
        }
      },
      {
        "targets": 13,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.port;
        }
      },
      {
        "targets": 14,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.phone;
        }
      },
      {
        "targets": 15,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.provider;
        }
      },
      {
        "targets": 16,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.ip_address;
        }
      },
      {
        "targets": 17,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nomor_bpjs_kesehatan;
        }
      },
      {
        "targets": 18,
        "class":"text-nowrap",
        "render": function(data, type, row, meta){
          return row.nomor_bpjs_ketenagakerjaan;
        }
      },
      {
        "targets": 19,
        "sortable":false,
        "render": function(data, type, row, meta){
          let tampilan = '';
tampilan += `<button onclick="showDetailKaryawan('${row.id}')" class="btn btn-sm btn-warning btn-block">Edit</button>`;
if (row.status == 'aktif') {
  tampilan += `<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-danger btn-block">Nonaktifkan</button>`;
} else {
  tampilan += `<button onclick="toggleStatus('${row.id}')" class="btn btn-sm btn-success btn-block">Aktifkan</button>`;
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
    $("#form-edit [name='id_pelanggan']").val(karyawan.id_pelanggan)
    $("#form-edit [name='name']").val(karyawan.name)
    $("#form-edit [name='address']").val(karyawan.address)
    $("#form-edit [name='tariff']").val(karyawan.tariff)
    $("#form-edit [name='daya']").val(karyawan.daya)
    $("#form-edit [name='no_meter']").val(karyawan.no_meter)
    $("#form-edit [name='merk_meter']").val(karyawan.merk_meter)
    $("#form-edit [name='type_meter']").val(karyawan.type_meter)
    $("#form-edit [name='no_comm_device']").val(karyawan.no_comm_device)
    $("#form-edit [name='merk_comm_device']").val(karyawan.merk_comm_device)
    $("#form-edit [name='type_comm_device']").val(karyawan.type_comm_device)
    $("#form-edit [name='port']").val(karyawan.port)
    $("#form-edit [name='phone']").val(karyawan.phone)
    $("#form-edit [name='provider']").val(karyawan.provider)
    $("#form-edit [name='ip_address']").val(karyawan.ip_address)
    $("#form-edit [name='status']").val(karyawan.status)
    $("#form-edit [name='nomor_bpjs_kesehatan']").val(karyawan.nomor_bpjs_kesehatan)
    $("#form-edit [name='nomor_bpjs_ketenagakerjaan']").val(karyawan.nomor_bpjs_ketenagakerjaan)
    $("#form-edit [name='organisasi_id']").val(karyawan.organisasi_id)
  }

  $("#form-edit").on('submit',function(e){
    e.preventDefault()
    $("#form-edit").ajaxSubmit({
      success:function(res){
        if(res===true){
          alert("BERHASIL UPDATE PELANGGAN")
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
    console.log(semua_id)
    console.log("YANG TERPILIH AKAN DINONAKTIFKAN")
  }

  $(".filter").on('change',function(){
    organisasi = $("#filter-organisasi").val()
    bpjs_kesehatan = $("#filter-bpjs-kesehatan").val()
    bpjs_ketenagakerjaan = $("#filter-bpjs-ketenagakerjaan").val()
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