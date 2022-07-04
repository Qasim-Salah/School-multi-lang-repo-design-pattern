@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('sections-trans.add_section') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('sections-trans.add_section') }}
    @endsection
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('sections.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('sections-trans.section_name_ar')}}</label>
                                        <input type="text" value="{{old('name')}}" name="name"
                                               class="form-control"
                                        >
                                        @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('sections-trans.section_name_en')}}</label>
                                        <input type="text" name="name_en" value="{{old('name_en')}}"
                                               class="form-control"
                                        >
                                        @error('name_en')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ __('sections-trans.name_grade') }}</label>
                                        <select name="grade_id" class="custom-select"
                                                onchange="console.log($(this).val())">
                                            <!--placeholder-->
                                            "
                                            <option selected disabled> {{__('parent-trans.choose')}}</option>
                                            @foreach ($grades as $grade)
                                                <option
                                                    value="{{ $grade->id }}" {{ (old('grade_id') == $grade->id ? 'selected':'') }}>{{ $grade->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('grade_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="inputName"
                                               class="control-label">{{ __('sections-trans.name_class') }}</label>
                                        <select name="class_id" class="custom-select">
                                            <option selected disabled> {{__('parent-trans.choose')}}</option>
                                        </select>
                                        @error('class_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputName"
                                               class="control-label">{{ __('sections-trans.name_teacher') }}</label>
                                        <select name="teacher_id" class="custom-select">
                                            <option selected disabled> {{__('parent-trans.choose')}}</option>
                                            @foreach($teachers as $teacher)
                                                <option
                                                    value="{{$teacher->id}}" {{ (old('teacher_id') == $teacher->id ? 'selected':'') }}>{{$teacher->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('teacher_id[]')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                        type="submit">{{__('sections-trans.add_section')}}</button>
                            </form>
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
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('/api/v1/classes') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="class_id"]').empty().append("<option selected disabled> {{__('parent-trans.choose')}}</option>");
                            $.each(data, function (key, value) {
                                $('select[name="class_id"]')
                                    .append('<option value="' + key + '"{{ (old('class_id')) }}>' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });

    </script>

@endsection
