@if($currentStep != 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{__('parent-trans.email')}}</label>
                        <input type="email" wire:model="email" value="{{old('email')}}" class="form-control">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{__('parent-trans.password')}}</label>
                        <input type="password" wire:model="password" value="{{old('password')}}" class="form-control">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{__('parent-trans.name_father')}}</label>
                        <input type="text" wire:model="name_father" value="{{old('name_father')}}" class="form-control">
                        @error('name_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{__('parent-trans.name_father_en')}}</label>
                        <input type="text" wire:model="name_father_en" value="{{old('name_father_en')}}"
                               class="form-control">
                        @error('name_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{__('parent-trans.job_father')}}</label>
                        <input type="text" wire:model="job_father" value="{{old('job_father')}}" class="form-control">
                        @error('job_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{__('parent-trans.job_father_en')}}</label>
                        <input type="text" wire:model="job_father_en" value="{{old('job_father_en')}}"
                               class="form-control">
                        @error('job_father_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{__('parent-trans.phone_father')}}</label>
                        <input type="text" wire:model="phone_father" value="{{old('phone_father')}}"
                               class="form-control">
                        @error('phone_father')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputState">{{__('parent-trans.blood_type_father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_father_id">
                            <option selected>{{__('parent-trans.choose')}}...</option>
                            @foreach(config('school-system.blood_types') as $blood)
                                <option
                                    value="{{$blood['id']}}" {{ (old('blood_type_father_id') == $blood['id'] ? 'selected':'') }}>{{ $blood['name'] }}</option>
                            @endforeach
                        </select>
                        @error('blood_type_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{__('parent-trans.address_father')}}</label>
                    <textarea class="form-control" wire:model="address_father" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('address_father')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="first_step_submit_edit"
                            type="button">{{__('parent-trans.next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="first_step_submit"
                            type="button">{{__('parent-trans.next')}}
                    </button>
                @endif

            </div>
        </div>
    </div>
