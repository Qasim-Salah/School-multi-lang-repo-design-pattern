@extends('layouts.master')

@section('css')
    @toastr_css
@endsection

@section('title')
    {{ __('my-classes-trans.edit_class') }}
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        {{ __('my-classes-trans.edit_class') }}
    @endsection
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('class-room.update',$class->id) }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="Name"
                                       class="mr-sm-2">{{ __('my-classes-trans.name_class') }}
                                    :</label>
                                <input id="Name" type="text" name="name"
                                       class="form-control"
                                       value="{{old('name',$class->getTranslation('name', 'ar')) }}"
                                       required>
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group col">
                                <label for="Name_en"
                                       class="mr-sm-2">{{ __('my-classes-trans.name_class_en') }}
                                    :</label>
                                <input type="text" class="form-control"
                                       value="{{old('name_en',$class->getTranslation('name', 'en'))}}"
                                       name="name_en" required>
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
                                    @foreach ($grades as $grade)
                                    <option
                                            value="{{ $grade->id }}" {{old('grade_id',$class->grade_id) == $grade->id ? 'selected' :''}}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary"><i
                                class="fa fa-save"></i> {{ __('my-classes-trans.edit_class') }}</button>
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
