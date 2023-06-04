<?php
namespace App\Libraries\TEFakeContent\Interpreter;

use App\Libraries\TEFakeContent\Interpreter\Handlers\Method;
use App\Libraries\TEFakeContent\Interpreter\Handlers\Sign;
use App\Libraries\TEFakeContent\Interpreter\Handlers\Range;

class Interpreter
{

    /**
     * To hold an array of placeholders
     *
     * @var array
     */
    private array $placeholders = [];

    /**
     * For interpreting an array (multi fields)
     *
     * @param array $fields
     * @param int $count
     * @return array
     */
    public function make_fields (array &$fields , int &$count): array {
        $rows = [];

        for ($p = 1; $p <= $count; $p++) {
            $newStep = true;

            foreach ($fields as $fieldKey => &$fieldValue) {
                $row [$fieldKey] = $this->making ($fieldValue , $newStep);

                $newStep = false;
            }

            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * For interpreting one field
     *
     * @param string $field
     * @return string
     */
    public function make_field (string $field): string {
        return $this->making ($field , true);
    }

    /**
     * Generate content for one field
     *
     * @param string $field
     * @param bool $newStep
     * @return string
     */
    private function making (string $field , bool $newStep): string {
        $this->explode_placeholder ($field);

        $this->fetch_placeholders ($newStep);

        return $this->join ();
    }

    /**
     * Exploding the placeholders by pipe sign
     *
     * @param string $field
     * @return void
     */
    private function explode_placeholder (string $field): void {
        $this->placeholders = explode ('|' , $field);
    }

    /**
     * Fetch placeholders & send placeholder to one method for
     * interpret each
     *
     * @param bool $newStep
     * @return void
     */
    private function fetch_placeholders (bool &$newStep): void {
        foreach ($this->placeholders as &$placeholder) {
            $placeholder = $this->interpreter ($placeholder , $newStep);
        }
    }

    /**
     * Detect & interpreting the placeholders
     *
     * @param string|null $placeholder
     * @param bool $newStep <p>that is new field</p>
     * @return string|null
     */
    private function interpreter (?string $placeholder , bool &$newStep): ?string {
        if (strpos ($placeholder , '(') !== false) {
            $method = new Method ();
            return $method->method ($placeholder);
        } elseif ((strpos ($placeholder , '[') !== false && strpos ($placeholder , '-') === false) || strpos ($placeholder , '#') !== false || strpos ($placeholder , '$') !== false || strpos ($placeholder , '@') !== false || strpos ($placeholder , '%') !== false) {
            $sign = new Sign ();
            return $sign->sign ($placeholder , $newStep);
        } elseif (strpos ($placeholder , '[') !== false && strpos ($placeholder , '-') !== false) {
            $range = new Range();
            return $range->range ($placeholder);
        } else {
            /* that is simple text & not a placeholder */
            return $placeholder;
        }
    }

    /**
     * Casting an array of content to a string
     *
     * This is finally result
     *
     * @return string
     */
    private function join (): string {
        return join ('' , $this->placeholders);
    }

}
