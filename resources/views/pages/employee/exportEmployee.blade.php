@extends('layout.export')

@section('content')

<h1>PEGAWAI DINAS KESEHATAN DKI JAKARTA</h1>
<h1>PUSKESMAS TEBET</h1>

    {{-- DATA DIRI --}}
    <h3>Data Diri</h3>
    <table class="w-100 page-break">
      <tr>
        <td>
          <table>
            <tr>
              <td>Nama Pegawai</td>
              <td>: {{ @$list->name }}</td>
            </tr>
            <tr>
              <td>No. Pegawai/NIP</td>
              <td>: {{ @$list->nip }}</td>
            </tr>
            <tr>
              <td>NRK</td>
              <td>: {{ @$list->nrk }}</td>
            </tr>
            <tr>
              <td>No. Seri Karpeg</td>
              <td>: {{ @$list->no_seri_karpeg }}</td>
            </tr>
            <tr>
              <td>Unit Kerja</td>
              <td>: {{ @$list->first_array_unit_kerja->title }}</td>
            </tr>
            <tr>
              <td>Status Pegawai</td>
              <td>: {{ @$list->status_pegawai }}</td>
            </tr>
            <tr>
              <td>Golongan</td>
              <td>: {{ @$list->golongan }}</td>
            </tr>
            <tr>
              <td>Bidang</td>
              <td>: {{ @$list->bidang }}</td>
            </tr>
            <tr>
              <td>Jenis Jabatan</td>
              <td>: {{ @$list->jenis_jabatan }}</td>
            </tr>
            <tr>
              <td>Jabatan</td>
              <td>: {{ @$list->first_array_jabatan }}</td>
            </tr>
            <tr>
              <td>TMT Masuk</td>
              <td>: {{ @$list->tmt_masuk }}</td>
            </tr>
            <tr>
              <td>Periode Kontrak</td>
              <td>: {{ @$list->kontrak_awal }} - {{ @$list->kontrak_akhir }}</td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>: {{ @$list->alamat }}</td>
            </tr>
            <tr>
              <td>Tempat, Tanggal Lahir</td>
              <td>: {{ @$list->tempat_lahir }}, {{ @$list->tgl_lahir }}</td>
            </tr>
            <tr>
              <td>Jenis Kelamin</td>
              <td>: {{ @$list->string_jenis_kelamin }}</td>
            </tr>
            <tr>
              <td>Agama</td>
              <td>: {{ @$list->agama }}</td>
            </tr>
            <tr>
              <td>No. KTP</td>
              <td>: {{ @$list->no_ktp }}</td>
            </tr>
            <tr>
              <td>Nama Ibu Kandung</td>
              <td>: {{ @$list->nama_ibu }}</td>
            </tr>
            <tr>
              <td>Status Perkawinan</td>
              <td>: {{ @$list->status_perkawinan }}</td>
            </tr>
            <tr>
              <td>Nama Pasangan</td>
              <td>: {{ @$list->nama_pasangan }}</td>
            </tr>
            <tr>
              <td>Jumlah Anak</td>
              <td>: {{ @$list->jumlah_anak }}</td>
            </tr>
            <tr>
              <td>No. KK</td>
              <td>: {{ @$list->no_kk }}</td>
            </tr>
            <tr>
              <td>No. BPJS Kesehatan</td>
              <td>: {{ @$list->no_bpjs_kesehatan }}</td>
            </tr>
            <tr>
              <td>No. BPJS Ketenagakerjaan</td>
              <td>: {{ @$list->no_bpjs_ketenagakerjaan }}</td>
            </tr>
            <tr>
              <td>No. NPWP</td>
              <td>: {{ @$list->no_npwp }}</td>
            </tr>
            <tr>
              <td>No. Rekening (DKI)</td>
              <td>: {{ @$list->no_rek }}</td>
            </tr>
            <tr>
              <td>No. Telp</td>
              <td>: {{ @$list->no_tlp }}</td>
            </tr>
            <tr>
              <td>Email</td>
              <td>: {{ @$list->email }}</td>
            </tr>
            <tr>
              <td>Gaji</td>
              <td>: {{ @$list->gaji }}</td>
            </tr>
            <tr>
              <td>Tunjangan</td>
              <td>: {{ @$list->tunjangan }}</td>
            </tr>
            <tr>
              <td>Total Cuti</td>
              <td>: {{ @$list->total_cuti }}</td>
            </tr>
          </table>
        </td>

        <td class="photo">
          <img src="{{ isImage(env('PATH_PICTURE'), $list->foto) }}" width="200px">
        </td>
      </tr>
    </table>

    {{-- PENDIDIKAN --}}
    @if ($list->pendidikans)
    <h3>Pendidikan</h3>
    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>Jenjang</th>
        <th>Jurusan</th>
        <th>Nama Sekolah</th>
        <th>Kota</th>
        <th class="text-center">Lama</th>
        <th>No Ijazah</th>
        <th>Tgl Ijazah</th>
      </tr>

      @foreach (json_decode($list->pendidikans) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->jenjang }}</td>
        <td>{{ $item->jurusan }}</td>
        <td>{{ $item->nama_sekolah }}</td>
        <td>{{ $item->kota }}</td>
        <td>{{ $item->tgl_masuk }} - {{ $item->tgl_keluar }}</td>
        <td>{{ $item->no_ijazah }}</td>
        <td>{{ $item->tgl_ijazah }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- KELUARGA --}}
    @if ($list->pendidikans)
    <h3>Keluarga</h3>

    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tempat, Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Hubungan</th>
        <th>Pendidikan</th>
        <th>Keterangan</th>
      </tr>

      @foreach (json_decode($list->keluargas) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->nama }}</td>
        <td>{{ $item->tempat_lahir }}, {{ $item->tgl_lahir }}</td>
        <td>{{ formatJenisKelamin($item->jenis_kelamin) }}</td>
        <td>{{ $item->hubungan }}</td>
        <td>{{ $item->pendidikan }}</td>
        <td>{{ $item->keterangan }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- RIWAYAT JABATAN --}}
    @if ($list->pendidikans)
    <h3>Riwayat Jabatan</h3>

    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>Unit Kerja Lama</th>
        <th>Masa Kerja</th>
        <th>Jenis Pegawai</th>
        <th>Jabatan</th>
        <th>Rumpun Kerja</th>
        <th>No. SK</th>
        <th>Tgl. SK</th>
        <th>TMT. SK</th>
      </tr>
      @foreach (json_decode($list->riwayat_jabatan) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->unit_kerja_lama }}</td>
        <td>{{ $item->masa_kerja }}</td>
        <td>{{ $item->jenis_pegawai }}</td>
        <td>{{ $item->jabatan }}</td>
        <td>{{ $item->rumpun_jabatan }}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->tgl_sk }}</td>
        <td>{{ $item->tmt_sk }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- RIWAYAT MUTASI --}}
    @if ($list->pendidikans)
    <h3>Riwayat Mutasi</h3>

    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>Unit Sekarang</th>
        <th>Unit Lama</th>
        <th>No. SK</th>
        <th>Tgl. SK</th>
        <th>No. SPMT</th>
        <th>Tgl. SPMT</th>
        <th>Keterangan</th>
      </tr>
      @foreach (json_decode($list->riwayat_mutasi) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->unit_kerja_lama }}</td>
        <td>{{ $item->unit_kerja_sekarang }}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->tgl_sk }}</td>
        <td>{{ $item->no_spmt }}</td>
        <td>{{ $item->tgl_spmt }}</td>
        <td>{{ $item->keterangan }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- DIKLAT --}}
    @if ($list->pendidikans)
    <h3>Diklat</h3>

    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>Unit Kerja Lama</th>
        <th>Masa Kerja</th>
        <th>Jenis Pegawai</th>
        <th>Jabatan</th>
        <th>Rumpun Kerja</th>
        <th>No. SK</th>
        <th>Tgl. SK</th>
        <th>TMT. SK</th>
      </tr>
      @foreach (json_decode($list->riwayat_jabatan) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->unit_kerja_lama }}</td>
        <td>{{ $item->masa_kerja }}</td>
        <td>{{ $item->jenis_pegawai }}</td>
        <td>{{ $item->jabatan }}</td>
        <td>{{ $item->rumpun_jabatan }}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->tgl_sk }}</td>
        <td>{{ $item->tmt_sk }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- HUKUMAN DISIPLIN --}}
    @if ($list->pendidikans)
    <h3>Hukuman Disiplin</h3>

    <table class="border page-break">
      <tr>
        <th>No</th>
        <th>No. SK</th>
        <th>Tgl. SK</th>
        <th>Masa Mulai</th>
        <th>Masa Selesai</th>
        <th>Pejabat yang menetapkan</th>
        <th>Nama Pejabat</th>
        <th>Tingkat Hukdis</th>
        <th>Keterangan</th>
      </tr>
      @foreach (json_decode($list->hukuman_disiplin) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->no_sk }}</td>
        <td>{{ $item->tgl_sk }}</td>
        <td>{{ $item->mulai }}</td>
        <td>{{ $item->selesai }}</td>
        <td>{{ $item->pejabat_menetapkan }}</td>
        <td>{{ $item->nama_pejabat }}</td>
        <td>{{ $item->tingkat }}</td>
        <td>{{ $item->keterangan }}</td>
      </tr>
      @endforeach
    </table>
    @endif

    {{-- PENINGKATAN PENDIDIKAN --}}
    @if ($list->pendidikans)
    <h3>Peningkatan Pendidikan</h3>

    <table class="border">
      <tr>
        <th>No</th>
        <th>Jenis Pendidikan</th>
        <th>No. Ijin Belajar</th>
        <th>Tgl. Ijin Belajar</th>
        <th>No. Sertifikat</th>
        <th>Tgl. Sertifikat</th>
        <th>Keterangan</th>
      </tr>
      @foreach (json_decode($list->peningkatan_pendidikan) as $key => $item)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>{{ $item->jenis }}</td>
        <td>{{ $item->no_izin }}</td>
        <td>{{ $item->tgl_izin }}</td>
        <td>{{ $item->no_sertifikat }}</td>
        <td>{{ $item->tgl_sertifikat }}</td>
        <td>{{ $item->keterangan }}</td>
      </tr>
      @endforeach
    </table>
    @endif

@endsection
