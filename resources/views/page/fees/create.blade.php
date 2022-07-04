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
        اضافة رسوم جديدة
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="POST" action="{{ route('fees.store') }}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة العربية</label>
                                <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
                                @error('title_ar')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة الانجليزية</label>
                                <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
                                @error('title_en')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">المبلغ</label>
                                <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                                @error('amount')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">المرحلة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
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

                            <div class="form-group col">
                                <label for="inputZip">الصف الدراسي</label>
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    <option selected disabled> {{__('parent-trans.choose')}}</option>
                                </select>
                                @error('classroom_id')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">السنة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{__('parent-trans.choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('year')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">نوع الرسوم</label>
                                <select class="custom-select mr-sm-2" name="type">
                                    @foreach(\App\Enums\FeeType::cases() as $value)
                                        <option
                                            value="{{$value->value}}" {{old('type') == $value->value ? 'selected' :''}} >{{$value->value}}</option>
                                    @endforeach
                                </select>
                                @error('type')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">ملاحظات</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4"></textarea>
                            @error('description')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">تاكيد</button>

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

@endsection
