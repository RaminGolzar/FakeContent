<?php
namespace App\Libraries\TEFakeContent\GenContent\Handlers;

class Ordinal extends BaseCharacter
{

    /**
     * Return ordinal a lower alphabet
     *
     * @param bool $reset
     * @return string
     */
    public function lower_alpha (bool $reset = false): string {
        static $current = 0 , $rotation = 1;

        $result = $this->alpha ('lowerAlpha' , $reset , $current , $rotation);

        $this->sar ($current , $rotation);

        return $result;
    }

    /**
     * The "sar" stands for Step And Rotation"
     *
     * Set the current character & rotation
     *
     * @param int $current
     * @param int $rotation
     * @return void
     */
    private function sar (int &$current , int &$rotation): void {
        $current++;

        if ($current >= 25) {
            $current = 0;
            $rotation++;
        }
    }

    /**
     * Return ordinal a upper alphabet
     *
     * @param bool $reset
     * @return string
     */
    public function upper_alpha (bool $reset = false): string {
        static $current = 0 , $rotation = 1;

        $result = $this->alpha ('upperAlpha' , $reset , $current , $rotation);

        $this->sar ($current , $rotation);

        return $result;
    }

    /**
     * Checksum for ordering alphabet
     *
     * To controll the $current & $rotation ($step)
     *
     * @param int $current
     * @param int $lap
     * @return void
     */
    private function alpha_checksum (int &$current , int &$step): void {
        if ($current > 25) {
            $current = 0;
            $step++;
        }
    }

    /**
     * Reset $current & $rotation in ordinal alphabet to restart
     *
     * @param int $current
     * @param int $rotation
     * @param bool $reset
     * @return void
     */
    private function alpha_reset (int &$current , int &$rotation , bool &$reset): void {
        if ($reset) {
            $current = 0;
            $rotation = 1;
        }
    }

    /**
     * Return an alphabet
     *
     * @param string $property
     * @param bool $reset
     * @param int $current
     * @param int $rotation
     * @return string
     */
    private function alpha (string $property , bool &$reset , int &$current , int &$rotation): string {
        $this->alpha_reset ($current , $rotation , $reset);

        return $this->alpha_rotation ($property , $current , $rotation);
    }

    /**
     * For multi alphabet in one step
     *
     * Example: "AA" , "GGG" & ...
     *
     * @param string $charKey
     * @param type $current
     * @param type $step
     * @return string
     */
    private function alpha_rotation (string &$property , &$current , &$rotation): string {
        $result = '';

        for ($p = 1; $p <= $rotation; $p++) {
            $this->alpha_checksum ($current , $rotation);

            $result .= $this->$property [$current];
        }

        return $result;
    }

    /**
     * Return a ordinal number
     *
     * @staticvar int $num
     * @param bool $reset
     * @param int $start
     * @return string
     */
    public function num (bool $reset , int $start): string {
        static $num = 0;

        $this->num_checksum ($reset , $num , $start);

        return $num++;
    }

    /**
     * Checksom for ordinal number
     *
     * @param bool $reset
     * @param int $num
     * @param int $start
     * @return void
     */
    private function num_checksum (bool &$reset , int &$num , int &$start): void {
        if ($reset) {
            $num = $start;
        }
    }

}
