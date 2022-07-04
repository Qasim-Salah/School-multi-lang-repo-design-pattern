@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('grades-trans.add_grade') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('main-trans.grades') }}
    @endsection

    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- Start content -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('grades.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="Name"
                                       class="mr-sm-2">{{ __('grades-trans.stage_name_ar') }}
                                    :</label>
                                <input id="Name" type="text" name="name" value="{{old('name')}}"
                                       class="form-control">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="Name_en"
                                       class="mr-sm-2">{{ __('grades-trans.stage_name_en') }}
                                    :</label>
                                <input type="text" class="form-control" value="{{old('name_en')}}"
                                       name="name_en">
                                @error('name_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label
                                for="exampleFormControlTextarea1">{{ __('grades-trans.notes') }}
                                :</label>
                            <textarea class="form-control" name="notes"
                                      rows="3">{{old('name_en')}}</textarea>
                            @error('notes')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary"><i
                                class="fa fa-save"></i> {{ __('grades-trans.submit') }}</button>
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

