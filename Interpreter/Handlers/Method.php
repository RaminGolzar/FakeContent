<?php
namespace App\Libraries\TEFakeContent\Interpreter\Handlers;

class Method extends BaseInterpreter
{

    /**
     * Interpreting the method placeholder
     *
     * @param string $method <p>Example: date() or lorem_char(10,40)</p>
     * @return string|null
     */
    public function method (string $method): ?string {
        return $this->run_method ($this->parser ($method));
    }

    /**
     * To call the method
     *
     * Note: this method not have good functional
     *
     * @param array $parseMethod
     * @return string|null
     */
    private function run_method (array $parseMethod): ?string {
        $m = $parseMethod['method'];

        if (!isset ($parseMethod['params'] [0])) {
            return $this->gc->$m ();
        } elseif (isset ($parseMethod['params'] [0]) && !isset ($parseMethod['params'] [1])) {
            return $this->gc->$m ($parseMethod['params'] [0]);
        } elseif (isset ($parseMethod['params'] [0]) && isset ($parseMethod['params'] [1])) {
            return $this->gc->$m ($parseMethod['params'] [0] , $parseMethod['params'] [1]);
        } else {
            return null;
        }
    }

    /**
     * Parsing the method placeholder
     *
     * Return keys: "method" , "params"
     *
     * @param string $method
     * @return array
     */
    private function parser (string $method): array {
        return [
            'method' => $this->get_method_name ($method) ,
            'params' => $this->get_method_params ($method) ,
        ];
    }

    /**
     * Extract the method name for "parser" method
     *
     * @param string $method
     * @return string
     */
    private function get_method_name (string $method): string {
        return substr ($method , 0 , strpos ($method , '('));
    }

    /**
     * Geting the method parameters
     *
     * @param string $method
     * @return array|null
     */
    private function get_method_params (string $method): ?array {
        $extractParams = $this->extract_params ($method);

        return !empty ($extractParams) ? explode (',' , $extractParams) : null;
    }

    /**
     * Extract the method parameters
     *
     * @param string $method
     * @return string|null
     */
    private function extract_params (string $method): ?string {
        $extractParams = substr ($method , strpos ($method , '(') + 1 , -1);

        return $extractParams ?: null;
    }

}
