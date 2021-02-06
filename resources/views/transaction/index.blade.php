@extends('layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">TRANSACTION LIST</h4>
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
                                        <th>Transaction Code</th>
                                        <th>User</th>
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $counter = 1; ?>
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <td>{{ $counter }}</td>
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->date }}</td>
                                        <td>${{number_format($transaction->total_amount, 2, '.', '')}}</td>
                                        <td>
                                            <div class="btn-group float-right" role="group">
                                                <a href="/transactions/detail/{{$transaction->id}}"><button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="View Detail">View Detail</button></a>
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
