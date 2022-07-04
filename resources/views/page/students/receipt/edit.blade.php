@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    تعديل سند قبض
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        تعديل سند قبض
    @endsection
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('students.receipts.update',$receipt->id)}}" method="POST"
                          autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>المبلغ : <span class="text-danger">*</span></label>
                                    <input class="form-control" name="debit" value="{{old('debit',$receipt->debit)}}"
                                           type="number">
                                    <input type="hidden" name="id" value="{{$receipt->id}}"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>البيان : <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                              rows="3">{{old('description',$receipt->description)}}</textarea>
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
