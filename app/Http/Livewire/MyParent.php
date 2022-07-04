<?php

namespace App\Http\Livewire;

use App\Models\MyParent as ParentModel;
use App\Models\ParentAttachment as AttachmentModel;
use App\Rules\CheckPhoneNumber;
use App\Rules\UniquePhoneNumberParent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyParent extends Component
{
    use WithFileUploads;

    public $catchError,
        $updateMode = false,
        $file_name, $show_table = true,
        $parent_id, $currentStep = 1,

        // Father_INPUTS
        $email, $password,
        $name_father, $name_father_en,
        $phone_father, $job_father, $job_father_en,
        $blood_type_father_id, $address_father,

        // Mother_INPUTS
        $name_mother, $name_mother_en,
        $phone_mother, $job_mother, $job_mother_en,
        $blood_type_mother_id, $address_mother;

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'email' => 'required|email',
            'phone_father' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber()],
            'phone_mother' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber()]
        ]);
    }

    public function render()
    {
        return view('livewire.parent.create', [
            'my_parents' => ParentModel::all(),
        ]);
    }

    public function show_form_add()
    {
        $this->show_table = false;
    }

    public function first_step_submit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email',
            'password' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'phone_father' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber(), new UniquePhoneNumberParent(['key' => 'store'])],
            'blood_type_father_id' => 'required',
            'address_father' => 'required',
        ]);

        $this->currentStep = 2;
    }

    public function second_step_submit()
    {
        $this->validate([
            'name_mother' => 'required',
            'name_mother_en' => 'required',
            'phone_mother' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber(), new UniquePhoneNumberParent(['key' => 'store'])],
            'job_mother' => 'required',
            'job_mother_en' => 'required',
            'blood_type_mother_id' => 'required',
            'address_mother' => 'required',
        ]);

        $this->currentStep = 3;
    }

    public function submit_form()
    {
        try {
            DB::beginTransaction();

            $parent = ParentModel::create([
                'email' => $this->email,
                'password' => bcrypt($this->password),
                'name_father' => ['en' => $this->name_father_en, 'ar' => $this->name_father],
                'phone_father' => filter_phone($this->phone_father),
                'job_father' => ['en' => $this->job_father_en, 'ar' => $this->job_father],
                'blood_type_father_id' => $this->blood_type_father_id,
                'address_father' => $this->address_father,
                // Mother_INPUTS
                'name_mother' => ['en' => $this->name_mother_en, 'ar' => $this->name_mother],
                'phone_mother' => filter_phone($this->phone_mother),
                'job_mother' => ['en' => $this->job_mother_en, 'ar' => $this->job_mother],
                'blood_type_mother_id' => $this->blood_type_mother_id,
                'address_mother' => $this->address_mother,
            ]);

            if (!empty($this->file_name)) {
                foreach ($this->file_name as $photo) {
                    ###helper###
                    $fileName = upload_image('parent', $photo);
                    AttachmentModel::create([
                        'file_name' => $fileName,
                        'parent_id' => $parent->id,
                    ]);
                }
            }

            DB::commit();
            toastr()->success(__('messages.success'));
            $this->clearForm();
            $this->currentStep = 1;

        } catch (\Exception $e) {
            DB::rollback();
            $this->catchError = $e->getMessage();
        }
    }

    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;

        $my_parent = ParentModel::findOrfail($id);
        $this->parent_id = $id;
        $this->email = $my_parent->email;
        $this->password = $my_parent->password;
        $this->name_father = $my_parent->getTranslation('name_father', 'ar');
        $this->name_father_en = $my_parent->getTranslation('name_father', 'en');
        $this->job_father = $my_parent->getTranslation('job_father', 'ar');;
        $this->job_father_en = $my_parent->getTranslation('job_father', 'en');
        $this->phone_father = $my_parent->phone_father;
        $this->blood_type_father_id = $my_parent->blood_type_father_id;
        $this->address_father = $my_parent->address_father;

        $this->name_mother = $my_parent->getTranslation('name_mother', 'ar');
        $this->name_mother_en = $my_parent->getTranslation('name_father', 'en');
        $this->job_mother = $my_parent->getTranslation('job_mother', 'ar');;
        $this->job_mother_en = $my_parent->getTranslation('job_mother', 'en');
        $this->phone_mother = $my_parent->phone_mother;
        $this->blood_type_mother_id = $my_parent->blood_type_mother_id;
        $this->address_mother = $my_parent->address_mother;
    }

    public function first_step_submit_edit()
    {
        $this->updateMode = true;
        $this->validate([
            'email' => 'required|unique:my_parents,email,' . $this->parent_id,
            'password' => 'required',
            'name_father' => 'required',
            'name_father_en' => 'required',
            'job_father' => 'required',
            'job_father_en' => 'required',
            'phone_father' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber(), new UniquePhoneNumberParent(['key' => 'update', 'value' => $this->parent_id])],
            'blood_type_father_id' => 'required',
            'address_father' => 'required',
        ]);
        $this->currentStep = 2;
    }

    public function second_step_submit_edit()
    {
        $this->updateMode = true;
        $this->validate([
            'name_mother' => 'required',
            'name_mother_en' => 'required',
            'phone_mother' => ['required', 'numeric', 'digits_between:10,11', new CheckPhoneNumber(), new UniquePhoneNumberParent(['key' => 'update', 'value' => $this->parent_id])],
            'job_mother' => 'required',
            'job_mother_en' => 'required',
            'blood_type_mother_id' => 'required',
            'address_mother' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submit_form_edit()
    {
        try {
            DB::beginTransaction();
            if ($this->parent_id) {
                $parent = ParentModel::findOrfail($this->parent_id);
                $parent->update([
                    'email' => $this->email,
                    'password' => bcrypt($this->password),
                    'name_father' => ['en' => $this->name_father_en, 'ar' => $this->name_father],
                    'phone_father' => filter_phone($this->phone_father),
                    'job_father' => ['en' => $this->job_father_en, 'ar' => $this->job_father],
                    'blood_type_father_id' => $this->blood_type_father_id,
                    'address_father' => $this->address_father,
                    // Mother_INPUTS
                    'name_mother' => ['en' => $this->name_mother_en, 'ar' => $this->name_mother],
                    'phone_mother' => filter_phone($this->phone_mother),
                    'job_mother' => ['en' => $this->job_mother_en, 'ar' => $this->job_mother],
                    'blood_type_mother_id' => $this->blood_type_mother_id,
                    'address_mother' => $this->address_mother,
                ]);

                if (!empty($this->file_name)) {
                    foreach ($this->file_name as $photo) {
                        ###helper###
                        $fileName = upload_image('parent', $photo);
                        AttachmentModel::create([
                            'file_name' => $fileName,
                            'parent_id' => $parent->id,
                        ]);
                    }
                }
            }
            DB::commit();
            toastr()->success(__('messages.update'));
            $this->currentStep = 1;
        } catch (\Exception $e) {
            DB::rollback();
            $this->catchError = $e->getMessage();
        }
    }

    public function delete($id)
    {
        $parent = ParentModel::findOrFail($id);

        if ($parent->attachment) {
            foreach ($parent->attachment as $attachment) {
                $image = Str::after($attachment->file_name, 'storage/parent/');
                #delete from folder
                Storage::disk('public')->delete('parent/' . $image);

                $parent->attachment()->delete();
            }
        }

        if ($parent->delete()) {
            toastr()->success(__('messages.delete'));
        } else {
            toastr()->success(__('messages.unDelete'));
        }
    }

    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->name_father = '';
        $this->job_father = '';
        $this->job_father_en = '';
        $this->name_father_en = '';
        $this->phone_father = '';
        $this->blood_type_father_id = '';
        $this->address_father = '';

        $this->name_mother = '';
        $this->job_mother = '';
        $this->job_mother_en = '';
        $this->name_mother_en = '';
        $this->phone_mother = '';
        $this->blood_type_mother_id = '';
        $this->address_mother = '';
    }
}
