@extends('layouts.master')
@section('css')
    @toastr_css
@endsection
@section('title')
    تعديل رسوم دراسية
@endsection

@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        تعديل رسوم دراسية
    @endsection
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    <form action="{{route('fees.update',$fee->id)}}" method="POST" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة العربية</label>
                                <input type="text" value="{{$fee->getTranslation('title','ar')}}" name="title_ar"
                                       class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">الاسم باللغة الانجليزية</label>
                                <input type="text" value="{{$fee->getTranslation('title','en')}}" name="title_en"
                                       class="form-control">
                            </div>
                            <div class="form-group col">
                                <label for="inputEmail4">المبلغ</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">المرحلة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="grade_id">
                                    <option selected disabled> {{__('parent-trans.choose')}}</option>
                                    @foreach ($grades as $grade)
                                        <option
                                            value="{{ $grade->id }}" {{ (old('grade_id',$fee->grade_id) == $grade->id ? 'selected':'') }}>{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">الصف الدراسي</label>
                                <select class="custom-select mr-sm-2" name="classroom_id">
                                    <option selected disabled> {{__('parent-trans.choose')}}</option>
                                    @if(old('classroom_id',$fee->classroom_id) || old('grade_id',$fee->grade_id))
                                        @foreach(class_room(old('grade_id',$fee->grade_id)) as $value)
                                            <option
                                                value="{{$value->id}}" {{ (old('classroom_id',$fee->classroom_id) == $value->id ? 'selected':'') }}>{{ $value->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">السنة الدراسية</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option
                                            value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group col">
                            <label for="inputZip">نوع الرسوم</label>
                            <select class="custom-select mr-sm-2" name="type">
                                <option selected disabled> {{__('parent-trans.choose')}}</option>
                                @foreach(\App\Enums\FeeType::cases() as $value)
                                    <option
                                        value="{{$value->value}}" {{old('type',$fee->type) == $value->value ? 'selected' :''}} >{{$value->value}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">ملاحظات</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
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
