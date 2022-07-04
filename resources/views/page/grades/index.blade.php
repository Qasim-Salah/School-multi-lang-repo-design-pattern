@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('grades-trans.title_page') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ trans('main-trans.grades') }}
    @endsection

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <a class="button x-small"
                       href="{{route('grades.create')}}"> {{ trans('grades-trans.add_grade') }}</a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('grades-trans.name') }}</th>
                                <th>{{ __('grades-trans.notes') }}</th>
                                <th>{{ __('grades-trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($grades as $grade)
                                <tr>
                                    <td>{{ $grade->id }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->notes }}</td>
                                    <td>
                                        <a href="{{route('grades.edit',$grade->id)}}" class="btn btn-info btn-sm"
                                           title="{{ trans('grades-trans.edit') }}"><i class="fa fa-edit"></i></a>
                                        <a href="#" id="delete" data-id="{{$grade->id}}"
                                           class="btn btn-danger btn-sm"
                                           title="{{ __('grades-trans.delete') }}"><i
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
                            url: '{{url('/grades/')}}' + "/" + id,
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


