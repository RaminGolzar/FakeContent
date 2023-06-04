<?php
namespace App\Libraries\TEFakeContent\Interpreter\Handlers;

use App\Libraries\TEFakeContent\GenContent\GenContent;

class Sign extends BaseInterpreter
{

    /**
     * Interpreting the sign
     *
     * @param string $string <p>This param must be contains sign. Example: #$@ or [#$@%] or [###] & ...</p>
     * @param bool $newStep <p>if pass true then, return next character in the alphabet table</p>
     * @return string
     */
    public function sign (string $placeholder , bool &$newStep): string {
        $placeholders = $this->seperating_content ($placeholder);

        $replaceContent = $this->get_replace_content ($placeholders , $newStep);

        $this->fetch ($placeholders , $replaceContent);

        return join ('' , $placeholders);
    }

    /**
     * Divisioning the random content of the ordinal content
     *
     * @param string $placeholder
     * @return array
     */
    private function seperating_content (string &$placeholder): array {
        $offset = 0;
        $counter = 0;
        $division = [];

        for ($p = 0; $p < strlen ($placeholder); $p++) {
            $char = substr ($placeholder , $offset++ , 1);

            $this->char_by_char ($division , $char , $counter);
        }

        $this->fix_backslash ($division);

        return $division;
    }

    /**
     * Generate & return replace content for ordinal placeholder
     *
     * Return value is an array that:
     * keys is sign & values is content for replacing
     *
     * @staticvar array $replaceContent
     * @param array $placeholders
     * @param bool $newStep
     * @return array
     */
    private function get_replace_content (array $placeholders , bool &$newStep): array {
        static $replaceContent = [];

        /* that is new field */
        if ($newStep) {
            $replaceContent = [];

            $newStep = false; /* that is not go to next */
        }

        foreach ($placeholders as &$placeholder) {
            if (strpos ($placeholder , '[') === false) {
                $this->add_replace_content ($placeholder , $replaceContent);
            }
        }

        return $replaceContent;
    }

    /**
     * Add an content to $replaceContent parameter
     *
     * @param string $placeholder
     * @param array $replaceContent
     * @return void
     */
    public function add_replace_content (string &$placeholder , array &$replaceContent): void {
        $gc = new GenContent();

        /* for numbers */
        if (strpos ($placeholder , '#') !== false && !key_exists ('#' , $replaceContent)) {
            $replaceContent['#'] = $gc->ordinal_num ();
        }

        /* for upper case alphabet */
        if (strpos ($placeholder , '$') !== false && !key_exists ('$' , $replaceContent)) {
            $replaceContent['$'] = $gc->ordinal_upper_alpha ();
        }

        /* for lower case alphabet */
        if (strpos ($placeholder , '@') !== false && !key_exists ('@' , $replaceContent)) {
            $replaceContent ['@'] = $gc->ordinal_lower_alpha ();
        }
    }

    /**
     * Detect & division content between random or ordinal
     *
     * @param array $exploded
     * @param string $char
     * @param int $counter
     * @return void
     */
    private function char_by_char (array &$exploded , string &$char , int &$counter): void {
        if ($char == '[') {
            $counter++;
            $this->add_portion ($exploded , $char , $counter);
        } elseif ($char == ']') {
            $this->add_portion ($exploded , $char , $counter);
            $counter++;
        } else {
            $this->add_portion ($exploded , $char , $counter);
        }
    }

    /**
     * Add a portion to an array
     *
     * @param array $exploded
     * @param string $value
     * @param int $index
     * @return void
     */
    private function add_portion (array &$exploded , string &$value , int &$index): void {
        if (isset ($exploded[$index])) {
            $exploded [$index] .= $value;
        } else {
            $exploded [$index] = $value;
        }
    }

    /**
     * Fix backslash sing
     *
     * @param array $exploded
     * @return void
     */
    private function fix_backslash (array &$exploded): void {
        for ($p = 0; $p < count ($exploded); $p++) {
            if (!key_exists ($p , $exploded)) {
                continue;
            }

            if (substr ($exploded [$p] , -1 , 1) == '\\') {
                $exploded [$p] = substr ($exploded [$p] , 0 , -1);

                $exploded [$p + 1] = '\\' . $exploded [$p + 1];
            }
        }
    }

    /**
     * Fetch the exploded array of sign & replace the sign by ordinal
     * or random content
     *
     * @param array $exploded
     * @param array $replaceContent
     * @return void\
     */
    private function fetch (array &$exploded , array $replaceContent): void {
        foreach ($exploded as &$sign) {
            $this->replacing ($sign , $replaceContent);
        }
    }

    /**
     * Replace the sign by ordinal or random content
     *
     * @param string $string
     * @param array $replaceContent
     * @return void
     */
    private function replacing (string &$string , array $replaceContent): void {
        if (strpos ($string , '[') !== false) {
            $string = $this->random_replace ($string);
        } else {
            $string = $this->ordinal_replace ($string , $replaceContent);
        }
    }

    /**
     * For replace the accidental sign by accidental content
     *
     * @param string $string
     * @return string|null
     */
    private function random_replace (string &$string): ?string {
        $result = '';

        $strSplit = str_split ($string);

        foreach ($strSplit as &$item) {
            $result .= $this->escape ('random' , $item);
        }

        return $result;
    }

    /**
     * To replace the ordinal sign by ordinal content
     *
     * @param string $string
     * @param array $replaceContent
     * @return string
     */
    private function ordinal_replace (string &$string , array $replaceContent): string {
        $result = '';

        for ($p = 0; $p <= strlen ($string); $p++) {
            $result .= $this->escape ('ordinal' , substr ($string , $p , 1) , $replaceContent);
        }

        return $result;
    }

    /**
     * For escaping the characters, working with "backslash" sign
     *
     * @staticvar boolean $escape
     * @param string $type
     * @param string $char
     * @param array|null $replaceContent
     * @return string|null
     */
    private function escape (string $type , string $char , ?array &$replaceContent = null): ?string {
        static $escape = false;

        if ($char === '\\') {
            /* for escaping the next char */
            $escape = true;
            return null;
        } else {
            return $this->is_escape ($type , $char , $escape , $replaceContent);
        }
    }

    /**
     * Or escape the character or replacing the sing by one content
     *
     * @param string $type
     * @param string $char
     * @param bool $escape
     * @param array|null $replaceContent
     * @return string|null
     */
    private function is_escape (string $type , string &$char , bool &$escape , ?array &$replaceContent = null): ?string {
        if ($escape) {
            $escape = false;
            return $char;
        } else {
            switch ($type) {
                case 'ordinal':
                    return str_replace (array_keys ($replaceContent) , array_values ($replaceContent) , $char);
                case 'random':
                    return $this->get_random_data ($char);
            }
        }
    }

    /**
     * Get random data
     *
     * @param string $string
     * @return string|null
     */
    private function get_random_data (string $string): ?string {
        switch ($string) {
            case '#':
                return $this->gc->accidental_num (1);
            case '@':
                return $this->gc->accidental_lower_alpha (1);
            case '$':
                return $this->gc->accidental_upper_alpha (1);
            case '%':
                return $this->gc->accidental_sign (1);
            case '[':
                return null;
            case ']':
                return null;
            default:
                return $string;
        }
    }

}
