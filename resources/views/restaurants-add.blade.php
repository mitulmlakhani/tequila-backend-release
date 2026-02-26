@extends('layouts.master')
@section('title')
@if (empty($restaurant))
Add
@else
Edit
@endif Restaurant
@endsection
@section('css')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection

@section('content')
    <!--Main Section Start-->
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-heading">
                        <h4>
                            @if (empty($restaurant))
                                Add
                            @else
                                Edit
                            @endif Restaurant
                        </h4>
                        <a href="{{ URL::previous() }}">Back</a>
                    </div>
                </div>
                @include('layouts.flash-msg')
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-content p-3">
                        <form method="POST" id="restaurant_add">
                            @csrf
                        @if(!empty($restaurant))
                            <input type="hidden" name="is_edit" value="1">
                        @endif
                        <div class="row">
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label" for="name">Restaurant name</label>
                                <input type="text" placeholder="Restaurant Name" id="name" name="name"
                                    class="form-control" value="{{old('name', !empty($restaurant) ? $restaurant->name : '')}}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label" for="phone">Official Phone</label>
                                <input type="text" placeholder="(787) 898-9898" id="phone" name="phone"
                                    class="form-control max10Length" value="{{old('phone', !empty($restaurant) ? $restaurant->phone : '')}}" required onkeyup=formatPhone(this)>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3 col-12 col-md-3 col-lg-3">
                                <label class="form-label" for="open_time">Opening Time</label>
                                <input type="time" id="open_time" name="open_time"
                                    class="form-control" value="{{old('open_time', !empty($restaurant) ? ($restaurant->open_time ? \Carbon\Carbon::parse($restaurant->open_time)->format('H:i') : '') : '')}}" required autocomplete="off">
                                @error('open_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <div class="mb-3 col-12 col-md-3 col-lg-3">
                                <label class="form-label" for="close_time">Closing Time</label>
                                <input type="time" id="close_time" name="close_time"
                                    class="form-control" value="{{old('close_time', !empty($restaurant) ? ($restaurant->close_time ? \Carbon\Carbon::parse($restaurant->close_time)->format('H:i') : '') : '')}}" required autocomplete="off">
                                @error('close_time')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-2 col-lg-2">
                                <label class="form-label" for="dine_in_status"> Dine In Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id=" dine_in_status"
                                        name="dine_in_status" 
                                    @if(old('is_edit'))  
                                        @if(old('dine_in_status') == "on")  
                                            checked 
                                        @endif 
                                    @else 
                                        @if ((isset($restaurant->dine_in_status) && $restaurant->dine_in_status == 'Yes') || old('dine_in_status') == "on") 
                                            checked 
                                        @endif
                                    @endif>
                                @error('dine_in_status')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-md-2 col-lg-2">
                                <label class="form-label" for="take_away_status"> Take Away Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id=" take_away_status"
                                        name="take_away_status" 
                                    @if(old('is_edit'))  
                                        @if(old('take_away_status') == "on")  
                                            checked 
                                        @endif 
                                    @else 
                                        @if ((isset($restaurant->take_away_status) && $restaurant->take_away_status == 'Yes') || old('take_away_status') == "on") 
                                            checked 
                                        @endif
                                    @endif>
                                    @error('take_away_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-md-2 col-lg-2">
                                <label class="form-label" for="delivery_status"> Delivery Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id=" delivery_status"
                                        name="delivery_status" 
                                    @if(old('is_edit'))  
                                        @if(old('delivery_status') == "on")  
                                            checked 
                                        @endif 
                                    @else 
                                        @if ((isset($restaurant->delivery_status) && $restaurant->delivery_status == 'Yes') || old('delivery_status') == "on") 
                                            checked 
                                        @endif
                                    @endif>
                                    @error('delivery_status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label" for="address">Address</label>
                                <textarea type="text" rows="3" placeholder="Restaurant Address" id="address"
                                        name="address"class="form-control" required>{{old('address', !empty($restaurant) ? $restaurant->address : '')}}</textarea>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-3 col-lg-3">
                                <label class="form-label" for="timezone"> Timezone*</label>
                                <select class="form-select" id="timezone" name="timezone" required>
                                    <option value="">Select Timezone</option>
                                    @foreach($timezones as $timezone)
                                        <option value="{{ $timezone->name }}" @if (($restaurant->timezone ?? 'America/Chicago') == $timezone->name) selected @endif>
                                            {{ $timezone->title}} ({{ $timezone->abbreviation }}) {{ $timezone->offset }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('timezone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-3 col-md-3 col-lg-3">
                                <label class="form-label" for="add_status"> Restaurant Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="Active" @if (!empty($restaurant) && $restaurant->status == "Active") selected @endif>Active
                                    </option>
                                    <option value="In-active" @if (!empty($restaurant) && $restaurant->status == "In-active") selected @endif>
                                        In-active</option>
                                </select>
                            </div>
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_multi_branch" name="is_multi_branch" 
                                    @if(old('is_edit'))
                                        @if (old('is_multi_branch')) 
                                            checked 
                                        @endif
                                    @else
                                        @if(!empty($restaurant) && $restaurant->is_multi_branch || old('is_multi_branch')) 
                                            checked 
                                        @endif
                                    @endif>
                                    <label class="form-check-label" for="is_multi_branch">
                                    Is Multi Branch
                                    </label>
                                </div>
                                <div @if(!empty($restaurant) && $restaurant->is_multi_branch || old('is_multi_branch')) 
                                    style="display:block"
                                    @else 
                                    style="display:none"
                                @endif>
                                    <label class="form-label" for="max_branch_limit">Maximum Branch Limit</label>
                                    <input type="number" id="max_branch_limit" name="max_branch_limit" class="form-control numberInput" placeholder="Branch Limit" value="{{old('max_branch_limit', !empty($restaurant) ? $restaurant->max_branch_limit : '')}}">
                                    @error('max_branch_limit')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 col-12 col-md-6 col-lg-6">
                                <label class="form-label" for="website_name">Website Name (Unique sub domain name)</label>
                                <input type="text" id="website_name" name="website_name" class="form-control" placeholder="unique sub domain name" value="{{ old('website_name', !empty($restaurant) ? $restaurant->website_name : '') }}">
                                @error('website_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            @if (true)
                            <label class="" for=""><b>Credit card charge detail</b></label>
                            <hr>
                            <div class="mb-3 col-12 col-md-4 col-lg-4">
                                <label class="form-label" for="cc_fee_label">Credit Card Fee label</label>
                                <input type="text" id="cc_fee_label" name="cc_fee_label" class="form-control" placeholder="Credit Card Fee label" value="{{old('cc_fee_label', !empty($restaurant) ? $restaurant->cc_fee_label : '')}}" required>
                                @error('cc_fee_label')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-4 col-lg-4">
                                <label class="form-label" for="cc_fee">Credit Card Fee (in %)</label>
                                <input type="text" id="cc_fee" name="cc_fee" class="form-control percentageInput" placeholder="Credit Card Fee" value="{{old('cc_fee', !empty($restaurant) ? $restaurant->cc_fee : '')}}" required>
                                @error('cc_fee')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-4 col-lg-4">
                                <label class="form-label" for="cd_label">Cash Discount label</label>
                                <input type="text" id="cd_label" name="cd_label" class="form-control" placeholder="Cash Discount label" value="{{old('cd_label', !empty($restaurant) ? $restaurant->cd_label : '')}}" required>
                                @error('cd_label')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-12 col-md-4 col-lg-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_cc_fee_applicable" name="is_cc_fee_applicable" 
                                    @if(old('is_edit'))
                                        @if (old('is_cc_fee_applicable')) 
                                            checked 
                                        @endif
                                    @else
                                        @if(!empty($restaurant) && $restaurant->is_cc_fee_applicable || old('is_cc_fee_applicable')) 
                                            checked 
                                        @endif
                                    @endif>
                                    <label class="form-check-label" for="is_cc_fee_applicable">
                                      Is Credit Fee Applicable {{old('is_cc_fee_applicable')}}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="is_cc_fee_show" name="is_cc_fee_show" 
                                    @if(old('is_edit'))
                                        @if (old('is_cc_fee_show')) 
                                            checked 
                                        @endif
                                    @else
                                        @if(!empty($restaurant) && $restaurant->is_cc_fee_show || old('is_cc_fee_show')) 
                                            checked 
                                        @endif
                                    @endif>
                                    <label class="form-check-label" for="is_cc_fee_show">
                                      Is Credit Fee Show
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Dual Pricing Setting -->
                            <div class="mb-3 col-12 col-md-4 col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Dual Pricing Display</label>
                                    <select name="dual_pricing" id="dual_pricing" class="form-select">
                                        <option value="inter_change" {{ $dual_pricing == 'inter_change' ? 'selected' : '' }}>Inter Change Price</option>
                                        <option value="cash_discount" {{ $dual_pricing == 'cash_discount' ? 'selected' : '' }}>Cash Discount Price</option>
                                        <option value="dual_price" {{ $dual_pricing == 'dual_price' ? 'selected' : '' }}>Dual Price (Cash & Card)</option>
                                    </select>
                                    <small class="text-muted">If enabled, the receipt will display both cash and credit card prices.</small>
                                </div>
                            </div>
                            @endif
                            @if (empty($restaurant))
                            <label class="" for=""><b>User detail</b></label>
                            <hr>
                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="user_name">Name</label>
                                    <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Name" value="{{old('user_name')}}" required>
                                    @error('user_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="email"> Official Email</label>
                                    <input type="email" placeholder="Restaurant Name" id="email" name="email"
                                        class="form-control" value="{{old('email', !empty($restaurant) ? $restaurant->email : '')}}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" minlength="8" id="password" name="password" class="form-control" placeholder="Password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="c_password">Confirm Password</label>
                                    <input type="password" id="c_password" name="c_password"
                                        class="form-control" placeholder="Confirm Password" required>
                                    @error('c_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            
                            <label class="mt-5" for=""><b>Crypto Payment detail</b></label>
                            <hr>
                                @if(in_array(auth()->user()->email, config('crypto.btc_config_updater')))
                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="bitcoin_payment_address">Bitcoin Payment Address</label>
                                    <input type="text" id="bitcoin_payment_address" name="bitcoin_payment_address" class="form-control" placeholder="Bitcoin Payment Address" value="{{old('bitcoin_payment_address', !empty($restaurant) ? $restaurant->bitcoin_payment_address : '')}}">
                                    @error('bitcoin_payment_address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 col-12 col-md-6 col-lg-6">
                                    <label class="form-label" for="bitcoin_payment_fees">Bitcoin Payment Fees (%)</label>
                                    <input type="text" id="bitcoin_payment_fees" name="bitcoin_payment_fees" class="form-control" placeholder="Bitcoin Payment Fees (%)" value="{{ old('bitcoin_payment_fees', !empty($restaurant->bitcoin_payment_fees ?? null) ? $restaurant->bitcoin_payment_fees : \App\Models\AdminSetting::where('key', 'crypto_payment_fees')->value('value')) }}">
                                    @error('bitcoin_payment_fees')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                @endif

                            <label class="mt-5" for=""><b>Payment Methods</b></label>
                            <hr>
                            <div class="row">
                                @foreach ($paymentMethods as $method)
                                    @php
                                        $isActive = isset($restaurantPaymentMethods[$method->id]) && $restaurantPaymentMethods[$method->id] == '1';
                                    @endphp
                                    <div class="col-md-3 mb-3">
                                        <div class="border rounded p-3 shadow-sm d-flex justify-content-between align-items-center">
                                            <span class="fw-medium">{{ $method->name }}</span>
                                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                                <input type="checkbox"
                                                    class="form-check-input"
                                                    name="restaurant_payment_methods[]"
                                                    id="toggle_{{ $method->id }}"
                                                    {{ in_array($method->id, old('restaurant_payment_methods', [])) ? 'checked' : '' }}
                                                    value="{{ $method->id }}"
                                                    {{ $isActive ? 'checked' : '' }}>
                                                <label class="form-check-label small text-muted" for="toggle_{{ $method->id }}">
                                                    {{ $isActive ? 'Active' : 'Inactive' }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="row">
                                @foreach ($deliveryPartners as $key => $dp)
                                    @switch($dp['delivery_partner'])
                                        @case('ubereats')
                                            <input type="hidden" name="delivery_partners[{{ $key }}][delivery_partner]" value="{{ $dp['delivery_partner'] }}">
                                            <input type="hidden" name="delivery_partners[{{ $key }}][id]" value="{{ $dp['id'] }}">
                                            <div class="col-4">
                                                <label class="mt-5" for=""><b>UberEats</b></label>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="border rounded p-3 shadow-sm d-flex justify-content-between align-items-center">
                                                            <span class="fw-medium">Status</span>
                                                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                                                <input type="checkbox"
                                                                    class="form-check-input dp-status-toggle"
                                                                    name="delivery_partners[{{ $key }}][status]"
                                                                    id="toggle_{{ $dp['delivery_partner'] }}"
                                                                    value="1"
                                                                    {{ $dp['status'] ? 'checked' : '' }}>
                                                                <label class="form-check-label small text-muted" for="toggle_{{ $dp['delivery_partner'] }}">
                                                                    {{ $dp['status'] ? 'Active' : 'Inactive' }}
                                                                </label>
                                                            </div>
                                                        </div>

                                                        @if($dp['merchant_id'] ?? '')
                                                        <div class="row field-group mt-2 {{ $dp['status'] ? '' : 'd-none' }}">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="ubereats_merchant_id">Store Id</label>
                                                                    <input readonly type="text" id="ubereats_merchant_id" name="delivery_partners[{{ $key }}][merchant_id]" class="form-control" placeholder="Uber Eats Store Id" value="{{ $dp['merchant_id'] ?? '' }}">
                                                                    @error('merchant_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif

                                                        <div class="row field-group mt-2 {{ $dp['status'] ? '' : 'd-none' }}">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <a href="https://auth.uber.com/oauth/v2/authorize?client_id={{ $uberEatsClientId }}&response_type=code&redirect_uri={{ route('authorize-ubereats') }}?restaurantId={{$restaurant->id}}&scope=eats.pos_provisioning" class="btn btn-dark">{{ ($dp['merchant_id'] ?? null) ? 'Change Store' : 'Authorize UberEats' }}</a>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        @break

                                        @case("grubhub")
                                            <input type="hidden" name="delivery_partners[{{ $key }}][delivery_partner]" value="{{ $dp['delivery_partner'] }}">
                                            <input type="hidden" name="delivery_partners[{{ $key }}][id]" value="{{ $dp['id'] }}">
                                            <div class="col-4">
                                                <label class="mt-5" for=""><b>Grubhub</b></label>
                                                <hr>

                                                <div class="col-12">
                                                    <div class="border rounded p-3 shadow-sm d-flex justify-content-between align-items-center">
                                                        <span class="fw-medium">Status</span>
                                                        <div class="form-check form-switch d-flex align-items-center gap-2">
                                                            <input type="checkbox"
                                                                class="form-check-input dp-status-toggle"
                                                                name="delivery_partners[{{ $key }}][status]"
                                                                id="toggle_{{ $dp['delivery_partner'] }}"
                                                                value="1"
                                                                {{ $dp['status'] ? 'checked' : '' }}>
                                                            <label class="form-check-label small text-muted" for="toggle_{{ $dp['delivery_partner'] }}">
                                                                {{ $dp['status'] ? 'Active' : 'Inactive' }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                

                                                    <div class="row field-group mt-2 {{ $dp['status'] ? '' : 'd-none' }}">
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="grubhub_merchant_id">Store Id</label>
                                                                <input type="text" id="grubhub_merchant_id" name="delivery_partners[{{ $key }}][merchant_id]" class="form-control" placeholder="Grubhub Store Id" value="{{ $dp['merchant_id'] ?? '' }}">
                                                                @error('merchant_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="grubhub_issue_date">Issue Date (YYYY-MM-DD)</label>
                                                                <input type="text" id="grubhub_issue_date" name="delivery_partners[{{ $key }}][config][issue_date]" class="form-control" placeholder="Grubhub Issue Date" value="{{ $dp['config']['issue_date'] ?? ''}}">
                                                                @error('grubhub_issue_date')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="grubhub_client_id">Client Id</label>
                                                                <input type="text" id="grubhub_client_id" name="delivery_partners[{{ $key }}][config][client_id]" class="form-control" placeholder="Grubhub Client Id" value="{{ $dp['config']['client_id'] ?? ''}}">
                                                                @error('grubhub_client_id')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="grubhub_client_secret">Client Secret</label>
                                                                <input type="text" id="grubhub_client_secret" name="delivery_partners[{{ $key }}][config][client_secret]" class="form-control" placeholder="Grubhub Secret" value="{{ $dp['config']['client_secret'] ?? ''}}">
                                                                @error('grubhub_client_secret')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                        
                                        @case('doordash')
                                            <input type="hidden" name="delivery_partners[{{ $key }}][delivery_partner]" value="{{ $dp['delivery_partner'] }}">
                                            <input type="hidden" name="delivery_partners[{{ $key }}][id]" value="{{ $dp['id'] }}">
                                            <div class="col-4">
                                                <label class="mt-5" for=""><b>DoorDash</b></label>
                                                <hr>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="border rounded p-3 shadow-sm d-flex justify-content-between align-items-center">
                                                            <span class="fw-medium">Status</span>
                                                            <div class="form-check form-switch d-flex align-items-center gap-2">
                                                                <input type="checkbox"
                                                                    class="form-check-input dp-status-toggle"
                                                                    name="delivery_partners[{{ $key }}][status]"
                                                                    id="toggle_{{ $dp['delivery_partner'] }}"
                                                                    value="1"
                                                                    {{ $dp['status'] ? 'checked' : '' }}>

                                                                    <label class="form-check-label small text-muted" for="toggle_{{ $dp['delivery_partner'] }}">
                                                                        {{ $dp['status'] ? 'Active' : 'Inactive' }}
                                                                    </label>
                                                            </div>
                                                        </div>

                                                        <div class="row field-group mt-2 {{ $dp['status'] ? '' : 'd-none' }}">
                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="merchant_id">Store Id</label>
                                                                    <input type="text" id="doordash_merchant_id" name="delivery_partners[{{ $key }}][merchant_id]" class="form-control" placeholder="Doordash Store Id" value="{{ $dp['merchant_id'] ?? '' }}">
                                                                    @error('merchant_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="developer_id">Developer Id</label>
                                                                    <input type="text" id="developer_id" name="delivery_partners[{{ $key }}][config][developer_id]" class="form-control" placeholder="DoorDash Developer Id" value="{{ $dp['config']['developer_id'] ?? '' }}">
                                                                    @error('developer_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="key_id">Key ID</label>
                                                                    <input type="text" id="key_id" name="delivery_partners[{{ $key }}][config][key_id]" class="form-control" placeholder="DoorDash Key ID" value="{{ $dp['config']['key_id'] ?? '' }}">
                                                                    @error('key_id')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-12">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="signing_secret">Signing Secret</label>
                                                                    <input type="text" id="signing_secret" name="delivery_partners[{{ $key }}][config][signing_secret]" class="form-control" placeholder="DoorDash signing secret" value="{{ $dp['config']['signing_secret'] ?? '' }}">
                                                                    @error('signing_secret')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                    @endswitch
                                @endforeach
                            </div>

                            <div class="mb-3 mt-5 col-12 col-md-12 col-lg-12">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main Section End-->
@endsection
@section('js')
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <script>
        $(document).on("change", "#is_multi_branch", function() {
            if ($(this).is(':checked')){
                $("#max_branch_limit").parents('div').show()
                $("#max_branch_limit").attr('required',true);
            }else{
                $("#max_branch_limit").parent('div').hide()
                $("#max_branch_limit").attr('required',false);
            }
        });

        $(document).on("submit", "#restaurant_add", function() {
            $('button[type=submit]').prop('disabled', true);
        });
    </script>

    <script>
        $(document).ready(function () {
            $('.dp-status-toggle').on('change', function () {
                if ($(this).is(':checked')) {
                    $(this).closest('.col-12').find('.field-group').removeClass('d-none');
                } else {
                    $(this).closest('.col-12').find('.field-group').addClass('d-none');
                }
            });

            $('.select2').each(function () {
                $(this).
                $(this).select2({
                    dropdownParent: $(this).parent()
                });
            });

        });
    </script>

    <script>
        var website_name = "{{ old('website_name', !empty($restaurant) ? $restaurant->website_name : '') }}";

        if (!website_name) {
            $("#name").on("keyup change", function() {
                var name = $(this).val();
                var slug = name.toLowerCase().replace(/ /g,'-').replace(/[^\w-]+/g,'');
                $("#website_name").val(slug);
            });
        }
    </script>
@endsection
