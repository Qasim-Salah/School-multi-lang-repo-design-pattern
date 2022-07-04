@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{__('parent-trans.name_mother')}}</label>
                        <input type="text" wire:model="name_mother" class="form-control">
                        @error('name_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{__('parent-trans.name_mother_en')}}</label>
                        <input type="text" wire:model="name_mother_en" class="form-control">
                        @error('name_mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{__('parent-trans.job_mother')}}</label>
                        <input type="text" wire:model="job_mother" class="form-control">
                        @error('job_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{__('parent-trans.job_mother_en')}}</label>
                        <input type="text" wire:model="job_mother_en" class="form-control">
                        @error('job_mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{__('parent-trans.phone_mother')}}</label>
                        <input type="text" wire:model="phone_mother" class="form-control">
                        @error('phone_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col">
                        <label for="inputState">{{__('parent-trans.blood_type_father_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_mother_id">
                            <option selected>{{__('parent-trans.choose')}}...</option>
                            @foreach(config('school-system.blood_types') as $blood)
                                <option
                                    value="{{$blood['id']}}" {{ (old('blood_type_mother_id') == $blood['id'] ? 'selected':'') }}>{{ $blood['name'] }}</option>
                            @endforeach
                        </select>
                        @error('blood_type_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{__('parent-trans.address_mother')}}</label>
                    <textarea class="form-control" wire:model="address_mother" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('address_mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{__('parent-trans.back')}}
                </button>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="second_step_submit_edit"
                            type="button">{{__('parent-trans.next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="second_step_submit">{{__('parent-trans.next')}}</button>
                @endif

            </div>
        </div>
    </div>

