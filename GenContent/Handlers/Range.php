<?php
namespace FakeContent\GenContent\Handlers;

require_once './Paths.php';
require_once BASE_CHARACTER;

class Range extends BaseCharacter
{

    /**
     * Return range of lower case alphabet between $start to $end
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public function lower_alpha (string $start , string $end): string {
        $charIndexes = $this->indexes ('lowerAlpha' , strtolower ($start) , strtolower ($end));

        $randomPos = random_int ($charIndexes ['start'] , $charIndexes ['end']);

        return $this->get_alpha ('lowerAlpha' , $randomPos);
    }

    /**
     * Return range of upper case alphabet between $start to $end
     *
     * @param string $start
     * @param string $end
     * @return string
     */
    public function upper_alpha (string $start , string $end): string {
        $charIndexes = $this->indexes ('upperAlpha' , strtoupper ($start) , strtoupper ($end));

        $randomPos = random_int ($charIndexes ['start'] , $charIndexes ['end']);

        return $this->get_alpha ('upperAlpha' , $randomPos);
    }

    /**
     * Return array that contains start & end position in alphabet
     *
     * @param string $property
     * @param string $start
     * @param string $end
     * @return array
     */
    private function indexes (string $property , string $start , string $end): array {
        return [
            'start' => strpos ($this->$property , $start) ,
            'end' => strpos ($this->$property , $end) ,
        ];
    }

    /**
     * Return a alphabet from the parent class
     *
     * @param string $property
     * @param string $pos
     * @return string
     */
    private function get_alpha (string $property , string $pos): string {
        return substr ($this->$property , $pos , 1);
    }

}
