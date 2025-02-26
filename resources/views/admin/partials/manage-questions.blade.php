<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Questions</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main rounded-pill" onclick="showAddQuestionModal()">Add Question</button>
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
                <input type="text" id="searchInput" class="form-control h-40 border-transparent focus-border-main-600 bg-main-50" placeholder="Search questions...">
            </div>
            <div class="table-responsive">
                <table id="questionTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300" onclick="sortTable(0)">Category <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(1)">Question <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(2)">Type <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(3)">Option A <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(4)">Option B <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(5)">Option C <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(6)">Option D <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(7)">Correct Answer <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($questions as $question)
                        <tr id="question-row-{{ $question->id }}">
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->category_id }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">
                                @if($question->question_type == 'text')
                                    {{ $question->question_text }}
                                @else
                                    <img src="{{ asset('storage/' . $question->question_image) }}" alt="Question Image" style="max-width: 100px;">
                                @endif
                            </td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($question->question_type) }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->option_a }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->option_b }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->option_c }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->option_d }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $question->correct_answer }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-8">
                                    <button class="bg-main-50 text-danger-600 py-3 px-14 rounded hover-bg-danger-600 hover-text-white" onclick="confirmDeleteQuestion('{{ $question->id }}')"><i class="fas fa-trash"></i></button>
                                    <button class="bg-primary-100 text-success py-3 px-14 rounded hover-bg-success-600 hover-text-white" onclick="editQuestion('{{ $question->id }}', '{{ $question->question_type }}', '{{ $question->question_text }}', '{{ $question->question_image }}', '{{ $question->option_a }}', '{{ $question->option_b }}', '{{ $question->option_c }}', '{{ $question->option_d }}', '{{ $question->correct_answer }}', '{{ $question->category_id }}')"><i class="fas fa-edit"></i></button>
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
        table = document.getElementById('questionTable');
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

    // Fungsi untuk mengurutkan tabel
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById('questionTable');
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