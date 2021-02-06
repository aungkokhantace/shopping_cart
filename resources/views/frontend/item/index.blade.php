@extends('layouts.frontend_master')

@section('content')
<div class="main-panel-without-sidebar">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ITEM LIST</h4>
                        <!-- start alert -->
                        @if (session('status'))
                        <div class="alert alert-success auto-fadeout-alert" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- end alert -->

                        <!-- start Cart button -->
                        <div class="row">
                            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1 float-right ml-auto">
                                <a href="/view_cart">
                                    <button type="button" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="View Cart">
                                        <i class="mdi mdi-cart"></i> <span class="badge badge-light">{{ $cart_total_qty }}</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- end Cart button -->

                        <div class="table-responsive pt-3">
                            <!-- start table -->
                            <table class="table table-bordered table-striped list-view-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($items as $item)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>${{ number_format($item->price, 2, '.', '') }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/add_to_cart/{{$item->id}}"><button type="button" class="btn btn-secondary">Add to cart</button></a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $counter++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- end table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    @endsection
