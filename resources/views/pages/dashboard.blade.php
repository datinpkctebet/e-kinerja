@extends('layout.default')

@section('content')



<div class="row">
  @php
    $user = session('employee');
  @endphp

  @if ($user['privilege'] === 'Writer')
    <div class="col-xl-12 mt-5">
        <h1>Hello {{ $user['name'] }}, Happy Work</h1>
    </div>

  @else
    <div class="col-xl-6">
        <div class="kt-portlet kt-portlet--bordered-semi kt-portlet--space kt-portlet--height-fluid">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                {{ @$admin->title }}
            </h3>
            </div>
        </div>

        <div class="kt-portlet__body">
            {!! @$admin->description !!}
        </div>
        </div>
    </div>
  @endif

  @if(session('employee')['privilege'] == 'Administrator')
    <div class="col-xl-6">
        <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                Pengumuman
            </h3>
            </div>
        </div>

        <form class="kt-form" method="POST" action="{{ URL(setPostUrl()) }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="kt-portlet__body">
            <div class="form-group">
                <label>Judul</label>
                <input type="text" class="form-control" name="title" value="{{ @$employee['title'] }}" placeholder="Judul">
            </div>

            <div class="form-group">
                <label for="kt_summernote_1">Deskripsi</label>
                <textarea class="summernote" id="kt_summernote_1" name="description">{!! @$employee['description'] !!}</textarea>
            </div>

            <div class="form-group">
                <label>Upload Dokumen</label>
                <div class="custom-file">
                <input type="file" name="file" class="custom-file-input">
                <label class="custom-file-label" for="customFile">Upload Dokumen</label>
                </div>
            </div>

            </div>
            <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </div>
        </form>

        </div>
    </div>
    <div class="col-xl-12 mt-5 body-schedule">
        <div class="container">
            <div class="header">
                <h1>📅 Jadwal Bulan Depan</h1>
                <p>Lihat jadwal dengan mudah dan efisien</p>
                <div class="month-info" id="monthInfo">Loading...</div>
            </div>

            <div class="controls">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="🔍 Cari nama...">
                </div>
                <button class="btn btn-primary" onclick="refreshData()">🔄 Refresh</button>
            </div>

            <div class="table-wrapper">
                <div id="loading" class="loading">
                    <div class="spinner"></div>
                    <p>Memuat data...</p>
                </div>

                <table id="dataTable" style="display: none;">
                    <thead>
                        <tr id="tableHeader">
                            <th>Nama</th>
                            <!-- Date headers will be generated here -->
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Data will be inserted here -->
                    </tbody>
                </table>

                <div id="pagination" class="pagination" style="display: none;">
                    <!-- Pagination will be inserted here -->
                </div>
            </div>
        </div>
    </div>
  @endif

</div>

<script>
    let currentPage = 1;
    let allData = [];
    let filteredData = [];
    let nextMonthDates = [];

    // Setup AJAX with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Generate dates for next month
    function generateNextMonthDates() {
        const today = new Date();
        const nextMonth = new Date(today.getFullYear(), today.getMonth() + 1, 1);
        const monthName = nextMonth.toLocaleDateString('id-ID', { month: 'long', year: 'numeric' });
        
        $('#monthInfo').text(monthName);
        
        const dates = [];
        const daysInMonth = new Date(nextMonth.getFullYear(), nextMonth.getMonth() + 1, 0).getDate();
        
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(nextMonth.getFullYear(), nextMonth.getMonth(), day);
            dates.push({
                date: day,
                dayName: date.toLocaleDateString('id-ID', { weekday: 'short' }),
                dayNameFull: date.toLocaleDateString('id-ID', { weekday: 'long' }),
                fullDate: date,
                isWeekend: date.getDay() === 0 || date.getDay() === 6
            });
        }
        
        return dates;
    }

    // Generate table headers
    function generateTableHeaders() {
        nextMonthDates = generateNextMonthDates();
        const headerRow = $('#tableHeader');
        
        headerRow.html('<th>Nama</th>');
        
        nextMonthDates.forEach(dateInfo => {
            const weekendClass = dateInfo.isWeekend ? 'weekend' : '';
            headerRow.append(`
                <th class="date-header ${weekendClass}">
                    <span class="day-name">${dateInfo.dayName}</span>
                    <span class="date-number">${dateInfo.date}</span>
                </th>
            `);
        });
        
        headerRow.append('<th>Aksi</th>');
    }

    // Fetch data using AJAX
    function fetchData() {
        $('#loading').show();
        $('#dataTable').hide();
        $('#pagination').hide();

        $.ajax({
            url: 'schedule/activity',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Handle different response formats
                let data = [];
                
                if (Array.isArray(response)) {
                    // Response is already an array
                    data = response;
                } else if (response.data && Array.isArray(response.data)) {
                    // Response has data property (Laravel pagination format)
                    data = response.data;
                } else if (response.schedules && Array.isArray(response.schedules)) {
                    // Custom property name
                    data = response.schedules;
                } else {
                    console.error('Unexpected response format:', response);
                    data = [];
                }
                
                allData = data;
                filteredData = data;
                
                generateTableHeaders();
                renderTable();
                
                $('#loading').hide();
                $('#dataTable').show();
                $('#pagination').show();

                // Toast notification
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                });

                Toast.fire({
                    icon: 'success',
                    title: `Data berhasil dimuat (${data.length} data)`
                });
            },
            error: function(xhr, status, error) {
                $('#loading').hide();
                
                let errorMessage = 'Gagal memuat data!';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (error) {
                    errorMessage += ' ' + error;
                }
                
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: errorMessage,
                    confirmButtonColor: '#667eea'
                });
            }
        });
    }

    // Show detail schedule
    function showDetail(id) {
        const schedule = allData.find(s => s.id === id);
        
        if (!schedule) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Data tidak ditemukan!',
                confirmButtonColor: '#667eea'
            });
            return;
        }

        // Build schedule details
        let scheduleDetails = [];
        nextMonthDates.forEach(dateInfo => {
            const dateKey = `date_${dateInfo.date}`;
            const activity = schedule[dateKey];
            
            if (activity) {
                scheduleDetails.push({
                    date: dateInfo.date,
                    dayName: dateInfo.dayNameFull,
                    activity: activity
                });
            }
        });

        // Build HTML for detail
        let detailHTML = `
            <div class="detail-container">
                <div class="detail-header">
                    <h3>📋 ${schedule.name}</h3>
                </div>
        `;

        if (scheduleDetails.length > 0) {
            scheduleDetails.forEach(item => {
                detailHTML += `
                    <div class="detail-item">
                        <span class="detail-date">${item.dayName}, ${item.date}</span>
                        <span class="detail-activity">${item.activity}</span>
                    </div>
                `;
            });
        } else {
            detailHTML += `
                <div class="no-schedule">
                    <p>📅 Tidak ada jadwal untuk bulan ini</p>
                </div>
            `;
        }

        detailHTML += '</div>';

        Swal.fire({
            title: 'Detail Jadwal',
            html: detailHTML,
            width: '600px',
            confirmButtonText: 'Tutup',
            confirmButtonColor: '#667eea',
            customClass: {
                popup: 'detail-modal'
            }
        });
    }

    // Render table
    function renderTable(page = 1) {
        // Ensure filteredData is an array
        if (!Array.isArray(filteredData)) {
            console.error('filteredData is not an array:', filteredData);
            filteredData = [];
        }

        const itemsPerPage = 10;
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const paginatedData = filteredData.slice(start, end);

        const tableBody = $('#tableBody');
        tableBody.empty();

        if (paginatedData.length === 0) {
            tableBody.append(`
                <tr>
                    <td colspan="${nextMonthDates.length + 2}" style="text-align: center; padding: 40px;">
                        <p style="color: #6c757d; font-size: 16px;">📭 Tidak ada data yang ditampilkan</p>
                    </td>
                </tr>
            `);
            $('#pagination').hide();
            return;
        }

        paginatedData.forEach(row => {
            let rowHTML = `<td>${row.name || '-'}</td>`;
            
            nextMonthDates.forEach(dateInfo => {
                const dateKey = `date_${dateInfo.date}`;
                const cellValue = row[dateKey] || '';
                const cellClass = cellValue ? 'cell-filled' : 'cell-empty';
                const displayValue = cellValue || '-';
                const weekendClass = dateInfo.isWeekend ? 'weekend' : '';
                
                rowHTML += `<td class="${weekendClass}"><div class="cell-data ${cellClass}">${displayValue}</div></td>`;
            });
            
            rowHTML += `
                <td>
                    <button class="btn btn-info" onclick="showDetail(${row.id})">
                        👁️ Detail
                    </button>
                </td>
            `;
            
            const tr = $(`<tr onclick="showDetail(${row.id})">${rowHTML}</tr>`);
            tableBody.append(tr);
        });

        renderPagination(page);
        currentPage = page;
    }

    // Render pagination
    function renderPagination(page) {
        const itemsPerPage = 10;
        const totalPages = Math.ceil(filteredData.length / itemsPerPage);
        const pagination = $('#pagination');
        pagination.empty();

        if (totalPages <= 1) return;

        // Previous button
        const prevDisabled = page === 1 ? 'disabled' : '';
        pagination.append(`
            <button class="page-btn" onclick="renderTable(${page - 1})" ${prevDisabled}>
                ←
            </button>
        `);

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            if (i === 1 || i === totalPages || (i >= page - 1 && i <= page + 1)) {
                const activeClass = i === page ? 'active' : '';
                pagination.append(`
                    <button class="page-btn ${activeClass}" onclick="renderTable(${i})">
                        ${i}
                    </button>
                `);
            } else if (i === page - 2 || i === page + 2) {
                pagination.append('<span style="padding: 8px;">...</span>');
            }
        }

        // Next button
        const nextDisabled = page === totalPages ? 'disabled' : '';
        pagination.append(`
            <button class="page-btn" onclick="renderTable(${page + 1})" ${nextDisabled}>
                →
            </button>
        `);
    }

    // Search functionality
    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        // Ensure allData is an array
        if (!Array.isArray(allData)) {
            console.error('allData is not an array');
            filteredData = [];
            renderTable(1);
            return;
        }
        
        filteredData = allData.filter(row => {
            return row.name && row.name.toLowerCase().includes(searchTerm);
        });
        
        renderTable(1);
    });

    // Refresh data
    function refreshData() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
        });

        Toast.fire({
            icon: 'info',
            title: 'Memuat ulang data...'
        });

        fetchData();
    }

    // Initial load
    $(document).ready(function() {
        fetchData();
    });
</script>

@endsection
