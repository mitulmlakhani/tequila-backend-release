@extends('layouts.master')

@section('content')
    <!--Main Section Start-->
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="main-heading">
                            <div class="col-10 col-md-10 col-lg-10">
                                <h4>{{ trans('lang.expense') }}</h4>
                            </div>

                            <div class="col-2 col-md-2 col-lg-2">
                                @can($permission_prefix . 'create')
                                    <a href="javascript:void(0)" alt="viewPopBox" class="showActionPop" data-bs-toggle="modal">{{ trans('lang.add') }}
                                        {{ trans('lang.expense') }}
                                    </a>
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-content p-3">
                        <table id="expense_type" class="display nowrap w-100">
                            <thead>
                                <tr>
                                    <th scope="rowgroup">#</th>
                                    <th scope="rowgroup">{{ trans('lang.expense') }} {{ trans('lang.type') }} </th>
                                    <th scope="rowgroup">{{ trans('lang.expense') }} {{ trans('lang.name') }} </th>
                                    <th scope="rowgroup">{{ trans('lang.amount') }} </th>
                                    <th scope="rowgroup">{{ trans('lang.description') }} </th>
                                    <th scope="rowgroup">{{ trans('lang.created_by') }}</th>
                                    <th scope="rowgroup">{{ trans('lang.createAt') }}</th>
                                    <th scope="rowgroup">{{ trans('lang.status') }}</th>
                                    <th scope="rowgroup">{{ trans('lang.action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($dataList) > 0)
                                    @foreach ($dataList as $kys => $vls)
                                        <tr>
                                            <td>{{ $kys + 1 }}</td>
                                            <td> {{ $vls->expensesType->expense_type }} </td>
                                            <td> {{ $vls->expense_category }} </td>
                                            <td> {{ $vls->expense_amount }} </td>
                                            <td> {{ $vls->expense_description }} </td>
                                            <td> {{ $vls->createdBy->name }} </td>
                                            <td> {{ dateFormat($vls->created_at) }} {{ timeFormat($vls->created_at) }} </td>
                                            <td>
                                                @if ($vls->status == 0)
                                                    <div class="pending">
                                                        <img src="{{ asset('assets/images/pending.png') }}" alt="reserved"
                                                            class="me-2">
                                                        <span>{{ trans('lang.inactive') }}</span>
                                                    </div>
                                                @elseif($vls->status == 1)
                                                    <div class="reserved">
                                                        <img src="{{ asset('assets/images/reserved.png') }}" alt="reserved"
                                                            class="me-2">
                                                        <span>{{ trans('lang.active') }}</span>
                                                    </div>
                                                @endif

                                            </td>
                                            <td>

                                                <span class="me-2">
                                                    @can($permission_prefix . 'edit')
                                                        <a aria-hidden="true" id="{{ $vls->id }}"
                                                            class="editExpenseTypeForm" href="javascript:void(0)" edit-atr="{{ $vls->id }}">
                                                            <img src="{{ asset('assets/images/edit.png') }}" alt="edit">
                                                        </a>
                                                    @endcan
                                                </span>

                                                <span class="me-2">
                                                    @can($permission_prefix . 'delete')
                                                        {!! Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => [$base_route . '.destroy', $vls->id],
                                                            'style' => 'display:inline',
                                                        ]) !!}
                                                        <a href="javascript:void(0)"  aria-hidden="true" id="" class="confirm-button">
                                                            <img src="{{ asset('assets/images/dustbin.png') }}" alt="dustbin">
                                                        </a>
                                                        {!! Form::close() !!}
                                                    @endcan
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main Section End-->

    <!--Modal Popup Add start-->
    <div class="modal fade" id="viewPopBox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="viewPopBoxLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-6 col-md-6 col-lg-6">
                        <h5 class="modal-title" id="viewPopBoxLabel">{{ trans('lang.add') }}
                            {{ trans('lang.expense') }} {{ trans('lang.type') }}</h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                {!! Form::open([
                    'route' => 'expenses.store',
                    'method' => 'POST',
                    'id' => 'actionForm',
                    'name' => 'actionForm',
                ]) !!}
                <span id="patch"> <!-- update record with form--></span>
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-6 col-md-6 col-lg-6">
                            <label class="form-label" for="expenses_type_id"> {{ trans('lang.expense') }}
                                {{ trans('lang.type') }}s</label>
                            {{ Form::select('expenses_type_id', getExpensesType('', 'expensesType'), null, [
                                'class' => 'form-select',
                                'id' => 'expenses_type_id',
                            ]) }}

                            @error('expenses_type_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6 col-md-6 col-lg-6">
                            <label class="form-label" for="expense_category">{{ trans('lang.expense') }}
                                {{ trans('lang.name') }}
                            </label>
                            {!! Form::text('expense_category', null, [
                                'placeholder' => trans('lang.expense'),
                                'class' => 'form-control max30Length',
                                'id' => 'expense_category',
                                'required',
                            ]) !!}

                            @error('expense_category')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6 col-md-6 col-lg-6">
                            <label class="form-label" for="expense_amount">{{ trans('lang.amount') }}
                            </label>
                            {!! Form::text('expense_amount', old('expense_amount'), [
                                'placeholder' => 'Enter'. trans('lang.amount'),
                                'class' => 'form-control max30Length',
                                'id' => 'expense_amount',
                                'required',
                            ]) !!} 
                            
                            @error('expense_amount')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-6 col-md-6 col-lg-6">
                            <label class="form-label" for="status">{{ trans('lang.status') }} </label>
                            {{ Form::select('status', ['' => 'Select Status', 1 => 'Active', 0 => 'Inactive'], null, [
                                'class' => 'form-select',
                                'id' => 'status',
                            ]) }}

                            @error('status')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-12 col-md-12 col-lg-12">
                            <label class="form-label" for="expense_description">{{ trans('lang.description') }}</label>
                            {!! Form::textarea('expense_description', null, [
                                'placeholder' => trans('lang.expense') . ' ' . trans('lang.description'),
                                'class' => 'form-control',
                                'id' => 'expense_description',
                                'rows' => '3',
                            ]) !!}
                            @error('expense_description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                    <button type="button" id="submit_button"
                        class="btn btn-primary submit_button">{{ __(trans('lang.add')) }}</button>
                    <button class="btn btn-primary button_loader" id="button_loader" style="display: none;" disabled>
                        <i class="fa fa-spinner fa-spin"></i> <span class="btnLoaderName">{{ __(trans('lang.add')) }}
                        </span>
                    </button>
                </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
    <!--Modal Popup Add end-->

    <!--Modal Popup Edit start-->
    <div class="modal fade" id="deleteRole" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleLabel">Delete Expense Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="delete-img">
                        <img src="assets/images/delete.png" alt="delete" class="img-fluid">
                    </div>
                    <div class="modalcontent">
                        <h4 class="text-center mt-3">Are you Sure?</h4>
                        <p class="text-center mt-3">Do you really want to delete these records? This process
                            cannot be undone.</p>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>
    <!--Modal Popup Edit end-->

@endsection
