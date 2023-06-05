<?php
namespace FakeContent\GenContent\Handlers\LoremIpsum;

require_once './Paths.php';
require_once BASE_LOREM_IPSUM;

class Character extends BaseLoremIpsum
{

    /**
     * Make lorem ipsum with character count
     *
     * @param int $min
     * @param int|null $max <p>pass null value to fix count</p>
     * @return string
     */
    public function make (int $min , ?int $max): string {
        return $this->result ($this->text_index ($min , $max));
    }

    /**
     * Return an array that contains, result length & result offset
     *
     * Keys: "length" , "offset"
     *
     * @param int $min
     * @param int|null $max
     * @return array
     */
    private function text_index (int $min , ?int $max): array {
        $length = $this->get_length ($min , $max);

        return [
            'length' => $length ,
            'offset' => $this->get_offset ($length) ,
        ];
    }

    /**
     * Geting result offset
     *
     * @param int $length
     * @return int
     */
    private function get_offset (int $length): int {
        $length = parent::TEXT_LENGTH - $length;

        return random_int (1 , $length);
    }

    /**
     * Return finally result with char count
     *
     * @param array $charIndex
     * @return string
     */
    private function result (array $charIndex): string {
        $extract = $this->extract ($charIndex);

        $this->finally_prepare ('char' , $extract);

        return $extract;
    }

    /**
     * Extract sub string from "text" property
     *
     * @param array $charIndex
     * @return string
     */
    private function extract (array $charIndex): string {
        return substr ($this->text , $charIndex ['offset'] , $charIndex ['length']);
    }

}
