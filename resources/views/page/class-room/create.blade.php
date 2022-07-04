@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('my-classes-trans.add_class') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('my-classes-trans.add_class') }}
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    @section('content')
        <div class="row">
            <div class="col-md-12 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <form method="POST" action="{{ route('class-room.store') }}" autocomplete="off">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ __('my-classes-trans.name_class') }}
                                        :</label>
                                    <input class="form-control" value="{{old('name')}}" type="text" name="name"/>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ __('my-classes-trans.name_class_en') }}
                                        :</label>
                                    <input class="form-control" value="{{old('name_en')}}" type="text" name="name_en"/>
                                    @error('name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label
                                        for="exampleFormControlTextarea1">{{ __('my-classes-trans.name_grade') }}
                                        :</label>
                                    <select class="form-control form-control-lg"
                                            id="exampleFormControlSelect1" name="grade_id">
                                        <option
                                            value="" disabled selected>--حدد اسم المرحلة--
                                        </option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ (old('grade_id') == $grade->id ? 'selected':'') }}>{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-save"></i> {{ __('my-classes-trans.submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @section('js')
        @toaster_js
        @toaster_render
    @endsection
