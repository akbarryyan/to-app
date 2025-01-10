<div class="dashboard-body">
    <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
        <!-- Breadcrumb Start -->
        <div class="breadcrumb mb-24">
            <ul class="flex-align gap-4">
                <li><a href="{{ route('admin.dashboard') }}" class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                <li><span class="text-main-600 fw-normal text-15">Categories</span></li>
            </ul>
        </div>
        <!-- Breadcrumb End -->

        <!-- Breadcrumb Right Start -->
        <div class="flex-align gap-8 flex-wrap">
            <button class="btn btn-main rounded-pill" onclick="showAddCategoryModal()">Add Category</button>
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
                <input type="text" id="searchInput" class="form-control h-40 border-transparent focus-border-main-600 bg-main-50" placeholder="Search categories...">
            </div>
            <div class="table-responsive">
                <table id="categoryTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300" onclick="sortTable(0)">Name <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(1)">Description <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(2)">Duration <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300" onclick="sortTable(3)">Tryout <i class="fas fa-sort cursor-pointer"></i></th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr id="category-row-{{ $category->id }}">
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $category->name }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $category->description }}</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $category->duration }} minutes</td>
                            <td class="h6 mb-0 fw-medium text-gray-300">{{ $category->tryout->name }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-8">
                                    <button class="bg-main-50 text-danger-600 py-3 px-14 rounded hover-bg-danger-600 hover-text-white" onclick="confirmDeleteCategory('{{ $category->id }}')"><i class="fas fa-trash"></i></button>
                                    <button class="bg-primary-100 text-success py-3 px-14 rounded hover-bg-success-600 hover-text-white" onclick="editCategory('{{ $category->id }}', '{{ $category->name }}', '{{ $category->description }}', '{{ $category->duration }}', '{{ $category->tryout_id }}')"><i class="fas fa-edit"></i></button>
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