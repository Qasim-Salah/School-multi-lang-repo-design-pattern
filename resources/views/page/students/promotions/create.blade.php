@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('main-trans.students_promotions')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.students_promotions')}}
    @endsection

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <h6 style="color: red;font-family: Cairo">المرحلة الدراسية القديمة</h6><br>
                    <form method="POST" action="{{ route('promotions.store') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('students-trans.grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" required
                                        onchange="console.log($(this).val())">
                                    <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    @foreach ($grades as $grade)
                                        <option
                                            value="{{ $grade->id }}" {{ (old('grade_id') == $grade->id ? 'selected':'') }}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{__('students-trans.classrooms')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    </select>
                                </div>
                                @error('classroom_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{__('students-trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>

                                    </select>
                                </div>
                                @error('section_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{__('students-trans.academic_year')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('academic_year')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <br><h6 style="color: red;font-family: Cairo">المرحلة الدراسية الجديدة</h6><br>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{__('students-trans.grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id_new"
                                        onchange="console.log($(this).val())">
                                    <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    @foreach ($grades as $grade)
                                        <option
                                            value="{{ $grade->id }}" {{ (old('grade_id') == $grade->id ? 'selected':'') }}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                                @error('grade_id_new')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{__('students-trans.classrooms')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id_new"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    </select>
                                </div>
                                @error('classroom_id_new')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{__('students-trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id_new"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    </select>
                                </div>
                                @error('section_id_new')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="academic_year">{{__('students-trans.academic_year')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="academic_year_new">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                @error('academic_year_new')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </form>
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
        $(document).ready(function () {
            $('select[name="grade_id"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('/api/v1/classes') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id"]').empty().append("<option selected disabled> {{__('parent-trans.choose')}}</option>");
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="classroom_id"]').on('change', function () {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('/api/v1/sections') }}/" + classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty().append("<option selected disabled> {{__('parent-trans.choose')}}</option>");
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="grade_id_new"]').on('change', function () {
                var grade_id = $(this).val();
                if (grade_id) {
                    $.ajax({
                        url: "{{ URL::to('/api/v1/classes') }}/" + grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="classroom_id_new"]').empty().append("<option selected disabled> {{__('parent-trans.choose')}}</option>");
                            $.each(data, function (key, value) {
                                $('select[name="classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('select[name="classroom_id_new"]').on('change', function () {
                var classroom_id = $(this).val();
                if (classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('/api/v1/sections') }}/" + classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id_new"]').empty().append("<option selected disabled> {{__('parent-trans.choose')}}</option>");
                            $.each(data, function (key, value) {
                                $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
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
