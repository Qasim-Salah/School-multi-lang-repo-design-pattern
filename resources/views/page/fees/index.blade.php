@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    الرسوم الدراسية
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        الرسوم الدراسية
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('fees.create')}}" class="button x-small">
                                    اضافة رسم
                                </a>
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>title</th>
                                            <th>amount</th>
                                            <th>{{__('students-trans.grade')}}</th>
                                            <th>{{__('students-trans.classrooms')}}</th>
                                            <th>description</th>
                                            <th>year</th>
                                            <th>نوع الحساب</th>
                                            <th> العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                                <td>{{$fee->title}}</td>
                                                <td>{{$fee->amount}}</td>
                                                <td>{{$fee->grade->name}}</td>
                                                <td>{{$fee->classroom->name}}</td>
                                                <td>{{$fee->description}}</td>
                                                <td>{{$fee->year}}</td>
                                                <td>{{$fee->type}}</td>
                                                <td>
                                                    <a href="{{route('fees.edit',$fee->id)}}"
                                                       class="btn btn-success btn-sm">تعديل
                                                    </a>
                                                    <a id="delete" data-id="{{$fee->id}}"
                                                       class="btn btn-danger btn-sm">حذف
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toaster_js
    @toaster_render
    <script>
        $(document).on('click', '#delete', function () {
            var id = $(this).attr('data-id');
            var token = $('meta[name="csrf-token"]').attr('content')
            var dialog = bootbox.confirm({
                message: "{{ __('messages.are_delete') }}",
                callback: function (result) {
                    console.log(result);
                    if (result === false) {
                        dialog.modal('hide');
                    } else {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url('/fees/')}}' + "/" + id,
                            dataType: 'json',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                bootbox.alert({
                                    message: "{{ __('messages.delete') }}",
                                    className: 'bb-alternate-modal'
                                });
                                setTimeout(function () {
                                    location.reload();
                                }, 2000)
                            },
                            errors: function () {
                                bootbox.alert({
                                    message: "{{ __('messages.unDelete') }}",
                                    className: 'bb-alternate-modal'
                                });
                            },
                        });
                    }
                }
            });
        });
    </script>
@endsection
