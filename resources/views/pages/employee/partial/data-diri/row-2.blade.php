<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">No. Rekening:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->no_rek }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">No. KTP:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->no_ktp }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">No. Kartu Keluarga:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->no_kk }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Status Pegawai:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->status_pegawai }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Jenis Jabatan:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->jenis_jabatan }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Periode Kontrak:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->kontrak_awal }} | {{ $data->kontrak_akhir }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">TMT Masuk:</label>
  <div class="col-6">
    <span class="form-control-plaintext"><span class="kt-font-bolder">{{ $data->tmt_masuk }}</span></span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Bidang:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->bidang }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Unit Kerja:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">
      @foreach ($data->array_unit_kerja as $item)
        {{ $item }}
      @endforeach
    </span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Jabatan:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">
      @foreach ($data->array_jabatan as $item)
        {{ $item }}
      @endforeach
    </span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Gaji:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ rupiahFormat($data->gaji) }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Tunjangan:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ rupiahFormat($data->tunjangan) }}</span>
  </div>
</div>

<div class="form-group form-group-xs row">
  <label class="col-6 col-form-label">Total Cuti:</label>
  <div class="col-6">
    <span class="form-control-plaintext kt-font-bolder">{{ $data->total_cuti }}</span>
  </div>
</div>
