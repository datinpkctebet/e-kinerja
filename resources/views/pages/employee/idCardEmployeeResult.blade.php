@extends('layout.blankIdCardEmployee')

@section('idCard')
<style>
    .card {
        background-color: #fafafa;
        border: 1px solid #e0e0e0;
    }
    .card-body h5 {
        color: #333;
    }

</style>
<div class="row">
    <div class="col-xl-12">
        <div class="card mx-auto shadow" style="max-width: 600px; border-radius: 10px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    {{-- FOTO PROFIL --}}
                    <div class="mr-4">
                        <img src="{{ $data->foto ? isImage(env('PATH_PICTURE'), $data->foto) : asset('images/no-profile.png') }}"
                            alt="Foto Profil" 
                            class="rounded border"
                            style="width: 110px; height: 140px; object-fit: cover;">
                    </div>

                    {{-- INFORMASI UTAMA --}}
                    <div class="flex-fill">
                        <h5 class="font-weight-bold mb-1">{{ $data->name }}</h5>
                        <span class="badge badge-success">{{ $data->active ? 'Aktif' : 'Tidak Aktif' }}</span>

                        <ul class="list-unstyled mt-3 mb-0 text-muted small">
                            <li><i class="flaticon2-user"></i> {{ $data->nip }}</li>
                            <li class="mt-1"><i class="flaticon2-phone"></i> {{ $data->no_tlp }}</li>
                            <li class="mt-1"><i class="flaticon2-new-email"></i> {{ $data->email }}</li>
                            <li class="mt-1"><i class="flaticon2-calendar"></i> {{ $data->tmt_masuk }}</li>
                        </ul>
                    </div>
                </div>

                {{-- ALAMAT --}}
                <div class="mt-3 pt-3 border-top text-third" style="font-size: 0.9rem;">
                    <i class="flaticon2-map"></i> Jl. Tebet Barat Raya, RT.11/RW.7, Tebet Bar., Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12810
                </div>
            </div>

            <div class="card-footer bg-transparent border-0 text-right">
                <a href="{{ url('/check-employee') }}" class="text-decoration-none">
                    <i class="flaticon2-back"></i> Kembali
                </a>
            </div>
        </div>

    </div>
</div>
@endsection