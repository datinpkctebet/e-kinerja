@extends('layout.default')

@section('content')

<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">
  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          <!-- Daftar Penangguhan Cuti -->
        </h3>
      </div>
      <div class="mt-2">
        <!-- <a href="{{ URL('/penangguhan-cuti/add') }}">
          <button type="button" class="btn btn-primary btn-wide"><i class="fa fa-plus"></i> Tambah Penangguhan Cuti</button>
        </a> -->
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin::Section-->
      <div class="kt-section">
        <div class="kt-section__content table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Periode Penangguhan</th>
                <th>Keterangan</th>
                <th>Status Aktif</th>
              </tr>
            </thead>

            <tbody>
              @foreach($list as $value)
              <tr>
                <td>{{ $value->month }} Bulan</td>
                <td>{{ $value->description }}</td>
                <!-- <td>
                  <a href="{{ URL('/penangguhan-cuti/edit/'. $value->id) }}">
                    <button type="button" class="btn btn-warning">
                    <i class="fa fa-edit"></i>
                    Ubah</button>
                  </a>

                  <button type="button" class="btn btn-danger" onclick="deleteRow('/penangguhan-cuti', {{ $value->id }})">
                  <i class="fa fa-window-close"></i>
                  Hapus</button>
                </td> -->
                <td>
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active{{ $value->id }}" {{ $value->is_active ? 'checked' : '' }}>
                    <label class="custom-control-label" for="is_active{{ $value->id }}">{{ $value->is_active ? 'Aktif' : 'Tidak Aktif' }}</label>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!--end::Section-->
    </div>
    <!--end::Form-->
  </div>
</div>
<script>
  $(document).ready(function() {
      $(document).on("change", ".custom-control-input", function(e) {
          let checkbox   = $(this);
          let id         = checkbox.attr("id").replace("is_active", ""); 
          let isChecked  = checkbox.is(":checked") ? 1 : 0;
          let label      = $("label[for='" + checkbox.attr("id") + "']");

          // Batalin perubahan dulu, tunggu konfirmasi swal
          e.preventDefault();
          checkbox.prop("checked", !isChecked);

          swal.fire({
              title: 'Apakah Anda yakin?',
              text: isChecked ? "Aktifkan data ini?" : "Nonaktifkan data ini?",
              type: 'warning',
              showCancelButton: true,
              confirmButtonText: 'Ya, lanjutkan!',
              cancelButtonText: 'Batal'
          }).then(function (result) {
              if (result.value) {
                  $.ajax({
                      url: "/penangguhan-cuti/update-status", // ganti dengan route kamu
                      type: "POST",
                      data: {
                          id: id,
                          is_active: isChecked,
                          _token: $("meta[name='csrf-token']").attr("content")
                      },
                      success: function(res) {
                          // Update checkbox & label hanya jika berhasil
                          checkbox.prop("checked", !!isChecked);
                          label.text(isChecked ? "Aktif" : "Tidak Aktif");

                          swal.fire({
                              title: 'Berhasil!',
                              text: 'Status berhasil diperbarui.',
                              type: 'success',
                              timer: 1500,
                              showConfirmButton: false
                          }).then(function () {
                            window.location.reload();
                          });
                      },
                      error: function(xhr) {
                          swal.fire(
                              'Oops',
                              'Gagal terhubung ke server!',
                              'error'
                          );
                      }
                  });
              } else {
                  // Kalau dibatalkan, kembalikan ke posisi semula
                  checkbox.prop("checked", !isChecked);
              }
          });
      });
  });

</script>

@endsection
