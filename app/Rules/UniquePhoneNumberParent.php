<?php

namespace App\Rules;

use App\Models\MyParent as ParentModel;
use Illuminate\Contracts\Validation\Rule;

class UniquePhoneNumberParent implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->params['key'] == 'store') {
            $phone = ParentModel::where('phone_father', filter_phone($value))->Orwhere('phone_mother', filter_phone($value))->exists();
            if ($phone === false) {
                return true;
            }
        } elseif ($this->params['key'] == 'update') {
            $phone = ParentModel::where('phone_father', filter_phone($value))->Orwhere('phone_mother', filter_phone($value))->exists();
            if ($phone === false) {
                return true;
            } else {
                $check = ParentModel::where('phone_father', filter_phone($value))->Orwhere('phone_mother', filter_phone($value))->first();
                if ($check) {
                    if ($check->id == $this->params['value']) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public
    function message()
    {
        return 'قيمة رقم الهاتف مُستخدم.';
    }
}
