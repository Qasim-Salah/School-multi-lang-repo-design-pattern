@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('teacher-trans.add_teacher') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('teacher-trans.add_teacher') }}
    @endsection

    <!-- breadcrumb -->
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
                            <form action="{{route('teachers.store')}}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('teacher-trans.email')}}</label>
                                        <input type="email" value="{{old('email')}}" name="email" class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('teacher-trans.password')}}</label>
                                        <input type="password" value="{{old('password')}}" name="password"
                                               class="form-control">
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('teacher-trans.name_ar')}}</label>
                                        <input type="text" name="name_ar" value="{{old('name_ar')}}"
                                               class="form-control">
                                        @error('name_ar')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="title">{{__('teacher-trans.name_en')}}</label>
                                        <input type="text" name="name_en" value="{{old('name_en')}}"
                                               class="form-control">
                                        @error('name_en')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="inputCity">{{__('teacher-trans.specialization')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="specialization_id">
                                            <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                            @foreach(config('school-system.specializations') as $specializations)
                                                <option
                                                    value="{{$specializations['id']}}" {{ (old('specialization_id') == $specializations['id'] ? 'selected':'') }}>{{ App::getLocale() == 'ar'? $specializations['name_ar'] : $specializations['name_en'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('Specialization_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label for="inputState">{{__('teacher-trans.gender')}}</label>
                                        <select class="custom-select my-1 mr-sm-2" name="gender_id">
                                            <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                            @foreach(config('school-system.gender') as $gender)
                                                <option
                                                    value="{{$gender['id']}}" {{ (old('gender_id') == $gender['id'] ? 'selected':'') }}> {{ App::getLocale() == 'ar'? $gender['name_ar'] : $gender['name_en'] }}</option>
                                            @endforeach
                                        </select>
                                        @error('gender_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">{{__('teacher-trans.joining_date')}}</label>
                                        <div class='input-group date'>
                                            <input class="form-control" value="{{old('joining_date')}}" type="text"
                                                   id="datepicker-action" name="joining_date"
                                                   data-date-format="yyyy-mm-dd" required>
                                        </div>
                                        @error('joining_date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{__('teacher-trans.address')}}</label>
                                    <textarea class="form-control" name="address"
                                              id="exampleFormControlTextarea1" rows="4"></textarea>
                                    @error('address')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                        type="submit">{{__('parent-trans.next')}}</button>
                            </form>
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
@endsection

