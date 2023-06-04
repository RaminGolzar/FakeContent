<?php
namespace App\Libraries\TEFakeContent\GenContent\Handlers;

class Accidental extends BaseCharacter
{

    /**
     * Return randomly a lower case alphabet
     *
     * @param int $count
     * @return string
     */
    public function lower_alpha (int $count): string {
        return $this->random_char ('lowerAlpha' , $count);
    }

    /**
     * Return randomly a upper case alphabet
     *
     * @param int $count
     * @return string
     */
    public function upper_alpha (int $count): string {
        return $this->random_char ('upperAlpha' , $count);
    }

    /**
     * Return a randomly a number
     *
     * @param int $count
     * @return string
     */
    public function num (int $count): string {
        return $this->random_char ('number' , $count);
    }

    /**
     * Return randomly a sign
     *
     * @param int $count
     * @return string
     */
    public function sign (int $count): string {
        return $this->random_char ('sign' , $count);
    }

    /**
     * Generate a random character from the "char" property
     *
     * @param string $property
     * @param int $count
     * @return string
     */
    private function random_char (string $property , int $count): string {
        $result = '';

        for ($p = 0; $p < $count; $p++) {
            $result .= substr ($this->shuffle ($property) , 0 , 1);
        }

        return $result;
    }

    /**
     * Shuffling "char" property
     *
     * @param string $property
     * @return string
     */
    private function shuffle (string $property): string {
        return str_shuffle ($this->$property);
    }

}
