@extends('layout.export')

@section('content')

<div class="lampiran">
  <table>
    <tr>
      <td rowspan="4" style="vertical-align: top">LAMPIRAN II :</td>
      <td>PERATURAN GUBERNUR PROVINSI</td>
    </tr>
    <tr>
      <td>DAERAH KHUSUS IBU KOTA JAKARTA</td>
    </tr>
    <td>
      <table>
        <tr>
          <td>NOMOR</td>
          <td>: 15 TAHUN 2018</td>
        </tr>
        <tr>
          <td>TANGGAL</td>
          <td>: 26 Februari 2018</td>
        </tr>
      </table>
    </td>
  </table>
</div>

<div class="header-pemberian">
  <div class="text-center">
    {{ $list->header_place }}, {{ dateFormat($list->header_date) }} <br/>
  </div>
  <div class="ml-2">Kepada</div>
  Yth. {{ $list->header_title }} <br/>
  <div class="ml-2">di - </div>
  <div class="ml-3">{{ $list->header_place }}</div>
  <br/>
</div>

<div class="text-center strong"><u>FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</u></div>

{{-- DATA PEGAWAI --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="4">I. DATA PEGAWAI</td>
  </tr>
  <tr>
    <td style="width:20%;">Nama</td>
    <td style="width:20%;">{{ @$employee->name }}</td>
    <td style="width:20%;">NIP</td>
    <td style="width:40%;">{{ $employee->nip }}</td>
  </tr>
  <tr>
    <td>Jabatan</td>
    <td>{{ $employee->first_array_jabatan }}</td>
    <td>Masa Kerja</td>
    <td>{{ $employee->length_work }}</td>
  </tr>
  <tr>
    <td>Unit Kerja</td>
    <td colspan="3">{{ @$employee->first_array_unit_kerja->title }}</td>
  </tr>
</table>

{{-- JENIS CUTI YANG DIAMBIL --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="4">II. JENIS CUTI YANG DIAMBIL**</td>
  </tr>
  <tr>
    <td style="width:40%;">1. Cuti Tahunan</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti Tahunan') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
    <td style="width:40%;">4. Cuti Melahirkan</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti Melahirkan') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td style="width:40%;">2. Cuti Besar</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti Besar') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
    <td style="width:40%;">5. Cuti Karena Alasan Penting</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti Karena Alasan Penting') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td style="width:40%;">3. Cuti Sakit</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti Sakit') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
    <td style="width:40%;">6. Cuti di Luar Tanggungan Negara</td>
    <td class='text-center' style="width:10%;"> @if($list->jenis === 'Cuti di Luar Tanggungan Negara') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
</table>

{{-- ALASAN CUTI --}}
<table class="border mb-1">
  <tr>
    <td class="strong">III. ALASAN CUTI</td>
  </tr>
  <tr>
    <td>{{ $list->alasan }}</td>
  </tr>
</table>

{{-- LAMA NYA CUTI --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="6">IV. LAMANYA CUTI</td>
  </tr>
  <tr>
    <td class="text-center">Selama</td>
    <td class="text-center">{{ $list->selama }}</td>
    <td class="text-center">Mulai Tanggal</td>
    <td class="text-center">{{ $list->mulai }}</td>
    <td class="text-center">s/d</td>
    <td class="text-center">{{ $list->selesai }}</td>
  </tr>
</table>

{{-- CATATAN CUTI --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="5">V. CATATAN CUTI***</td>
  </tr>
  <tr>
    <td style="width:38%" colspan="3">
      1. Cuti Tahunan
      @if ($list->jenis === 'Cuti Tahunan')
        <span
          style="font-family: DejaVu Sans; sans-serif;
            float: right;
            padding-right: 1rem">&#10004;
        </span>
      @endif
    </td>

    <td style="width:40%">2. Cuti Besar</td>
    <td> @if($list->jenis === 'Cuti Besar') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td class="text-center">Tahun</td>
    <td class="text-center">Sisa</td>
    <td class="w-25 text-center">Keterangan</td>

    <td style="width:40%">3. Cuti Sakit</td>
    <td> @if($list->jenis === 'Cuti Sakit') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td class="text-center">{{ getYear($list->header_date) }}</td>
    <td class="text-center">{{ $employee->total_cuti  }}</td>
    <td class="w-25 text-center">{{ $list->jenis }}</td>

    <td style="width:40%">4. Cuti Melahirkan</td>
    <td> @if($list->jenis === 'Cuti Melahirkan') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td class="text-center"></td>
    <td class="text-center"></td>
    <td class="w-25 text-center"></td>

    <td style="width:40%">5. Cuti Karena Alasan Penting</td>
    <td> @if($list->jenis === 'Cuti Karena Alasan Penting') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
  <tr>
    <td class="text-center"></td>
    <td class="text-center"></td>
    <td class="w-25 text-center"></td>

    <td style="width:40%">6. Cuti di Luar Tanggungan Negara</td>
    <td> @if($list->jenis === 'Cuti di Luar Tanggungan Negara') <span style="font-family: DejaVu Sans; sans-serif;">&#10004;</span> @endif </td>
  </tr>
</table>

{{-- ALAMAT SELAMA MENJALANKAN CUTI --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="4">VI. ALAMAT SELAMA MENJALANKAN CUTI</td>
  </tr>
  <tr>
    <td class="w-50" colspan="2">Alamat: {{ $employee->alamat }}</td>
    <td class="w-25">Telepon</td>
    <td class="w-25">{{ $employee->no_tlp }}</td>
  </tr>
  <tr>
    <td class="w-50 text-center" colspan="2">
      Selama Menjalankan Cuti Tugas Saya Diserahkan Kepada
      <br/>
      <br/>
      <br/>
      <br/>
      ( {{ @$list->penanggung_jawab_employee->name }} )
    </td>
    <td class="w-50 text-center" colspan="2">
      Hormat saya,
      <br/>
      <br/>
      <br/>
      <br/>
      ( {{ @$employee->name }} )
    </td>
  </tr>
</table>

{{-- PERTIMBANGAN ATASAN LANGSUNG --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="4">VII. PERTIMBANGAN ATASAN LANGSUNG</td>
  </tr>
  <tr>
    <td class="w-25 text-center">DISETUJUI</td>
    <td class="w-25 text-center">PERUBAHAN****</td>
    <td class="w-25 text-center">DITANGGUHKAN****</td>
    <td class="w-25 text-center">TIDAK DISETUJUI****</td>
  </tr>
  <tr>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
  </tr>
  <tr>
    <td class="w-50 text-center px-3" colspan="2">
      {{ @$list->atasan_setup1->description }}
      <br/>
      <br/>
      <br/>
      <br/>
      {{ @$list->atasan_setup1->employee->name }} <br/>
      NIP. {{ @$list->atasan_setup1->employee->nip }}
    </td>
    <td class="w-50 text-center px-3" colspan="2">
      {{ @$list->atasan_setup->description }}
      <br/>
      <br/>
      <br/>
      <br/>
      {{ @$list->atasan_setup->employee->name }} <br/>
      NIP. {{ @$list->atasan_setup->employee->nip }}
    </td>
  </tr>
</table>

{{-- PEJABAT YANG BERWENANG  MEMBERIKAN CUTI --}}
<table class="border mb-1">
  <tr>
    <td class="strong" colspan="4">VIII. PEJABAT YANG BERWENANG  MEMBERIKAN CUTI</td>
  </tr>
  <tr>
    <td class="w-25 text-center">DISETUJUI</td>
    <td class="w-25 text-center">PERUBAHAN****</td>
    <td class="w-25 text-center">DITANGGUHKAN****</td>
    <td class="w-25 text-center">TIDAK DISETUJUI****</td>
  </tr>
  <tr>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
    <td class="w-25"><br></td>
  </tr>
  <tr>
    <td class="w-50" colspan="2"></td>
    <td class="w-50 text-center px-3" colspan="2">
      {{ @$list->pejabat_berwenang_setup->description }}
      <br/>
      <br/>
      <br/>
      <br/>
      {{ @$list->pejabat_berwenang_setup->employee->name }} <br/>
      NIP. {{ @$list->pejabat_berwenang_setup->employee->nip }}
    </td>
  </tr>
</table>

@endsection

<style scoped>
  body {
    font-family: "Times New Roman", Times, serif;
    font-size: 14px;
  }

  .lampiran {
    margin-left: 49%;
    margin-bottom: 30px;
  }
</style>
