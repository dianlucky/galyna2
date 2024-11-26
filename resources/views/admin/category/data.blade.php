@extends('layout.admin_layout')
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row">
            <h4 class="p-0">Category</h4>
            <nav class="page-breadcrumb p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/category') }}">Category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Table Category</li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <main id="contents">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card p-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="card-title">Table Category</h6>
                                <a href="{{ url('admin/category/create') }}" class="btn btn-primary">Add</a>
                            </div>
                            <div class="table-responsive" style="min-height: 400px">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 5; $i++)
                                            <tr>
                                                <th>1</th>
                                                <td>Mark</td>
                                                <td>Sasirangan Echoprint</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            Action
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Delete</a></li>
                                                            <li><a class="dropdown-item" href="#">Edit</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </section>
@endsection
