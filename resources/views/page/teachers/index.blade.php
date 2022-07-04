@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('main-trans.list_teachers')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.list_teachers')}}
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
                                <a href="{{route('teachers.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('teacher-trans.add_teacher') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>{{__('teacher-trans.name_teacher')}}</th>
                                            <th>{{__('teacher-trans.gender')}}</th>
                                            <th>{{__('teacher-trans.joining_date')}}</th>
                                            <th>{{__('teacher-trans.specialization')}}</th>
                                            <th>{{ __('teacher-trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($teachers as $teacher)
                                            <tr>
                                                <td>{{$teacher->name}}</td>
                                                <td>{{$teacher->getGender() }}</td>
                                                <td>{{$teacher->joining_date}}</td>
                                                <td>{{$teacher->getSpecializations()}}</td>
                                                <td>
                                                    <a href="{{route('teachers.edit',$teacher->id)}}"
                                                       class="btn btn-info btn-sm"
                                                       role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <a id="delete" data-id="{{$teacher->id}}"
                                                       class="btn btn-danger btn-sm"><i
                                                            class="fa fa-trash"></i></a>
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
                            url: '{{url('/teachers/')}}' + "/" + id,
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
