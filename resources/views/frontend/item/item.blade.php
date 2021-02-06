@extends('layouts.frontend_master')

@section('content')
<div class="main-panel-without-sidebar">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ isset($item)? "UPDATE" : "CREATE" }} ITEM</h4>

                        <!-- start form -->
                        @if(isset($item))
                        <!-- update route -->
                        <form class="forms-sample" id="item_form" method="post" action="/items/{{$item->id}}">
                            <!-- form method spoofing -->
                            {{ method_field('PUT') }}


                            <input type="hidden" id="id" name="id" value="{{$item->id}}">

                            @else
                            <!-- store route -->
                            <form class="forms-sample" id="item_form" method="post" action="/items">
                                @endif

                                {{ csrf_field() }}

                                <!-- to use in redirect function when clicking cancel button on entry and edit pages -->
                                <input type="hidden" id="module" name="module" value="items">

                                <!-- start name field -->
                                <div class="form-group">
                                    <label for="name">Name<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('name') ? 'is-invalid' :''}}" id="name" name="name" autofocus="autofocus" placeholder="Enter item name" value="{{ isset($item)? $item->name : old('name') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('name')}}</p>
                                </div>
                                <!-- end name field -->

                                <!-- start price field -->
                                <div class="form-group">
                                    <label for="name">Price<span class="required_field">*</span></label>
                                    <input type="text" class="form-control {{$errors->has('price') ? 'is-invalid' :''}}" id="price" name="price" autofocus="autofocus" placeholder="Enter price" value="{{ isset($item)? $item->price : old('price') }}">
                                    <!-- validation error message -->
                                    <p class="text-danger">{{$errors->first('price')}}</p>
                                </div>
                                <!-- end price field -->

                                <!-- buttons -->
                                <button type="submit" class="btn btn-primary mr-2">Save</button>
                                <button id="cancel_button" class="btn btn-light">Cancel</button>
                                <!-- buttons -->
                            </form>
                            <!-- end form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection

    @section('page_script')
    <script type="text/javascript">
        $(document).ready(function() {
            //Start Validation for Entry and Edit Form
            $('#item_form').validate({
                rules: {
                    name: 'required',
                    price: 'required',
                },
                messages: {
                    name: 'Item name is required',
                    price: 'Item price is required',
                },
                submitHandler: function(form) {
                    // disable submit button after first click
                    $(':submit').prop("disabled", true);
                    form.submit();
                }
            });
            //End Validation for Entry and Edit Form
        });
    </script>
    @endsection
