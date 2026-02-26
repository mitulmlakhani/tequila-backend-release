@extends('layouts.master')
@section('title')
    Items
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('editor/summernote-lite.min.css') }}">
    <style>
        th {
            border-top: 1px solid #dddddd;
            border-bottom: 1px solid #dddddd;
            border-right: 1px solid #dddddd;
        }

        th:first-child {
            border-left: 1px solid #dddddd;
        }

        .modal.fade:not(.in).right .modal-dialog {
            -webkit-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }
        
        .accordion-button {
            display: block;
        }

        .lg-checkbox{
            width: 30px;
            height: 30px;
        }

        .text-align-center{
            text-align: center !important;
        }

        .accordion-header{
            border-bottom: 1px solid #d1d1d1;
        }

        .fs-20{
            font-size: 20px;
        }
        .form-select{
            padding: 0rem 2.25rem .05rem .75rem !important;
        }
        .dt-button:hover{
            background-color:#0980B2 !important;
            background: linear-gradient(to bottom, #0980B2 0%, #0980B2 100%) !important;
        }
        /* sticky header */
        .dataTables_scrollHead {
            position: sticky;
            z-index: 1020;
            background: white;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css">

    <style>
        /* .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            display: none;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
                all: unset;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__rendered {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        } */

        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: white;
            color: #000;
        }

        .select2-check {
            height: 20px;
            width: 20px;
        }

        /* Item image upload styles */
        .item-image-container {
            min-width: 80px;
        }
        .item-image-container img {
            border-radius: 4px;
            object-fit: cover;
        }
        .item-image-container .btn {
            cursor: pointer;
        }
        .item-image-container label.btn {
            margin-bottom: 0;
        }

        /* Summernote recipe editor styles */
        .recipe-preview {
            cursor: pointer;
            max-width: 200px;
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
@endsection
@section('content')
    <!--Main Section Start-->
    <div class="wrapper home-section" id="full-width">
        <div class="container-fluid p-4">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-heading">
                        <h4>Items Management</h4>
                    </div>
                </div>
                @include('layouts.flash-msg')
                @include('layouts.validation-error-msg')
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="main-content p-3">
                        <div style="overflow-x: auto;">
                            <table id="item_list_table" class="display nowrap w-100 cell-border">
                                <thead>
                                    <tr>
                                        <th scope="rowgroup"><svg style="visibility: hidden;" class=" svg-inline--fa fa-trash fa-w-14" aria-hidden="true" data-fa-processed="" data-prefix="fa" data-icon="trash" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z"></path></svg></th>
                                        <th scope="rowgroup">#</th>
                                        <th scope="rowgroup">Item Name</th>
                                        <th scope="rowgroup">
                                            Category Name
                                            <select id="category_filter" class="form-select">
                                                <option disabled value="">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option {{ $category->id == $categoryId ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="rowgroup">Price</th>
                                        <th scope="rowgroup">
                                            Item Type
                                            <select id="item_tag_filter" class="form-select">
                                                <option value="">Select Item Tag</option>
                                                @foreach($itemTags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="rowgroup">Item Image</th>
                                        <th scope="rowgroup">Color</th>
                                        <th scope="rowgroup">Font Color</th>
                                        <th scope="rowgroup">
                                            Modifier Groups
                                            <br />
                                            <div class="fw-normal" id="category_modifier_list"></div>
                                            <i class="fa fa-plus category_associate_modifier" style="cursor:pointer;" data-category_id=""></i>
                                        </th>
                                        <th scope="rowgroup"> Ingredient</th>
                                        <th scope="rowgroup"> Variants</th>
                                        {{-- <th scope="rowgroup">Modifiers Group</th> --}}
                                        {{-- <th scope="rowgroup">Force Modifiers Group</th> --}}
                                        <th scope="rowgroup">Preparation Time</th>
                                        <th scope="rowgroup">Recipe</th>
                                        <th scope="rowgroup">Available In</th>
                                        <th scope="rowgroup">UOM</th>
                                        <th scope="rowgroup">
                                            KDS Devices <br/>
                                            <select id="kds_device_filter" class="form-control checkbox-select" multiple="multiple">
                                                <option value="select_all">Select All</option>    
                                                @foreach($posDevices->where('type', 'kds') as $device)
                                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="rowgroup">
                                            Printer Devices <br/>
                                            <select id="printer_device_filter" class="form-control checkbox-select" multiple="multiple">
                                                <option value="select_all">Select All</option>
                                                @foreach($posDevices->where('type', 'printer') as $device)
                                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                        <th scope="rowgroup">Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Main Section End-->
    <!--Modal Popup Edit start-->
    <div class="modal fade" id="deleteItemModal" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRoleLabel">Delete Item</h5>
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
                    <a href="#" class="btn btn-primary" id="deleteItemBtn">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!--Modal Popup Edit start-->
    <div class="modal fade right" id="addModifier" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                
            </div>
        </div>
    </div>


    <!-- Default Modal Structure -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to apply this action to all items?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content set dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmAction">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warningModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Please select a category before updating the item type.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dangerModal" tabindex="-1" aria-labelledby="dangerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dangerModalLabel">Warning</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="dangerModalBody">
                    <!-- Content set dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Recipe Editor Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1" aria-labelledby="recipeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recipeModalLabel">Edit Recipe</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="recipe_item_id" value="">
                    <textarea id="recipe_editor"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveRecipeBtn">Save Recipe</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('editor/summernote-lite.min.js') }}"></script>
    <script>
        // var itemListUrl = '{{ route('item-list', ['categoryId' => ':categoryId']) }}';
        var itemListUrl = '{{ route('item-list') }}';
        var categoryId = "{{ empty($categoryId) ? '' : $categoryId }}";
        // itemListUrl = itemListUrl.replace(':categoryId', categoryId);
        var itemsDynamicOptionsUrl = '{{ route('item-dynamic-options') }}';

        var itemAssociateModifiersUrl = '{{ route('associate-modifiers', ['itemId' => ':itemId']) }}';
        var categoryAssociateModifiersUrl = '{{ route('category-associate-modifiers', ['categoryId' => ':categoryId']) }}';
        var itemAddModifierUrl = '{{ route('add-modifier-group', ['itemId' => ':itemId','modifierGroupId'=>':modifierGroupId']) }}';
        var bulk_update = '{{ route('items.update') }}';
        var itemUploadImageUrl = '{{ route('item-upload-image', ['itemId' => ':itemId']) }}';
        var itemDeleteImageUrl = '{{ route('item-delete-image', ['itemId' => ':itemId']) }}';
    </script>
    <script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('assets/js/item.js') }}"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js"></script>
@endsection
