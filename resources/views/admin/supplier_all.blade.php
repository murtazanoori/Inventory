@extends('admin.admin_master')
@section('admin')
<div class="main-content app-content mt-0">
    <div class="side-app">
            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Supplier All</h4>
                            </div>
                        </div>
                    </div>

                    <div class="row"style="margin-top: 6rem;>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Supplier Info</h3>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('supplier.add') }}" class="btn btn-primary mb-4"><i
                                            class="fa fa-plus-circle"> Add Supplier</a></i>
                                    <div class="table-responsive">
                                        <table class="table table-bordered border text-nowrap mb-0" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Name</th>
                                                    <th>Last name</th>
                                                    <th>Mobile Number</th>
                                                    <th>Address</th>
                                                    <th name="bstable-actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suppliers as $key => $item)
                                                    <tr>
                                                        <td> {{ $key + 1 }} </td>
                                                        <td> {{ $item->name }} </td>
                                                        <td> {{ $item->lname }} </td>
                                                        <td> {{ $item->mobile_no }} </td>
                                                        <td> {{ $item->address }} </td>
                                                        <td>
                                                            <div class="btn-list">

                                                                <a href="{{ route('supplier.edit', $item->id) }} "
                                                                    class="btn btn-sm btn-primary" title="Edit">
                                                                    <i class="fe fe-edit"></i> </a>

                                                                <a href="{{ route('supplier.delete', $item->id) }}"
                                                                    class="btn  btn-sm btn-danger" title="Delete"
                                                                    id="delete">
                                                                    <i class="fe fe-trash-2"></i> </a>
                                                            </div>
                                                    <tr>
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
                </div>
            </div>
        </div>
    </div>
        @endsection
