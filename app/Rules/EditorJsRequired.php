<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EditorJsRequired implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $value = json_decode($value);
        if (count($value->blocks) === 0) return false;
        
        foreach ($value->blocks as $block){
//          this is calling the validate methods of this class for particular block types and returning true,
//          if method returns true. if false it will continue to loop through the whole blocks array
            if(method_exists($this, 'validate' . ucfirst($block->type))) {
                if ($this->{'validate' . ucfirst($block->type)}($block) === true) return true;
            }
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is required.';
    }

    private function validateParagraph($block) : bool
    {
        return !empty($block->data->text);
    }

    private function validateHeader($block) : bool
    {
        return !empty($block->data->text);
    }

    private function validateImage($block) : bool
    {
        return !empty($block->data->file->id) && !empty($block->data->file->url);
    }

    private function validateQuote($block) : bool
    {
        return !empty($block->data->text);
    }

    private function validateList($block) : bool
    {
        return count($block->data->items) > 0;
    }

    private function validateTable($block) : bool
    {
        return count($block->data->content) > 0;
    }
}
