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
    <!-- <div class="col-xl-6">
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
    </div> -->
  @endif

  @if(session('employee')['privilege'] == 'Administrator')
    <!-- <div class="col-xl-6">
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
    </div> -->
    <div class="col-xl-12 body-schedule-today">
        <div class="containerss">
            <div class="headerss">
                <h1>📊 Rangkuman Aktivitas Per Hari Ini</h1>
                <p>Lihat statistik aktivitas hari ini dengan mudah</p>
                <div class="date-info" id="dateInfo">Loading...</div>
            </div>

            <div class="controls">
                <button class="btn btn-primary" onclick="refreshDataToday()">🔄 Refresh</button>
            </div>

            <div id="loading" class="loading">
                <div class="spinner"></div>
                <p>Memuat data...</p>
            </div>

            <div id="mainContent" style="display: none;">
                <div class="content-wrapper">
                    <div class="legend-section">
                        <h2 class="legend-title">Keterangan:</h2>
                        
                        <div class="legend-item color-sakit" data-type="sakit" onclick="showCategoryDetail('sakit')">
                            <span class="legend-label">Sakit</span>
                            <span class="legend-count text-sakit" id="count-sakit">0</span>
                        </div>

                        <div class="legend-item color-cuti" data-type="cuti" onclick="showCategoryDetail('cuti')">
                            <span class="legend-label">Cuti</span>
                            <span class="legend-count text-cuti" id="count-cuti">0</span>
                        </div>

                        <div class="legend-item color-libur" data-type="libur" onclick="showCategoryDetail('libur')">
                            <span class="legend-label">Libur</span>
                            <span class="legend-count text-libur" id="count-libur">0</span>
                        </div>

                        <div class="legend-item color-izin" data-type="izin" onclick="showCategoryDetail('izin')">
                            <span class="legend-label">Izin</span>
                            <span class="legend-count text-izin" id="count-izin">0</span>
                        </div>

                        <div class="legend-item color-belum" data-type="belum" onclick="showCategoryDetail('belum')">
                            <span class="legend-label">Belum Terinput</span>
                            <span class="legend-count text-belum" id="count-belum">0</span>
                        </div>
                    </div>

                    <div class="chart-section">
                        <div class="chart-container">
                            <canvas id="activityChart"></canvas>
                        </div>
                        <div class="total-info">
                            <div class="total-label">Total Terinput</div>
                            <div class="total-number" id="totalInput">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-12 mt-5 body-schedule">
        <div class="containers">
            <div class="header">
                <h1>📅 Jadwal Bulan Depan</h1>
                <p>Lihat jadwal dengan mudah dan efisien</p>
                <div class="month-info" id="monthInfo">Loading...</div>
            </div>

            <div class="controls">
                <div class="search-box">
                    <input type="text" id="searchInputSchedule" placeholder="🔍 Cari nama...">
                </div>
                <button class="btn btn-primary" onclick="refreshData()">🔄 Refresh</button>
            </div>

            <div class="table-wrapper">
                <div id="loadings" class="loadings">
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

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<!-- Schedule Activity Next Month and Today Script -->
<script>
    // Setup AJAX with CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initial load
    $(document).ready(function() {
        // Search functionality
        $('#searchInputSchedule').on('input', function() {
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

        // For Next Month Section
        fetchData();

        // For Today Section
        setCurrentDate();
        fetchDataToday();
    });

    // Script Schedule Activity Next Month

        let currentPage = 1;
        let allData = [];
        let filteredData = [];
        let nextMonthDates = [];

        // Format date to DD/MM/YYYY
        function formatDateToDDMMYYYY(date) {
            const d = new Date(date);
            const day = String(d.getDate()).padStart(2, '0');
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const year = d.getFullYear();
            return `${day}/${month}/${year}`;
        }

        // Generate dates for next month
        function generateNextMonthDates() {
            const today = new Date();
            const nextMonth = new Date(today.getFullYear(), today.getMonth(), 1);
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
            
            // headerRow.append('<th>Aksi</th>');
        }

        // Fetch data using AJAX
        function fetchData() {
            $('#loadings').show();
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
                    
                    $('#loadings').hide();
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
                        type: 'success',
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
                        type: 'error',
                        title: 'Oops...',
                        text: errorMessage,
                        confirmButtonColor: '#667eea'
                    });
                }
            });
        }

        // Show detail schedule
        function showDetail(id, date = null) {
            const schedule = allData.find(s => s.id === id);
            if (!schedule) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'Data tidak ditemukan!',
                    confirmButtonColor: '#667eea'
                });
                return;
            }

            // Build schedule details for every date
            let scheduleDetails = nextMonthDates.map(dateInfo => {
                const dateKey = `date_${dateInfo.date}`;
                // Prefer schedule[dateKey], fallback to schedule.activity[dateKey]
                const raw = (schedule[dateKey] !== undefined) ? schedule[dateKey] : (schedule.activity && schedule.activity[dateKey] ? schedule.activity[dateKey] : null);

                let items = [];
                if (Array.isArray(raw)) {
                    items = raw;
                } else if (raw && typeof raw === 'object') {
                    items = Object.entries(raw).map(([time, desc]) => `${time}: ${desc}`);
                } else if (typeof raw === 'string' && raw.trim() !== '') {
                    items = [raw];
                }

                return {
                    date: dateInfo.date,
                    dayName: dateInfo.dayNameFull,
                    fullDate: dateInfo.fullDate,
                    fullDateFormatted: formatDateToDDMMYYYY(dateInfo.fullDate),
                    activityItems: items
                };
            });

            // If specific date requested, filter to that date only
            if (date !== null) {
                scheduleDetails = scheduleDetails.filter(d => d.date === date);
            }

            // Build HTML
            const first = scheduleDetails[0];
            let detailHTML = `
                <div class="details-container">
                    <div class="details-header">
                        <h3>📋 ${schedule.name}</h3>
                    </div>
            `;

            if (scheduleDetails.length > 0 && scheduleDetails[0].activityItems.length > 0) {
                scheduleDetails.forEach(item => {
                    item.activityItems.forEach(act => {
                        detailHTML += `
                            <div class="details-item">
                                <span class="details-date">${item.dayName}, ${item.fullDateFormatted}</span>
                                <span class="details-activity">${act}</span>
                            </div>
                        `;
                    });
                });
            } else {
                detailHTML += `
                    <div class="no-schedule">
                        <p>📅 Tidak ada jadwal</p>
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

            const itemsPerPage = 1000;
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
                    const raw = (row[dateKey] !== undefined) ? row[dateKey] : (row.activity && row.activity[dateKey] ? row.activity[dateKey] : null);
                    const weekendClass = dateInfo.isWeekend ? 'weekend' : '';

                    rowHTML += `<td onclick="showDetail(${row.id},${dateInfo.date})" class="${weekendClass}">`;

                    // Normalize to array of strings
                    let cellItems = [];

                    if (raw === null || raw === undefined || (Array.isArray(raw) && raw.length === 0) || (typeof raw === 'object' && !Array.isArray(raw) && Object.keys(raw).length === 0)) {
                        cellItems = [];
                    } else if (Array.isArray(raw)) {
                        cellItems = raw.map(it => {
                            if (it === null || it === undefined) return '-';
                            return (typeof it === 'object') ? JSON.stringify(it) : String(it);
                        });
                    } else if (typeof raw === 'object') {
                        // object expected like { "07:30-13:00": "Meeting", ... }
                        cellItems = Object.entries(raw).map(([time, desc]) => {
                            const descText = (desc === null || desc === undefined) ? '-' : (typeof desc === 'object' ? JSON.stringify(desc) : String(desc));
                            return time ? `${time}: ${descText}` : descText;
                        });
                    } else {
                        // string/number
                        cellItems = [String(raw)];
                    }

                    if (cellItems.length === 0) {
                        rowHTML += `<div class="cell-data cell-empty">-</div>`;
                    } else {
                        const itemsToShow = cellItems.slice(0, 2);
                        const cellClass = 'cell-filled';
                        itemsToShow.forEach(value => {
                            rowHTML += `<div class="cell-data ${cellClass}">${value}</div>`;
                        });
                        if (cellItems.length > 2) {
                            rowHTML += ``;
                        }
                    }

                    rowHTML += `</td>`;
                });
                
                // rowHTML += `
                //     <td>
                //         <button class="btn btn-info" onclick="showDetail(${row.id})">
                //             👁️ Detail
                //         </button>
                //     </td>
                // `;
                
                const tr = $(`<tr>${rowHTML}</tr>`);
                tableBody.append(tr);
            });

            renderPagination(page);
            currentPage = page;
        }

        // Render pagination
        function renderPagination(page) {
            const itemsPerPage = 1000;
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
                type: 'info',
                title: 'Memuat ulang data...'
            });

            fetchData();
        }

    // END of Script Schedule Activity Next Month


    // Script Schedule Activity Today
        let activityChart = null;
        let activityData = {
            sakit: 0,
            cuti: 0,
            libur: 0,
            izin: 0,
            belum: 0
        };
        let detailsData = {};

        // Set current date
        function setCurrentDate() {
            const today = new Date();
            const dateString = today.toLocaleDateString('id-ID', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            $('#dateInfo').text(dateString);
        }

        // Fetch data from API
        function fetchDataToday() {
            $('#loading').show();
            $('#mainContent').hide();

            $.ajax({
                url: 'schedule/activity-today',
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    // Parse response
                    if (response.data) {
                        activityData = response.data;
                    } else if (response.sakit !== undefined) {
                        activityData = response;
                    } else {
                        console.error('Unexpected response format');
                    }

                    // Fetch details
                    fetchDetails();
                },
                error: function(xhr, status, error) {
                    $('#loading').hide();
                    
                    console.error('AJAX Error:', error);
                    
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Gagal memuat data! ' + error,
                        confirmButtonColor: '#667eea'
                    });
                }
            });
        }

        // Fetch details data
        function fetchDetails() {
            $.ajax({
                url: 'schedule/activity-today-details',
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    if (response.details) {
                        detailsData = response.details;
                    }

                    updateDisplayToday();
                    
                    $('#loading').hide();
                    $('#mainContent').show();

                    // Toast notification
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true,
                    });

                    Toast.fire({
                        type: 'success',
                        title: 'Data berhasil dimuat'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch details:', error);
                    // Still show the page even if details fail
                    updateDisplayToday();
                    $('#loading').hide();
                    $('#mainContent').show();
                }
            });
        }

        // Update display with data
        function updateDisplayToday() {
            // Update counts
            console.log('Activity Data:', activityData);
            $('#count-sakit').text(activityData.sakit || 0);
            $('#count-cuti').text(activityData.cuti || 0);
            $('#count-libur').text(activityData.libur || 0);
            $('#count-izin').text(activityData.izin || 0);
            $('#count-belum').text(activityData.belum || 0);
            $('#totalInput').text(activityData.total || 0);

            // Update chart
            updateChartToday();
        }

        // Create/Update pie chart
        function updateChartToday() {
            const ctx = document.getElementById('activityChart').getContext('2d');

            const data = {
                labels: ['Sakit', 'Cuti', 'Libur', 'Izin', 'Belum Terinput'],
                datasets: [{
                    data: [
                        activityData.sakit || 0,
                        activityData.cuti || 0,
                        activityData.libur || 0,
                        activityData.izin || 0,
                        activityData.belum || 0
                    ],
                    backgroundColor: [
                        '#e74c3c', // Sakit - Red
                        '#3498db', // Cuti - Blue
                        '#f39c12', // Libur - Orange
                        '#9b59b6', // Izin - Purple
                        '#95a5a6'  // Belum - Gray
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 3
                }]
            };

            const config = {
                type: 'pie',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            padding: 12,
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 13
                            },
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            };

            // Destroy existing chart if exists
            if (activityChart) {
                activityChart.destroy();
            }

            // Create new chart
            activityChart = new Chart(ctx, config);
        }

        // Toggle legend visibility (for future enhancement)
        function toggleLegendToday(type) {
            console.log('Toggle legend:', type);
            // This can be enhanced to filter chart data
        }

        // Show category detail
        function showCategoryDetail(category) {
            const categoryNames = {
                'sakit': 'Sakit',
                'cuti': 'Cuti',
                'libur': 'Libur',
                'izin': 'Izin',
                'belum': 'Belum Terinput'
            };

            const categoryColors = {
                'sakit': '#e74c3c',
                'cuti': '#3498db',
                'libur': '#f39c12',
                'izin': '#9b59b6',
                'belum': '#95a5a6'
            };

            const categoryName = categoryNames[category];
            const categoryColor = categoryColors[category];
            const count = activityData[category] || 0;
            const people = detailsData[category] || [];

            // Build HTML
            let detailHTML = `
                <div style="text-align: left;">
                    <div style="background: ${categoryColor}; color: white; padding: 20px; border-radius: 10px; margin-bottom: 20px;">
                        <h3 style="margin: 0; font-size: 1.8em;">📋 ${categoryName}</h3>
                        <p style="margin: 10px 0 0 0; font-size: 1.2em; opacity: 0.9;">Total: ${count} orang</p>
                    </div>
            `;

            if (people.length > 0) {
                detailHTML += '<div style="max-height: 400px; overflow-y: auto;">';
                people.forEach((person, index) => {
                    const activity = person.activity ? person.activity : '-';
                    detailHTML += `
                        <div style="padding: 15px; margin-bottom: 10px; background: #f8f9fa; border-left: 4px solid ${categoryColor}; border-radius: 5px;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <strong style="font-size: 1.1em; color: #333;">${index + 1}. ${person.name}</strong>
                                    ${person.activity ? `<div style="color: #6c757d; margin-top: 5px; font-size: 0.9em;">${activity}</div>` : ''}
                                </div>
                            </div>
                        </div>
                    `;
                });
                detailHTML += '</div>';
            } else {
                detailHTML += `
                    <div style="text-align: center; padding: 40px; color: #6c757d;">
                        <p style="font-size: 1.1em;">📭 Tidak ada data untuk kategori ini</p>
                    </div>
                `;
            }

            detailHTML += '</div>';

            Swal.fire({
                title: `Detail ${categoryName}`,
                html: detailHTML,
                width: '600px',
                confirmButtonText: 'Tutup',
                confirmButtonColor: categoryColor,
                customClass: {
                    popup: 'detail-modal'
                }
            });
        }

        // Refresh data
        function refreshDataToday() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });

            Toast.fire({
                type: 'info',
                title: 'Memuat ulang data...'
            });

            fetchDataToday();
        }
    // END of Script Schedule Activity Today


    
</script>

@endsection
