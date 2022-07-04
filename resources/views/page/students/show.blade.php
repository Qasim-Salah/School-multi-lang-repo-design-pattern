@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('students-trans.student_details')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('students-trans.student_details')}}
    @endsection
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{__('students-trans.student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{__('students-trans.attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{__('students-trans.name')}}</th>
                                            <td>{{ $student->name }}</td>
                                            <th scope="row">{{__('students-trans.email')}}</th>
                                            <td>{{$student->email}}</td>
                                            <th scope="row">{{__('students-trans.gender')}}</th>
                                            <td>{{$student->getGender()}}</td>
                                            <th scope="row">{{__('students-trans.grade')}}</th>
                                            <td>{{ $student->grade->name }}</td>
                                        </tr>

                                        <tr>

                                            <th scope="row">{{__('students-trans.classrooms')}}</th>
                                            <td>{{$student->classroom->name}}</td>
                                            <th scope="row">{{__('students-trans.section')}}</th>
                                            <td>{{$student->section->name}}</td>
                                            <th scope="row">{{__('students-trans.date_of_birth')}}</th>
                                            <td>{{ $student->date_birth}}</td>
                                            <th scope="row">{{__('students-trans.parent')}}</th>
                                            <td>{{ $student->myparent->name_father}}</td>
                                        </tr>

                                        <tr>

                                            <th scope="row">{{__('students-trans.academic_year')}}</th>
                                            <td>{{ $student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="POST" action="{{route('students.images.upload')}}"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{__('students-trans.attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple
                                                               required>
                                                        <input type="hidden" name="student_name"
                                                               value="{{old('student_name',$student->name)}}">
                                                        <input type="hidden" name="student_id"
                                                               value="{{old('student_id',$student->id)}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                    {{__('students-trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{__('students-trans.filename')}}</th>
                                                <th scope="col">{{__('students-trans.created_at')}}</th>
                                                <th scope="col">{{__('students-trans.processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$attachment->id}}</td>
                                                    <td><img style="height: 100px ;width: 100px"
                                                             src="{{url('storage'.'/'. Str::after($attachment->filename, 'storage/'))}}">
                                                    </td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{route('students.images.download',$attachment->id)}}"
                                                           role="button"><i
                                                                class="fas fa-download"></i>&nbsp; {{__('students-trans.download')}}
                                                        </a>

                                                        <a id="delete" data-id="{{$attachment->id}}"
                                                           class="btn btn-outline-danger btn-sm"
                                                           title="{{ __('grades-trans.delete') }}">{{__('students-trans.delete')}}
                                                        </a>

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
                                        url: '{{url('/students/images/')}}' + "/" + id,
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
