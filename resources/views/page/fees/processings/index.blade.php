@extends('layouts.master')
@section('css')
@toastr_css
@endsection
@section('title')
معالجات الرسوم الدراسية
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    معالجات الرسوم الدراسية
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>المبلغ</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($processings as $processing)
                                            <tr>
                                                <td>{{ $processing->id }}</td>
                                                <td>{{$processing->student->name}}</td>
                                                <td>{{ number_format($processing->amount, 2) }}</td>
                                                <td>{{$processing->description}}</td>
                                                <td>
                                                    <a href="{{route('fees.processings.edit',$processing->id)}}"
                                                       class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                            class="fa fa-edit"></i></a>
                                                    <a id="delete" data-id="{{$processing->id}}"
                                                       {{--                                                        href="{{route('processings.fee.destroy',$Processing->id)}}"--}}
                                                       class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
                            url: '{{url('/fees/processings/')}}' + "/" + id,
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
