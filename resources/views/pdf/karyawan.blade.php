<!DOCTYPE html>
<html>
<head>
	<title>Data Karyawan</title>
	<style type="text/css">
		.center{
			text-align: center;
		}
		.full{
			width: 100%;
		}
		.wrapper{
			padding-left: 30px;
			padding-right: 30px;
		}
		.underline{
			text-decoration: underline;
		}
		.bt-1{
			border-top: 2px solid black;
		}
		.bb-1{
			border-bottom: 2px solid black;
		}
		.mt-1{
			margin-top: 5px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		table tr th,table tr td{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="center full">
		<h2 class="underline">Data Diri Karyawan</h2>
	</div>

	<div class="wrapper">
		<strong>Personal Data</strong>
		<div class="bt-1 bb-1">
			<div class="full">
				<div style="display: inline-block;width: 460px;">
					<table class="full mt-1 mb-1" style="margin-top: 50px;">
					<tr>
							<th width="100">NO :</th>
							<td>{{$karyawan->id}}</td>
						</tr>
						<tr>
							<th width="100">ID :</th>
							<td>{{$karyawan->id_pelanggan}}</td>
						</tr>
						<tr>
							<th width="100">NAME :</th>
							<td>{{$karyawan->name}}</td>
						</tr>
						<tr>
							<th width="100">ADDRESS :</th>
							<td>{{$karyawan->address}}</td>
						</tr>
						<tr>
							<th width="100">TARIFF :</th>
							<td>{{$karyawan->tariff}}</td>
						</tr>
						<tr>
							<th width="100">DAYA :</th>
							<td>{{$karyawan->daya}}</td>
						</tr>
						<tr>
							<th width="100">N.MTR :</th>
							<td>{{$karyawan->no_meter}}</td>
						</tr>
						<tr>
							<th width="100">M.MTR :</th>
							<td>{{$karyawan->merk_meter}}</td>
						</tr>
						<tr>
							<th width="100">T.MTR :</th>
							<td>{{$karyawan->type_meter}}</td>
						</tr>
						<tr>
							<th width="100">N.CM.DVC :</th>
							<td>{{$karyawan->no_comm_device}}</td>
						</tr>
						<tr>
							<th width="100">M.CM.DVC :</th>
							<td>{{$karyawan->merk_comm_device}}</td>
						</tr>
						<tr>
							<th width="100">T.CM.DVC :</th>
							<td>{{$karyawan->type_comm_device}}</td>
						</tr>
						<tr>
							<th>PORT :</th>
							<td>{{$karyawan->port}}</td>
						</tr>
						<tr>
							<th>PHONE :</th>
							<td>{{$karyawan->phone}}</td>
						</tr>
						<tr>
							<th>PROVIDER :</th>
							<td>{{$karyawan->provider}}</td>
						</tr>
						<tr>
							<th>IP</th>
							<td>{{$karyawan->ip_address}}</td>
						</tr>
						<tr>
							<th>Divisi</th>
							<td>{{$karyawan->nama_organisasi}}</td>
						</tr>
					</table>
				</div>
				<?php
				$foto = storage_path('app/foto/2345678909876543.png');
				if($karyawan->foto!=null) $foto = storage_path('app/'.$karyawan->foto);
				?>
				<img style="width: 150px;margin-top:5px;border: 1px solid lightgray;display: inline-block;float: right;" src="{{$foto}}">
			</div>
		</div>
	</div>
</body>
</html>