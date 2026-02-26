@extends('layouts.master')
@section('title')
    Category Schedules
@endsection

@section('content')

<style>
.select2-container {
    position: relative !important;
    top: 0 !important;
    left: 0 !important;
}
</style>


    <!--Main Section Start-->
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12 col-md-3 col-lg-3">
                    <div class="main-heading">
                        <h4>Add Category Schedule</h4>
                    </div>
                    @include('layouts.flash-msg')
                    <div class="main-content p-3">
                        <form action="{{ route('category-schedule-create') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="title">Title</label>
                                <input type="text" placeholder="Title" id="title" name="title"
                                        class="form-control max30Length" required value="{{ old('title', '') }}">
                                @error('title')
                                    <div class="validation-error text-danger">{{ $message }}</div>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="status">Status </label>
                                <select class="form-select" id="status" name="status">
                                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>In-active</option>
                                </select>
                                @error('status')
                                    <div class="text-danger validation-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Happy Hours Days</label>
                                <br />
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input" type="checkbox" id="all_days">
                                    <label class="form-check-label" for="all_days">All</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="monday" value="monday">
                                    <label class="form-check-label" for="monday">Mon</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="tuesday" value="tuesday">
                                    <label class="form-check-label" for="tuesday">Tue</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="wednesday" value="wednesday">
                                    <label class="form-check-label" for="wednesday">Wed</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="thursday" value="thursday">
                                    <label class="form-check-label" for="thursday">Thu</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="friday" value="friday">
                                    <label class="form-check-label" for="friday">Fri</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="saturday" value="saturday">
                                    <label class="form-check-label" for="saturday">Sat</label>
                                </div>
                                <div class="form-check form-check-inline col-2 mt-2">
                                    <input class="form-check-input days_checkbox" name="days[]" type="checkbox" id="sunday" value="sunday">
                                    <label class="form-check-label" for="sunday">Sun</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-12 ">
                                        <label class="form-label" for="happy_hour_times">From</label>
                                        <div class="d-flex gap-1">
                                            <select class="form-select" name="from_hour" id="from_hour">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                    @endphp
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endfor
                                            </select>
                                            <select class="form-select" name="from_minute" id="from_minute">
                                                @for ($i = 1; $i <= 59; $i++)
                                                    @php
                                                        $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                    @endphp
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endfor
                                            </select>
                                            <select class="form-select" name="from_ampm" id="from_ampm">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12  mt-3">
                                        <label class="form-label" for="happy_hour_times">To</label>
                                        <div class="d-flex gap-1">
                                            <select class="form-select" name="to_hour" id="to_hour">
                                                @for ($i = 1; $i <= 12; $i++)
                                                    @php
                                                        $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                    @endphp
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endfor
                                            </select>
                                            <select class="form-select" name="to_minute" id="to_minute">
                                                @for ($i = 1; $i <= 59; $i++)
                                                    @php
                                                        $val = str_pad($i, 2, '0', STR_PAD_LEFT);
                                                    @endphp
                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                @endfor
                                            </select>
                                            <select class="form-select" name="to_ampm" id="to_ampm">
                                                <option value="AM">AM</option>
                                                <option value="PM">PM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="categories">Categories</label>
                                <select class="form-select checkbox-select" data-containerId="categories-dd-container" id="categories" name="categories[]" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                <div id="categories-dd-container" class="dd-container"></div>
                                @error('categories')
                                    <div class="text-danger validation-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Save</button>
                            <button id="category-add" type="reset" class="btn btn-primary">Cancel</button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-9 col-lg-9">
                    <div class="main-content p-3">
                        <table id="category_management" class="display nowrap w-100">
                            <thead>
                                <tr>
                                    <th scope="rowgroup">#</th>
                                    <th scope="rowgroup">Title</th>
                                    <th scope="rowgroup">Time</th>
                                    <th scope="rowgroup">Days</th>
                                    <th scope="rowgroup">Status</th>
                                    <th scope="rowgroup">Categories</th>
                                    <th scope="rowgroup">Action</th>
                                </tr>
                            </thead>
                            <tbody id="category_rows">
                                @foreach ($schedules as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($schedule['title']) }}</td>
                                        <td>{{ $schedule['from_time'] }} - {{ $schedule['to_time'] }}</td>
                                        <td class="d-flex flex-wrap gap-1">
                                            @php echo implode(" ", array_map(function($i) {
                                                return '<span class="badge bg-secondary fs-6">' . $i .'</span>';
                                            }, $schedule['days']));
                                            @endphp
                                        </td>
                                        <td>
                                            <div class="{{ $schedule['status'] ? 'reserved' : 'pending' }}">
                                                <img src="{{ $schedule['status'] ? asset('assets/images/reserved.png') : asset('assets/images/pending.png') }}"
                                                    class="me-2" alt="{{ $schedule['status'] ? 'reserved' : 'pending' }}">
                                                <span>{{ $schedule['status'] ? 'Active' : 'In-active' }}</span>
                                            </div>
                                        </td>
                                        <td class="d-flex flex-wrap gap-1">
                                            @php echo implode(" ", array_map(function($i) {
                                                return '<span class="badge bg-secondary fs-6">' . $i .'</span>';
                                            }, $schedule['categories']))
                                            @endphp
                                        </td>
                                        <td>
                                            <span class="me-2">
                                                @can('category-schedule-edit')
                                                    <a aria-hidden="true" href="#" id="category-edit"
                                                        data-bs-toggle="modal" data-id="{{ $schedule['id'] }}"
                                                        data-bs-target="#category-add-modal" data-bs-whatever="@mdo">
                                                        <img src="{{ asset('assets/images/edit.png') }}" alt="edit">
                                                    </a>
                                                @endcan
                                            </span>
                                            <span>
                                                @can('category-schedule-delete')
                                                    <a aria-hidden="true" href="#" data-bs-toggle="modal" id="deleteCategory"
                                                        data-bs-target="#deleteCategoryModal"
                                                        data-url="{{ route('category-schedule-delete', ['id' => $schedule['id']]) }}">
                                                        <img src="{{ asset('assets/images/dustbin.png') }}" alt="dustbin">
                                                    </a>
                                                @endcan
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main Section End-->

    <!--Delete Modal Popup Start-->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteRoleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleLabel">Delete Category Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="delete-img">
                        <img src="{{ asset('assets/images/delete.png') }}" alt="delete" class="img-fluid">
                    </div>
                    <div class="modalcontent">
                        <h4 class="text-center mt-3">Are you Sure?</h4>
                        <p class="text-center mt-3">Do you really want to delete ? <br>This process cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" class="btn btn-primary" id="deleteCategoryBtn">Delete</a>
                </div>
            </div>
        </div>
    </div>
    <!--Delete Modal Popup end-->

@endsection
@section('js')
    <script>
        @if(Session::has('errors'))
            var isValidationError = true;
        @else
            var isValidationError = false;
        @endif

        var categoryCreateUrl = '{{ route('category-schedule-create') }}';
        var categoryUpdateUrl = '{{ route('category-schedule-edit', ':id') }}';
        var categoryDetailUrl = '{{ route('category-schedule', ':id') }}';
    </script>

    <script src="{{ asset('assets/js/category-schedule.js') }}"></script>    

    <script>
        $(document).ready(function () {
            window.initCheckboxSelect();
        })
    </script>
@endsection

