<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="index.html" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Students</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <div class="position-relative text-gray-500 flex-align gap-4 text-13">
                <span class="text-inherit">Sort by: </span>
                <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                    <span class="text-lg"><i class="ph ph-funnel-simple"></i></span>
                    <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center">
                        <option value="1" selected>Popular</option>
                        <option value="1">Latest</option>
                        <option value="1">Trending</option>
                        <option value="1">Matches</option>
                    </select>
                </div>
            </div>
            <div class="flex-align text-gray-500 text-13 border border-gray-100 rounded-4 ps-20 focus-border-main-600 bg-white">
                <span class="text-lg"><i class="ph ph-layout"></i></span>
                <select class="form-control ps-8 pe-20 py-16 border-0 text-inherit rounded-4 text-center" id="exportOptions">
                    <option value="" selected disabled>Export</option>
                    <option value="csv">CSV</option>
                    <option value="json">JSON</option>
                </select>
            </div>
        </div>
        <!-- Breadcrumb Right End -->
    </div>
   

    <div class="card overflow-hidden">
        <div class="card-body p-0 overflow-x-auto">
            <table id="studentTable" class="table table-striped">
                <thead>
                    <tr>
                        <th class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox" id="selectAll">
                            </div>
                        </th>
                        <th class="h6 text-gray-300">Students</th>
                        <th class="h6 text-gray-300">Email ID</th>
                        <th class="h6 text-gray-300">Courses</th>
                        <th class="h6 text-gray-300">Certificates Earned</th>
                        <th class="h6 text-gray-300">Status</th>
                        <th class="h6 text-gray-300">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="https://html.themeholy.com/edmate/assets/images/thumbs/student-img1.png" alt="" class="w-40 h-40 rounded-circle">
                                <span class="h6 mb-0 fw-medium text-gray-300">Jane Cooper</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">example10mail.com</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">12</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">10</span>
                        </td>
                        <td>
                            <span class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                In Progress
                            </span>
                        </td>
                        <td>
                            <a href="#" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View More</a>
                        </td>
                    </tr>
                    <tr>
                        <td class="fixed-width">
                            <div class="form-check">
                                <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                            </div>
                        </td>
                        <td>
                            <div class="flex-align gap-8">
                                <img src="https://html.themeholy.com/edmate/assets/images/thumbs/student-img2.png" alt="" class="w-40 h-40 rounded-circle">
                                <span class="h6 mb-0 fw-medium text-gray-300">Guy Hawkins</span>
                            </div>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">example10mail.com</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">18</span>
                        </td>
                        <td>
                            <span class="h6 mb-0 fw-medium text-gray-300">12</span>
                        </td>
                        <td>
                            <span class="text-13 py-2 px-8 bg-warning-50 text-warning-600 d-inline-flex align-items-center gap-8 rounded-pill">
                                <span class="w-6 h-6 bg-warning-600 rounded-circle flex-shrink-0"></span>
                                In Progress
                            </span>
                        </td>
                        <td>
                            <a href="#" class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View More</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer flex-between flex-wrap">
            <span class="text-gray-900">Showing 1 to 10 of 12 entries</span>
            <ul class="pagination flex-align flex-wrap">
                <li class="page-item active">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">...</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">8</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">9</a>
                </li>
                <li class="page-item">
                    <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">10</a>
                </li>
            </ul>
        </div>
    </div>
</div>
<script>    

    // ========================== Export Js Start ==============================
    document.getElementById('exportOptions').addEventListener('change', function() {
        const format = this.value;
        const table = document.getElementById('studentTable');
        let data = [];
        const headers = [];
        
        // Get the table headers
        table.querySelectorAll('thead th').forEach(th => {
            headers.push(th.innerText.trim());
        });

        // Get the table rows
        table.querySelectorAll('tbody tr').forEach(tr => {
            const row = {};
            tr.querySelectorAll('td').forEach((td, index) => {
                row[headers[index]] = td.innerText.trim();
            });
            data.push(row);
        });

        if (format === 'csv') {
            downloadCSV(data);
        } else if (format === 'json') {
            downloadJSON(data);
        }
    });

    function downloadCSV(data) {
        const csv = data.map(row => Object.values(row).join(',')).join('\n');
        const blob = new Blob([csv], { type: 'text/csv' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'students.csv';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

    function downloadJSON(data) {
        const json = JSON.stringify(data, null, 2);
        const blob = new Blob([json], { type: 'application/json' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'students.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }
    // ========================== Export Js End ==============================

    // Table Header Checkbox checked all js Start
    $('#selectAll').on('change', function () {
        $('.form-check .form-check-input').prop('checked', $(this).prop('checked')); 
    }); 

    // Data Tables
    new DataTable('#studentTable', {
        searching: false,
        lengthChange: false,
        info: false,   // Bottom Left Text => Showing 1 to 10 of 12 entries
        paging: false, // Pagination False
        "columnDefs": [
            { "orderable": false, "targets": [0, 6] } // Disables sorting on the 7th column (index 6)
        ]
    });
</script>