<?php
namespace App\Libraries\TEFakeContent\GenContent\Handlers;

class Hashing
{
    /* ToDo:
     * casting some function to static function
     */

    /**
     * Return a hashed string
     *
     * @param string $content <p>first this content interpreting & next hashing</p>
     * @param string $method <p>allowed: "md5" , "sha1" , "password_hash"</p>
     * @return string|null
     */
    public function make (string $content , string $method): ?string {
        if (method_exists ($this , $method)) {
            return $this->$method ($this->prepare_content ($content));
        } else {
            return null;
        }
    }

    /**
     * This method for interpreting the content
     *
     * @param string $content
     * @return string|null
     */
    private function prepare_content (string $content): ?string {
        $interpreter = new \App\Libraries\TEFakeContent\Interpreter\Interpreter();

        $res = $interpreter->make_field ($content);

        return $res;
    }

    /**
     * Hashing content by "md5" method
     *
     * @param string $content
     * @return string
     */
    private function md5 (string $content): string {
        return md5 ($content);
    }

    /**
     * Hashing the content by "sha1" method
     *
     * @param string $content
     * @return string
     */
    private function sha1 (string $content): string {
        return sha1 ($content);
    }

    /**
     * Hashing the content by "password_hash" method
     *
     * @param string $content
     * @return string
     */
    private function password_hash (string $content): string {
        return password_hash ($content , PASSWORD_DEFAULT);
    }

}
