@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{__('main-trans.add_student')}}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{__('main-trans.add_student')}}
    @endsection
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('students.store') }}" autocomplete="off"
                          enctype="multipart/form-data">
                        @csrf
                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{__('students-trans.personal_information')}}</h6>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('students-trans.name_ar')}} : <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" value="{{old('name_ar')}}" class="form-control">
                                </div>
                                @error('name_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('students-trans.name_en')}} : <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" name="name_en" value="{{old('name_en')}}" type="text">
                                </div>
                                @error('name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('students-trans.email')}} : </label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control">
                                </div>
                                @error('email')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__('students-trans.password')}} :</label>
                                    <input type="password" name="password" value="{{old('password')}}"
                                           class="form-control">
                                </div>
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{__('students-trans.gender')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="gender_id">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @foreach(config('school-system.gender') as $gender)
                                            <option
                                                value="{{$gender['id']}}" {{ (old('gender_id') == $gender['id'] ? 'selected':'') }}> {{ App::getLocale() == 'ar'? $gender['name_ar'] : $gender['name_en'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{__('students-trans.blood_type')}} : </label>
                                    <select class="custom-select mr-sm-2" name="blood_id">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @foreach(config('school-system.blood_types') as $blood)
                                            <option
                                                value="{{$blood['id']}}" {{ (old('blood_id') == $blood['id'] ? 'selected':'') }}>{{ $blood['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{__('students-trans.date_of_birth')}} :</label>
                                    <input class="form-control" type="text" value="{{old('date_birth')}}"
                                           id="datepicker-action"
                                           name="date_birth" data-date-format="yyyy-mm-dd">
                                </div>
                                @error('date_birth')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{__('students-trans.student_information')}}</h6>
                        <br>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{__('students-trans.grade')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="grade_id"
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
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{__('students-trans.classrooms')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="classroom_id"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @if(old('classroom_id') || old('grade_id'))
                                            @foreach(class_room(old('grade_id')) as $value)
                                                <option
                                                    value="{{$value->id}}" {{ (old('classroom_id') == $value->id ? 'selected':'') }}>{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('classroom_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{__('students-trans.section')}} : </label>
                                    <select class="custom-select mr-sm-2" name="section_id"
                                            onchange="console.log($(this).val())">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @if(old('section_id') || old('classroom_id'))
                                            @foreach(sections(old('classroom_id')) as $value)
                                                <option
                                                    value="{{$value->id}}" {{ (old('section_id') == $value->id ? 'selected':'') }}>{{ $value->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('section_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{__('students-trans.parent')}} : <span
                                            class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="parent_id">
                                        <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                        @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}" {{ (old('parent_id') ==  $parent->id ? 'selected':'') }}>{{ $parent->name_father }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
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
                                            <option value="{{ $year}}" {{ (old('academic_year') == $year ? 'selected':'') }}>{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('academic_year')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{__('students-trans.attachments')}} : <span
                                        class="text-danger">*</span></label>
                                <input type="file" accept="image/*" name="photos[]" multiple>
                            </div>
                        </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{__('students-trans.submit')}}</button>
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

@endsection
