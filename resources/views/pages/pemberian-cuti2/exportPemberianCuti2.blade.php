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
  <div>{{ @$list['surat'] }}</div>
  <div>Nomor : {{ $list['nomor'] }}</div>
</div>

<br><br/>

<div class="w-20">
<label>Diberikan {{ @$list['judul'] }} untuk tahun {{ @$list['tahun'] }} kepada Pegawai {{ @$list['status'] }} :</label>
</div>

<br><br/>

<table class="w-85">
  @foreach ($list['list_employee'] as $key => $item)
  <tr>
    <td></td>
  </tr>
  <tr>
      <td class="w-15">Nama</td>
      <td width="2%">:</td>
      <td> {{ $item->name }}</td>
  </tr>
  <tr>
    <td>NIP</td>
    <td>:</td>
    <td>{{ $item->nip }}</td>
  </tr>
  <tr>
    <td>Pangkat / Gol</td>
    <td>:</td>
    <td>{{ $item->golongan }}</td>
  </tr>
  <tr>
    <td>Jabatan</td>
    <td>:</td>
    <td>{{ $item->first_array_jabatan }}</td>
  </tr>
  <tr>
    <td>Tempat Bekerja</td>
    <td>:</td>
    <td>{!! $list['tempatkerja'] !!}</td>
  </tr>
  <tr>
    <td>Satuan Organisasi</td>
    <td>:</td>
    <td>{!! $list['organisasi'] !!}</td>
  </tr>
  @endforeach
</table>

<br>

<div class="w-20">
<p>Selama {{ @$list['selama']}} hari kerja terhitung mulai tanggal {{ @$list['tanggal1']}} sampai dengan tanggal {{ @$list['tanggal2']}} dengan ketentuan sebagai berikut :  </p>
</div>

<div class="w-85">
  <p>a. Sebelum menjalankan cuti wajib menyerahkan pekerjaan kepada atasan langsung.</p>
  <p>b. Setelah selesai menjalankan cuti wajib melaporkan diri kepada atasan langsungnya dan bekerja kembali dengan sebagaimana biasa.</p>
</div>

<div class="w-20">
<p>Demikian surat cuti ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
</div>

<br><br>

<table class="ttd">
  <tr>
    <td>{!! @$list['penanggung_jawab_1'] !!}</td>
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
  font-family: 'Arial', sans-serif;
  font-size: 13pt;
}

.ttd {
  width: 50%;
  float: right;
  font-family: 'Arial', sans-serif;
  font-size: 13pt;
}

/* GLOBAL */
.w-15 {
  width: 20%;
  font-family: 'Arial', sans-serif;
  font-size: 13pt;
}

.w-20 {
  margin: auto;
  width: 85%;
  font-family: 'Arial', sans-serif;
  font-size: 13pt;
}

.w-85 {
  margin: auto;
  width: 73%;
  font-family: 'Arial', sans-serif;
  font-size: 13pt;
}

.nomor,
p,
table {
  font-size: .9rem;
  font-size: 13pt;
}

.border {
  font-size: .8rem !important;
}

</style>