@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('sections-trans.title_page') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('sections-trans.title_page') }}
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
                                <a href="{{route('sections.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('sections-trans.add_section') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>{{ __('sections-trans.name_section') }}</th>
                                            <th>{{ __('sections-trans.name_class') }}</th>
                                            <th>{{ __('sections-trans.status') }}</th>
                                            <th>{{ __('sections-trans.processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($sections as $section)
                                            <tr>
                                                <td>{{ $section->name }}</td>
                                                <td>{{ $section->classs->name}}</td>
                                                <td>
                                                    @foreach(config('school-system.general_status') as $status)
                                                        @if($status['id'] == $section->status)
                                                            <span
                                                                class="{{$status['class']}}">{{App::getLocale() == 'ar'? $status['name'] : $status['name_en']}}</span>
                                                        @endif
                                                    @endforeach</td>
                                                <td>

                                                    <a href="{{route('sections.edit',$section->id)}}"
                                                       class="btn btn-outline-info btn-sm">{{ __('sections-trans.edit') }}</a>
                                                    <a id="delete" data-id="{{$section->id}}"
                                                       class="btn btn-outline-danger btn-sm">{{ __('sections-trans.delete') }}</a>
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
                            url: '{{url('/sections/')}}' + "/" + id,
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
