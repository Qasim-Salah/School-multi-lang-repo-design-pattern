@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('main-trans.list_students')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.list_students')}}
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
                                <a href="{{route('students.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{__('main-trans.add_student')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{__('students-trans.name')}}</th>
                                            <th>{{__('students-trans.email')}}</th>
                                            <th>{{__('students-trans.gender')}}</th>
                                            <th>{{__('students-trans.grade')}}</th>
                                            <th>{{__('students-trans.classrooms')}}</th>
                                            <th>{{__('students-trans.section')}}</th>
                                            <th>{{__('students-trans.processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                                <td>{{ $student->id }}</td>
                                                <td>{{$student->name}}</td>
                                                <td>{{$student->email}}</td>
                                                <td>{{$student->getGender()}}</td>
                                                <td>{{$student->grade->name}}</td>
                                                <td>{{$student->classroom->name}}</td>
                                                <td>{{$student->section->name}}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                            العمليات
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item"
                                                               href="{{route('students.show',$student->id)}}"><i
                                                                    style="color: #ffc107" class="far fa-eye "></i>&nbsp;عرض
                                                                بيانات الطالب</a>
                                                            <a class="dropdown-item"
                                                               href="{{route('students.edit',$student->id)}}"><i
                                                                    style="color:green" class="fa fa-edit"></i>&nbsp;تعديل
                                                                بيانات الطالب</a>
                                                            <a class="dropdown-item"
                                                               href="{{route('fees.invoices.create',$student->id)}}"><i
                                                                    style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة
                                                                فاتورة رسوم&nbsp;</a>
                                                            <a class="dropdown-item"
                                                               href="{{route('students.receipts.create',$student->id)}}"><i
                                                                    style="color: #9dc8e2"
                                                                    class="fa fa-edit"></i>&nbsp; &nbsp;سند
                                                                قبض</a>
                                                            <a class="dropdown-item"
                                                               href="{{route('fees.processings.create',$student->id)}}"><i
                                                                    style="color: #9dc8e1"
                                                                    class="fa fa-edit"></i>&nbsp; &nbsp;
                                                                استبعاد رسوم</a>
                                                            <a class="dropdown-item"
                                                               href="{{route('payments.create',$student->id)}}"><i
                                                                    style="color:goldenrod" class="fa fa-edit"></i>&nbsp;
                                                                &nbsp;سند
                                                                صرف</a>
                                                            <a class="dropdown-item"
                                                               id="delete" data-id="{{$student->id}}"><i
                                                                    style="color: red" class="fa fa-trash"></i>&nbsp;
                                                                حذف بيانات الطالب</a>
                                                        </div>
                                                    </div>

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
                    if (result === false) {
                        dialog.modal('hide');
                    } else {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url('/students/')}}' + "/" + id,
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
                            error: function () {
                                bootbox.alert({
                                    message: "{{ __('messages.unDelete') }}",
                                    className: 'bb-alternate-modal',
                                });
                            },
                        });
                    }
                }
            });
        });
    </script>
@endsection
