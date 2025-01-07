<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Tryouts</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main rounded-pill" onclick="showAddTryoutModal()">Add Tryout</button>
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
        <div class="card-body" style="padding: 20px">
            <div class="search-box input-group" style="max-width: 300px; margin-bottom: 10px;">
                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                <input type="text" id="searchInput" class="form-control h-40 border-transparent focus-border-main-600 bg-main-50" placeholder="Search tryouts...">
            </div>
            <div class="table-responsive">
                <table id="tryoutTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300" onclick="sortTable(0)">Name <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(1)">Description <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(2)">Start Date <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(3)">End Date <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(4)">Price <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(5)">Paid <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tryouts as $tryout)
                        <tr id="tryout-row-{{ $tryout->id }}">
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $tryout->name }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $tryout->description }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $tryout->start_date }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $tryout->end_date }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">Rp. {{ number_format($tryout->price, 0) }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{!! $tryout->is_paid ? '<i class="fas fa-check-circle text-success"></i>' : '<i class="fas fa-times-circle text-danger"></i>' !!}</td>
                            <td>
                                <div class="d-flex align-items-center gap-8">
                                    <button class="bg-main-50 text-danger-600 py-3 px-14 rounded hover-bg-danger-600 hover-text-white" onclick="confirmDelete('{{ $tryout->id }}')"><i class="fas fa-trash"></i></button>
                                    <button class="bg-primary-100 text-success py-3 px-14 rounded hover-bg-success-600 hover-text-white" onclick="editTryout('{{ $tryout->id }}', '{{ $tryout->name }}', '{{ $tryout->description }}', '{{ $tryout->start_date }}', '{{ $tryout->end_date }}', '{{ $tryout->price }}', '{{ $tryout->is_paid }}')"><i class="fas fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk pencarian
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('tryoutTable');
        tr = table.getElementsByTagName('tr');

        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = 'none';
            td = tr[i].getElementsByTagName('td');
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = '';
                        break;
                    }
                }
            }
        }
    });

    function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById('tryoutTable');
            switching = true;
            dir = 'asc'; 

            while (switching) {
                switching = false;
                rows = table.rows;

                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName('TD')[n];
                    y = rows[i + 1].getElementsByTagName('TD')[n];

                    if (dir == 'asc') {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == 'desc') {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }

                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    switchcount++;
                } else {
                    if (switchcount == 0 && dir == 'asc') {
                        dir = 'desc';
                        switching = true;
                    }
                }
            }
        }
</script>