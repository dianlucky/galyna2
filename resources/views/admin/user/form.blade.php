@extends('layout.admin_layout')
@php
    $dataPage = [
        'page' => 'user',
    ];
@endphp
@section('content')
    <section class="ps-3">

        {{-- Header Page --}}
        <div class="row text-capitalize">
            <h4 class="p-0 ">Form {{ $data['form'] . ' ' . $dataPage['page'] }}</h4>
            <nav class="p-0 page-breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/' . $dataPage['page']) }}">{{ $dataPage['page'] }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Form {{ $data['form'] }} {{ $dataPage['page'] }}
                    </li>
                </ol>
            </nav>
        </div>

        {{-- Main --}}
        <div class="mt-3 row">
            <div class="p-0 col-md-12">
                {{-- @dd($user) --}}
                <form action={{ $data['action'] }} method="POST">
                    @csrf

                    @if ($data['form'] == 'Edit')
                        @method('PUT')
                    @endif


                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter name" @error('name') error @enderror
                            value="{{ old('name', $user->name ?? '') }}">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Enter email" @error('email') error @enderror
                            value="{{ old('email', $user->email ?? '') }}">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Enter password" @error('password') error @enderror>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Role --}}
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="role" name="role" @error('role') error @enderror>
                            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role', $user->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary">Submit</button>

                    {{-- Cancel Button --}}
                    <a href={{ url('admin/' . $dataPage['page']) }} class="btn btn-dark">Cancel</a>
                </form>
            </div>
        </div>
    </section>
@endsection
