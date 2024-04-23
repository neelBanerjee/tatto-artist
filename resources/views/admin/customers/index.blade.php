@extends('admin.layout.main')
@section('title', env('APP_NAME').' | Artist-index'  )
@section('content')
    <div class="row justify-content-center">

        <div class="col-lg-10">
            <div class="card">
                <div class="card-title pr">
                    <h4>All Customers</h4>
                    @if (Session::has('msg'))
                        <p class="alert alert-info">{{ Session::get('msg') }}</p>
                    @endif
                </div>
               
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table student-data-table m-t-20">
                            <thead>
                                <tr>
                                    <th>SN.</th>
                                    <th>Full name</th>
                                    <th>Username</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                             
                                    <tr>
                                        <td>#</td>
                                        <td>
                                            {{ $customer->name }}
                                        </td>

                                        <td>
                                            {{ $customer->username }}
                                        </td>

                                        <td>
                                            {{ $customer->phone }}
                                        </td>
                                        
                                        <td>
                                            {{ $customer->email }}
                                        </td>

                                        <td>
                                            {{ isset($customer->address) ? $customer->address : "Not Provided!" }}
                                        </td>
                                        
                                        {{-- <td><span id="status-btn{{ $customer->id }}">
                                            <button class="btn btn-sm {{ $customer->status == 'Available' ? 'btn-success' : ($customer->status == 'Inactive' ? 'bg-danger' : 'bg-warning'); }}"  onclick="changeStatus('{{ $customer->id }}', {{ $customer->id}})" >
                                                {{ $customer->status }}
                                            </button>
                                        </span>
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

