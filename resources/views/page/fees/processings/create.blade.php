@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    استبعاد رسوم
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        استبعاد رسوم
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form method="post" action="{{ route('fees.processings.store') }}" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>المبلغ : <span class="text-danger">*</span></label>
                                    <input class="form-control" value="{{old('debit')}}" name="debit" type="number">
                                    <input type="hidden" name="student_id" value="{{old('student_id',$student->id)}}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>رصيد الطالب : </label>
                                    <input class="form-control" name="final_balance"
                                           value="{{old('final_balance',number_format($student->student_account->sum('debit') - $student->student_account->sum('credit'), 2))  }}"
                                           type="text" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>البيان : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                              rows="3">{{old('description')}}</textarea>
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
