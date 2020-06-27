<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LimitRequestedMoney implements Rule
{
    public $user_commission;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($commission)
    {

        $this->user_commission = $commission;
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $value <= $this->user_commission and $value > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('software.money_error');
    }
}
