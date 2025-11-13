@extends('layout.default')

@section('content')
<div class="kt-container--fluid  kt-grid__item kt-grid__item--fluid">

  {{-- FILTER --}}
  <div class="kt-portlet">
    <div class="kt-portlet__body">
      <form class="kt-form kt-form--label-right" method="GET" action="{{ URL(setPostUrl()) }}">
        <div class="form-group row" style="margin:0">
          @php
            $monthSelect = (@$input['month']) ? $input['month'] : $now->month;
            $yearSelect = (@$input['year']) ? $input['year'] : $now->year;
          @endphp

          <div class="col-2">
            <select class="form-control" name="month" id="month">
              @foreach ($month as $key => $value)
                <option value="{{ $key+1 }}" @if($key+1 == $monthSelect) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <select class="form-control" name="year" id="year">
              @foreach ($year as $value)
                <option value="{{ $value }}" @if($value == $yearSelect) selected @endif>{{ $value }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-2">
            <button type="submit" class="btn btn-block btn-primary" id="btn-search">
              <i class="fa fa-search"></i> Cari
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Import Data Absensi (Copy dari Excel → Paste di sini)
        </h3>
      </div>
      <div class="mt-2">
        <button id="btn-import" class="btn btn-success btn-sm">Import ke Database</button>
      </div>
    </div>

    <div class="kt-portlet__body">
      <div class="kt-section">
        <div id="absensi-table" class="hot"></div>
      </div>

    </div>
  </div>
</div>


@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('absensi-table');
        const btnSearch = document.getElementById('btn-search');
        const btnImport = document.getElementById('btn-import');
        const month = document.getElementById('month');
        const year = document.getElementById('year');

        const colHeaders = @json($colHeaders);
        const columns = @json($columns);
        let hot;

        function renderTable(data) {
            if (hot) hot.destroy();
            hot = new Handsontable(container, {
              data: data,
              colHeaders: colHeaders,
              columns: columns,
              stretchH: 'all',
              width: '100%',
              height: 600,
              rowHeaders: true,
              manualColumnResize: true,
              manualRowResize: true,
              contextMenu: true,
              wordWrap: true,
              className: "htMiddle htLeft",
              licenseKey: 'non-commercial-and-evaluation',
              cells: function(row, col) {
                  const cellProperties = {};
                  cellProperties.renderer = function (instance, td, row, col, prop, value, cellProperties) {
                      Handsontable.renderers.TextRenderer.apply(this, arguments);
                      td.style.whiteSpace = 'pre-line'; // supaya newline ditampilkan
                  };
                  return cellProperties;
              }
            });
        }

        function loadData() {
            const m = month.value;
            const y = year.value;
            fetch(`{{ url('absensi/load') }}?month=${m}&year=${y}`, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(json => {
                renderTable(json);
            })
            .catch(err => alert('Gagal load data: ' + err));
        }

        btnSearch.addEventListener('click', loadData);

        btnImport.addEventListener('click', () => {
            const data = hot.getSourceData();
            fetch("{{ url('absensi/save') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    month: month.value,
                    year: year.value,
                    data: data
                })
            })
            .then(res => res.json())
            .then(json => {
                if (json.status === 'success') {
                    swal.fire({
                        title: 'Berhasil!',
                        text: 'Berhasil menyimpan data.',
                        type: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(function () {
                      window.location.reload();
                    });
                } else {
                    swal.fire(
                        'Oops',
                        'Gagal menyimpan data: ' + json.message,
                        'error'
                    );
                }
            })
            .catch(err => alert('Terjadi kesalahan: ' + err));
        });

        // Auto load pertama kali
        loadData();
    });
</script>
@endpush

@endsection