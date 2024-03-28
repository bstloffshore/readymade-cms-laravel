@extends('layouts.master')
@section('pageTitle', 'Manage Site Setting')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><small><b>Show::Contact us</b></small></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Contact us</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
        <table id="vertical-datatable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Reference ID</th>
                    <td>{{ $contact->reference_id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $contact->name }}</td>
                </tr>

                <tr>
                    <th>Company Name</th>
                    <td>{{ $contact->company_name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{!! $contact->message !!}</td>
                </tr>
                <tr>
                    <th>Created On</th>
                    <td>{{ Carbon\Carbon::parse($contact->created_at)->format('d-m-y h:i A') }}</td>
                </tr>

            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
</div>
</section>
@endsection
