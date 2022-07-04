@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('my-classes-trans.title_page') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('my-classes-trans.title_page') }}
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <a href="{{route('class-room.create')}}" class="button x-small">
                        {{ __('my-classes-trans.add_class') }}
                    </a>
                    <br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                               data-page-length="50"
                               style="text-align: center">
                            <thead>
                            <tr>
                                <th>{{ __('my-classes-trans.name_class') }}</th>
                                <th>{{ __('my-classes-trans.name_grade') }}</th>
                                <th>{{ __('my-classes-trans.processes') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($classes as $class)
                                <tr>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->grade->name}}</td>
                                    <td>
                                        <a href="{{route('class-room.edit',$class->id)}}"
                                           class="btn btn-info btn-sm"
                                           title="{{ __('My_Classes_trans.Edit') }}"><i
                                                class="fa fa-edit"></i></a>
                                        <a href="#" id="delete" data-id="{{$class->id}}"
                                           class="btn btn-danger btn-sm"
                                           title="{{ __('my-classes-trans.delete') }}"><i
                                                class="fa fa-trash"></i></a>
                                    </td>
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
                            url: '{{url('/class-room/')}}' + "/" + id,
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
