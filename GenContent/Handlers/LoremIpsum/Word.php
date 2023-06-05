<?php
namespace FakeContent\GenContent\Handlers\LoremIpsum;

require_once './Paths.php';
require_once BASE_LOREM_IPSUM;

class Word extends BaseLoremIpsum
{

    /**
     * To hold array of main content
     *
     * @var array
     */
    private array $arrayContent = [];

    /**
     * Make a lorem ipsum by word count
     *
     * @param int $min
     * @param int|null $max
     * @return string
     */
    public function make (int $min , ?int $max): string {
        return $this->result ($this->text_index ($min , $max));
    }

    /**
     * casting the "text" property to an array
     *
     * @return void
     */
    private function text_explode (): void {
        $this->cleaning (explode (' ' , $this->text));
    }

    /**
     * Removing an empty keys from an array
     *
     * @param array $array
     * @return void
     */
    private function cleaning (array $array): void {
        foreach ($array as $k => $v) {
            if (!trim ($v)) {
                unset ($array [$k]);
            }
        }

        /* To reindex array */
        shuffle ($array);

        $this->arrayContent = $array;
    }

    /**
     * Return an array that contains, result length & offset
     * for start making
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
     * Return an offset for start point to making result
     *
     * @param int $length
     * @return int
     */
    private function get_offset (int $length): int {
        $length -= count ($this->arrayContent);

        return random_int (1 , $length);
    }

    /**
     * Return finally result
     *
     * @param array $index
     * @return string
     */
    private function result (array $index): string {
        $this->text_explode ();

        $result = $this->extract ($index);

        $this->finally_prepare ('word' , $result);

        return $result;
    }

    /**
     * Extracting a result from the "arrayContent" property
     *
     * @param array $index
     * @return string
     */
    private function extract (array $index): string {
        $result = '';

        for ($p = 0; $p < $index['length']; $p++) {
            $result .= $this->arrayContent [$index ['offset']++] . ' ';
        }

        return $result;
    }

}
