@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">CUSTOMER LIST</h4>
                        <!-- start alert -->
                        @if (session('status'))
                        <div class="alert alert-success auto-fadeout-alert" role="alert">
                            <button type="button" class="close" data-dismiss="alert">x</button>
                            {{ session('status') }}
                        </div>
                        @endif
                        <!-- end alert -->

                        <div class="table-responsive pt-3">
                            <!-- start table -->
                            <table class="table table-bordered table-striped list-view-table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/customers/{{$customer->id}}"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="View this customer">View Detail</button></a>
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
