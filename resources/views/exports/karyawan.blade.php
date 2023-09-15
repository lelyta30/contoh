<table>
	<thead>
		<tr>
			<th colspan="2" rowspan="2"></th>
			<th colspan="5" style="text-align: center;"><strong>EXPORT DATA KARYAWAN</strong></th>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th>NAMA</th>
			<th>merk_meter</th>
			<th>merk_comm_device</th>
			<th>TELP</th>
			<th>provider</th>
			<th>STATUS</th>
			<th>ORGANISASI_ID</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list_karyawan as $karyawan)
		<tr>
			<td>{{$karyawan->nama}}</td>
			<td>{{$karyawan->merk_meter}}</td>
			<td>{{$karyawan->merk_comm_device}}</td>
			<td>{{$karyawan->telp}}</td>
			<td>{{$karyawan->provider}}</td>
			<td>{{$karyawan->status}}</td>
			<td>{{$karyawan->organisasi_id}}</td>
		</tr>
		@endforeach
	</tbody>
</table>