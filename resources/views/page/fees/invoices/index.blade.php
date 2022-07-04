@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    الفواتير الدراسية
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        الفواتير الدراسية
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
                                <br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>الاسم</th>
                                            <th>نوع الرسوم</th>
                                            <th>المبلغ</th>
                                            <th>المرحلة الدراسية</th>
                                            <th>الصف الدراسي</th>
                                            <th>البيان</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($invoices as $invoice)
                                            <tr>
                                                <td>{{ $invoice->id }}</td>
                                                <td>{{$invoice->student->name}}</td>
                                                <td>{{$invoice->fees->title}}</td>
                                                <td>{{ number_format($invoice->amount, 2) }}</td>
                                                <td>{{$invoice->grade->name}}</td>
                                                <td>{{$invoice->classroom->name}}</td>
                                                <td>{{$invoice->description}}</td>
                                                <td>
                                                    <a href="{{route('fees.invoices.edit',$invoice->id)}}"
                                                       class="btn btn-info btn-sm"
                                                       role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <a id="delete" data-id="{{$invoice->id}}"
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
                            url: '{{url('/fees/invoices')}}' + "/" + id,
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
