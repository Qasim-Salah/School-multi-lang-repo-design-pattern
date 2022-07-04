@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    اضافة رسوم جديدة
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        اضافة فاتورة جديدة
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
                            <form action="{{ route('fees.invoices.store') }}" method="POST" autocomplete="off">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <label for="student_id" class="mr-sm-2">{{__('students-trans.name')}}</label>
                                        <select class="custom-select" name="student_id" required>
                                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                                        </select>
                                        @error('student_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label for="fee_id" class="mr-sm-2">نوع الرسوم</label>
                                        <select class="custom-select" name="fee_id" required>
                                            <option selected disabled>{{__('parent-trans.choose')}}...
                                            </option>
                                            @foreach($fees as $fee)
                                                <option
                                                    value="{{ $fee->id }}" {{ (old('fee_id') == $fee->id ? 'selected':'') }}>{{ $fee->title }}</option>
                                            @endforeach
                                        </select>
                                        @error('fee_id')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="amount" class="mr-sm-2">المبلغ</label>
                                        <select class="custom-select" name="amount" required>
                                            <option selected disabled>{{__('parent-trans.choose')}}...
                                            </option>
                                            @foreach($fees as $fee)
                                                <option
                                                    value="{{ $fee->amount }}" {{ (old('amount') == $fee->amount  ? 'selected':'') }}>{{ $fee->amount }}</option>
                                            @endforeach
                                        </select>
                                        @error('amount')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="grade_id" value="{{$student->grade_id}}">
                                    <input type="hidden" name="classroom_id" value="{{$student->classroom_id}}">
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label for="description" class="mr-sm-2">البيان</label>
                                        <input type="text" class="form-control" name="description" required>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                        type="submit">حفظ البيانات
                                </button>
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

