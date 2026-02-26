@extends('layouts.master')
@section('title')
    Role Permissions
@endsection
@section('content')
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12">
                    <div class="main-heading">
                        <h4>Role Permission</h4>
                    </div>
                </div>
                @include('layouts.flash-msg')
                @include('layouts.validation-error-msg')
                <div class="col-12">
                    <div class="main-content p-3">
                        {!! Form::open(['route' => 'role-permission.store', 'method' => 'POST', 'id' => 'update-permissions']) !!}
                        <div id="role-warning" class="alert alert-danger d-none mt-2">
                            Please select a role first.
                        </div>
                        <div class="row main-heading align-items-end g-2">
                            <div class="col-lg-4">
                                {!! Form::select('roles', $data['role'], null, [
                                    'class' => 'form-select',
                                    'required',
                                    'id' => 'loadpermission',
                                    'placeholder' => 'Select Role'
                                ]) !!}
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-secondary" id="select-all-permissions">Select All Permissions</button>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-outline-primary w-100 d-none" id="apply-default-permissions">
                                    Apply Default Role Permissions
                                </button>
                            </div>
                            <div class="col-lg-2">
                                @can('role-permission-store')
                                    <button type="submit" class="btn btn-primary float-end">Save</button>
                                @endcan
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 mt-3">

                            <div class="row p-4">
                                <div class="col-6">
                                    <h2 class="mb-3">Back Office Permissions</h2>
                                    @foreach ($data['allpermissions']['web'] as $groupName => $permissions)
                                        @php $groupId = strtolower('pos_' . str_replace([' ', '/'], '_', $groupName)); @endphp
                                        <div class="mb-4">

                                            <div class="me-3">
                                                <input type="checkbox" class="form-check-input select-all-group" data-group="group_{{ $groupId }}" id="group_check_{{ $groupId }}"
                                                data-group="group_{{ $groupId }}">
                                                <label for="group_check_{{ $groupId }}" class="ms-1">
                                                    <h4>{{ $groupName }}</h4>
                                                </label>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                <div class="col-lg-4">
                                                    <div class="me-3 mb-2">
                                                        <input type="checkbox" class="form-check-input permission_checkbox permisisoncheck{{ $permission->id }} group_{{ $groupId }}"
                                                            name="permission[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}" data-group="group_{{ $groupId }}">
                                                        <label for="perm_{{ $permission->id }}" class="ms-1">
                                                            {{ $permission->display_name }}
                                                        </label>
                                                    </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-6">
                                    <h2 class="mb-3">Pos Permissions</h2>
                                    @foreach ($data['allpermissions']['api'] as $groupName => $permissions)
                                        @php $groupId = strtolower('pos_' . str_replace([' ', '/'], '_', $groupName)); @endphp
                                        <div class="mb-4">

                                            <div class="me-3">
                                                <input type="checkbox" class="form-check-input select-all-group" data-group="group_{{ $groupId }}"  id="group_check_{{ $groupId }}">
                                                <label for="group_check_{{ $groupId }}" class="ms-1">
                                                    <h4>{{ $groupName }}</h4>
                                                </label>
                                            </div>

                                            <div class="row">
                                                @foreach ($permissions as $permission)
                                                    <div class="col-lg-4">
                                                        <div class="me-3 mb-2">
                                                            <input type="checkbox" class="form-check-input permission_checkbox permisisoncheck{{ $permission->id }} group_{{ $groupId }}"
                                                                name="permission[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}">
                                                            <label for="perm_{{ $permission->id }}" class="ms-1">
                                                                {{ ucwords(str_replace(['_', '-'], ' ', $permission->display_name)) }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    const loadRolePermissionUrl = '{{ route('load-role-permission') }}';
    const loadDefaultPermissionUrl = '{{ route('load-default-permissions') }}';
</script>
<script src="{{ asset('assets/js/role-permission.js') }}"></script>    
@endsection
