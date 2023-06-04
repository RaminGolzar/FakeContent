<?php
namespace App\Libraries\TEFakeContent\Interpreter\Handlers;

class Range extends BaseInterpreter
{

    /**
     * Interpreting ranges placeholder
     *
     * @param string $range <p>Example: [a-z] , [1-100] , ...</p>
     * @return string|null
     */
    public function range (string $range): ?string {
        $rangePart = $this->extract_range ($range);

        switch ($this->detection ($rangePart)) {
            case 'numeric':
                return $this->random_num ($rangePart);
            case 'upper':
                return $this->random_alpha ($rangePart , 'upper');
            case 'lower':
                return $this->random_alpha ($rangePart , 'lower');
            default:
                return null;
        }
    }

    /**
     * For detecting range type
     *
     * Return values: "numeric" , "lower" , "upper" , null
     *
     * @param string $range
     * @return string|null
     */
    private function detection (array &$range): ?string {
        if (is_numeric ($range[0]) && is_numeric ($range[1])) {
            return 'numeric';
        } elseif ($this->alpha_case ($range[0]) === 'lower' && $this->alpha_case ($range[1]) === 'lower') {
            return 'lower';
        } elseif ($this->alpha_case ($range[0]) === 'upper' && $this->alpha_case ($range[1]) === 'upper') {
            return 'upper';
        } else {
            return null;
        }
    }

    /**
     * Extracting range part
     *
     * @param string $range
     * @return array
     */
    private function extract_range (string &$range): array {
        return explode ('-' , substr ($range , 1 , -1));
    }

    /**
     * Generate a random number
     *
     * This method is Additional & can use built-in function as "random_int"
     *
     * @param array $range
     * @return string
     */
    private function random_num (array $range): string {
        return (string) random_int ($range[0] , $range[1]);
    }

    /**
     * Generate a random alphabet
     *
     * @param array $range
     * @param string $case
     * @return string
     */
    private function random_alpha (array $range , string $case): string {
        if ($case === 'lower') {
            return $this->gc->range_lower_alpha ($range[0] , $range[1]);
        } else if ($case === 'upper') {
            return $this->gc->range_upper_alpha ($range[0] , $range[1]);
        }
    }

    /**
     * Detect alphabet case
     *
     * @param string $string
     * @return string|null
     */
    private function alpha_case (string $string): ?string {
        if (preg_match ('@[a-z]@' , $string)) {
            return 'lower';
        } elseif (preg_match ('@[A-Z]@' , $string)) {
            return 'upper';
        } else {
            return null;
        }
    }

}
