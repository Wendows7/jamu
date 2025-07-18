@extends('dashboard.layouts.main')

@section('body')

{{--@include('dashboard/products/modal/edit')--}}
@include('dashboard.partnerships.modal.create')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>Partnership History</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
          <div class="breadcrumb-item">Parnership Sending</div>
        </div>
      </div>

      <div class="section-body">
        <h2 class="section-title">Partnership History</h2>
        <p class="section-lead">
          Send product to partnership company
        </p>

        <div class="row">
          <div class="col-12">
           <button class="btn btn-icon icon-left btn-primary" data-toggle="modal" data-target="#createModal"><i class="far fa-user"></i>Send Product</button>
            <div class="card mt-3">
              <div class="card-header">
                <h4>Table All History</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead>
                      <tr>
                        <th class="text-center">
                          No
                        </th>
                        <th>Company Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Size</th>
{{--                        <th>Action</th>--}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($data as $value)
                      <tr>
                        <td>
                          {{ $loop->iteration }}
                        </td>
                        <td>{{ $value['company_name'] }}</td>
                        <td>{{ $value['product_name'] }}</td>
                        <td>{{ $value['quantity'] }}</td>
                        <td>{{ $value['size'] . 'ML' }}</td>
{{--                        <td>--}}
{{--                            <button class="btn btn-icon icon-left btn-primary mb-1" data-toggle="modal" data-target="#detailModal{{ $value->id }}"><i class="fas fa-eye"></i>Detail</button>--}}
{{--                            <button class="btn btn-icon editbtn icon-left btn-warning border-0"  data-toggle="modal" data-target="#editModal{{ $value->id }}"><i class="fas fa-exclamation-triangle"></i>Edit</button>--}}
{{--                          <form action="{{route('admin.products.delete',['product' => $value->id])}}" method="POST" >--}}
{{--                            @method('delete')--}}
{{--                            @csrf--}}
{{--                              <input type="hidden" name="id" value="{{$value->id}}">--}}
{{--                            <button  class="btn btn-icon icon-left btn-danger show_confirm mt-1 " ><i class="fas fa-times"></i>Delete</button>--}}
{{--                          </form>--}}
{{--                        </td>--}}
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





