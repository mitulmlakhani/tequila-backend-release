@extends('layouts.master')
@section('title')
    Branches
@endsection
@section('content')
    <!--Main Section Start-->
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-heading">
                        <h4>{{$restaurant->name}} - Branches</h4>
                        @can('floor-create')
                            <a href="{{ route('restaurant-list') }}" >Back</a>
                        @endcan
                    </div>
                </div>
                @include('layouts.flash-msg')
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-content p-3">
                        <table id="category_management" class="display nowrap w-100">
                            <thead>
                                <tr>
                                    <th scope="rowgroup">#</th>
                                    {{-- <th scope="rowgroup">Name</th> --}}
                                    <th scope="rowgroup">Branch Name</th>
                                    <th scope="rowgroup">Email </th>
                                    <th scope="rowgroup">Phone</th>
                                    <th scope="rowgroup">Created by </th>
                                    <th scope="rowgroup">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $branch)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        {{-- <td>{{ $branch->name }}</td> --}}
                                        <td>{{ $branch->branch_name }}</td>
                                        <td>{{ $branch->email }}</td>
                                        <td>{{ $branch->phone }}</td>
                                        <td>{{ $branch->createdBy->name }}</td>
                                        <td>
                                            <div class="{{ $branch->status == "Active" ? 'reserved' : 'pending' }}">
                                                <img src="{{ $branch->status == "Active" ? asset('assets/images/reserved.png') : asset('assets/images/pending.png') }}"
                                                    class="me-2" alt="{{ $branch->status ? 'reserved' : 'pending' }}">
                                                <span>{{ $branch->status == "Active" ? 'Active' : 'In-active' }}</span>
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
    </div>
    <!--Main Section End-->
@endsection
@section('js')
@endsection
