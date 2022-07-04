@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    تعديل سند صرف
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        تعديل سند صرف
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('payments.update',$payment->id)}}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>المبلغ : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="debit" value="{{old('debit',$payment->amount)}}"
                                           type="number">
                                    <input type="hidden" name="student_id" value="{{$payment->student->id}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>البيان : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                              rows="3">{{old('description',$payment->description)}}</textarea>
                                </div>
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
@endsection

