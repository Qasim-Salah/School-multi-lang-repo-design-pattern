@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('main-trans.list_graduate')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.list_graduate')}}
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
                                <a href="{{route('graduated.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{__('main-trans.add_graduate')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
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
                                                    <button type="button" class="btn btn-success btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Return_Student{{ $student->id }}"
                                                            title="{{ __('grades-trans.delete') }}">ارجاع الطالب
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            data-toggle="modal"
                                                            data-target="#Delete_Student{{ $student->id }}"
                                                            title="{{ __('grades-trans.delete') }}">حذف الطالب
                                                    </button>

                                                </td>
                                            </tr>
                                        @include('page.students.graduated.update')
                                        @include('page.students.graduated.delete')
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
                            url: '{{url('/graduated/')}}' + "/" + id,
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
