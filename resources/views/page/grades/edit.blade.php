@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    {{ __('grades-trans.edit_grade') }}
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
                    @isset($grade)
                        <!-- add_form -->
                        <form action="{{ route('grades.update', $grade->id) }}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="Name"
                                           class="mr-sm-2">{{ trans('grades-trans.stage_name_ar') }}
                                        :</label>
                                    <input id="Name" type="text" name="name"
                                           class="form-control"
                                           value="{{old('name',$grade->getTranslation('name', 'ar'))}}"
                                           required>
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-group col">
                                    <label for="Name_en"
                                           class="mr-sm-2">{{ trans('grades-trans.stage_name_en') }}
                                        :</label>
                                    <input type="text" class="form-control"
                                           value="{{old('name',$grade->getTranslation('name', 'en'))}}"
                                           name="name_en" required>
                                    @error('name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label
                                    for="exampleFormControlTextarea1">{{ trans('grades-trans.notes') }}
                                    :</label>
                                <textarea class="form-control" name="notes"
                                          id="exampleFormControlTextarea1"
                                          rows="3"> {{old('name',$grade->notes)}}</textarea>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-save"></i> {{ __('grades-trans.edit') }}</button>
                        </form>
                </div>
                @endisset
            </div>
        </div>
    </div>
@endsection
@section('js')
    @toaster_js
    @toaster_render
@endsection


