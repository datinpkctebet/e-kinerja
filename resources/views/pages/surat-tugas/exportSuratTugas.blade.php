@extends('layout.export')

@section('content')

<table>
  <tr>
    <td class="logo">
      <img src="{{ asset('/img/jayarayawarna.png') }}" style="width:110px;height:115px;">
    </td>

    <td>
      <table class="text">
        <tr><td class="sub-title" style="font-size: 16px">PEMERINTAH PROVINSI DAERAH KHUSUS IBUKOTA JAKARTA<br>
        DINAS KESEHATAN<br>
        SUKU DINAS KESEHATAN KOTA ADMINISTRASI JAKARTA SELATAN</td></tr>
        <tr><td class="title" style="font-size: 26px">PUSAT KESEHATAN MASYARAKAT TEBET</td></tr>
        <tr><td class="address" style="font-size: 13px">Jl. Tebet Barat Raya RT. 011 / 007 Kelurahan Tebet Barat, Kecamatan Tebet<br>
          Jakarta Selatan, DKI Jakarta, Kode Pos 12810 Telp.021-8350632<br>
          Email: puskesmas.tebet@jakarta.go.id</td></tr>
      </table>
    </td>
  </tr>
</table>

<hr>

<div class="nomor">
  <div>SURAT TUGAS</div>
  <div>Nomor : {{ $list['nomor'] }}</div>
</div>

<div class="w-20">
<p>{{ @$list['judul'] }}</p>
</div>


<table class="border w-100 mb-1">
  <tr>
    <th width="4%">No</th>
    <th>Nama</th>
    <th width="25%">NIP</th>
    <th width="7%">Pangkat / Gol</th>
    <th width="27%">Jabatan</th>
  </tr>

  @foreach ($list['list_employee'] as $key => $item)
  <tr>
    <td class="text-center">{{ $key+1 }}.</td>
    <td>{{ $item->name }}</td>
    <td class="text-center">{{ $item->nip }}</td>
    <td class="text-center">{{ $item->golongan }}</td>
    <td class="text-center">{{ $item->first_array_jabatan }}</td>
  </tr>
  @endforeach
</table>

<div class="w-20">
<label>Sebagai petugas dalam acara yang dilaksanakan pada :</label>
</div>
<br>

<table class="w-85">
  <tr>
    <td class="w-15">Hari / Tgl</td>
    <td width="2%">:</td>
    <td>{{ $list['tanggal'] }}</td>
  </tr>
  <tr>
    <td>Waktu</td>
    <td>:</td>
    <td>{{ $list['waktu'] }}</td>
  </tr>
  <tr>
    <td>Tempat</td>
    <td>:</td>
    <td>{!! $list['tempat'] !!}</td>
  </tr>
  <tr>
    <td>Acara</td>
    <td>:</td>
    <td>{!! $list['acara'] !!}</td>
  </tr>

  @if (@$list['seragam'])
  <tr>
    <td>Seragam</td>
    <td>:</td>
    <td>{{ $list['seragam'] }}</td>
  </tr>
  @endif
</table>

<div class="w-20">
<p>Agar yang bersangkutan melaksanakan tugas dengan baik dan penuh tanggung jawab serta membuat laporan hasil dari kegiatan tersebut.</p>
</div>

<table class="ttd">
  <tr>
    <td>{!! @$list['penanggung_jawab_1'] !!}</td>
  </tr>
  <br><br/>
</table>

<br><br/>
<br><br/>
<br><br/>
<br><br/>

<div class="w-20">
<p class="text-center">Pernyataan Melaksanakan Tugas</p>
</div>

<table class="border w-100">
  <tr>
    <th>No.</th>
    <th>Tanggal</th>
    <th>Tanda Tangan dan Cap</th>
  </tr>

  <tr>
    <td style="height: 5rem;"></td>
    <td></td>
    <td></td>
  </tr>
</table>

@endsection


<style scoped>
.kop {
  display: table;
  width: 100%;
}

.logo {
  width: 14%;
  float: left;
}
.logo img {
  width: 5rem;
}

.text {
  text-align: center;
}
.text .sub-title {
  font-size: 1.1rem;
}
.text .title {
  font-size: 2rem;
  font-weight: bold;
}
.text .address,
.text .postcode {
  font-size: .9rem;
}
.text .postcode {
  text-align: right;
}

hr {
  height: .15rem;
  background-color: black;
}

.nomor {
  text-align: center;
  padding-top: 1rem;
  font-family: 'Times New Roman', Times, serif;
}

.ttd{
  width: 50%;
  float: right;
  font-family: 'Times New Roman', Times, serif;
}

/* GLOBAL */
.w-15 {
  width: 15%;
  font-family: 'Times New Roman', Times, serif;
}

.w-20{
  font-family: 'Times New Roman', Times, serif;
}

.w-85 {
  width: 85%;
  font-family: 'Times New Roman', Times, serif;
}

.nomor,
p,
table {
  font-size: .9rem;
}

.border {
  font-size: .8rem !important;
  font-family: 'Times New Roman', Times, serif;
}

</style>