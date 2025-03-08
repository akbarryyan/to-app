<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Announcements</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main rounded-pill" onclick="showAddAnnouncementModal()">Add Announcement</button>
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
                <input type="text" id="searchInput" class="form-control h-40 border-transparent focus-border-main-600 bg-main-50" placeholder="Search announcements...">
            </div>
            <div class="table-responsive" id="announcements-table">
                <table id="announcementTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300" onclick="sortTable(0)">Title <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(1)">Message <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(2)">Created By <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(3)">Status <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($announcements as $announcement)
                        <tr id="announcement-row-{{ $announcement->id }}">
                            <td>
                                <div class="flex-align gap-8">
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $announcement->title }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">{{ $announcement->message }}</span>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">{{ $announcement->creator ? $announcement->creator->name : 'Unknown' }}</span>
                            </td>
                            <td>
                                <span class="h6 mb-0 fw-medium text-gray-300">{{ $announcement->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-8">
                                    <button class="bg-main-50 text-danger-600 py-3 px-14 rounded hover-bg-danger-600 hover-text-white" onclick="confirmDelete('{{ $announcement->id }}')"><i class="fas fa-trash"></i></button>
                                    <button class="bg-primary-100 text-success py-3 px-14 rounded hover-bg-success-600 hover-text-white" onclick="editAnnouncement('{{ $announcement->id }}', '{{ $announcement->title }}', '{{ $announcement->message }}', '{{ $announcement->is_active }}')"><i class="fas fa-edit"></i></button>
                                    <button class="bg-main-50 text-primary-600 py-3 px-14 rounded hover-bg-primary-600 hover-text-white" onclick="toggleAnnouncement('{{ $announcement->id }}')">
                                        <i class="fas {{ $announcement->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    </button>
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
    document.getElementById('searchInput').addEventListener('keyup', function() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toUpperCase();
        table = document.getElementById('announcementTable');
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
</script>