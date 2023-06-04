<?php
namespace FakeContent;

/* todo: edit belowe line */

//use App\Libraries\TEFakeContent\Interpreter\Interpreter;

class FakeContent
{

    /**
     * Interpreter class object
     *
     * @var object
     */
    private object $interpreter;

    /**
     * Assignment "interpreter" property
     */
    public function __construct () {
        $this->interpreter = new Interpreter ();
    }

    /**
     * To generate content for multi field, usful for database
     *
     * Placeholder to generate content are:
     * # => ordinal number , [#] => random number
     * $ => ordinal upper alpha , [$] => random upper alpha
     * @ => ordinal lower alpha , [@] => random lower alpha
     * [%] => random sign
     * [a-z]  => lower case alpha range , [A-Z] => upper case alpha range , [10-100] => number range
     * date() => only current date , time() => only current time , date_time() => generate current date & time , timestamp() => generate current timestamp
     * hash( content , hash method ) => hash methods are: md5,sha1,password_default
     * lorem_char ( min , max[optional] ) , lorem_word ( min , max[optional] )
     *
     * The placeholders must seperated by pipe sign "|"
     *
     * @param array $fields
     * @param int $count
     * @return array
     */
    public function fields (array $fields , int $count = 10): array {
        return $this->interpreter->make_fields ($fields , $count);
    }

    /**
     * Generate content for one field
     *
     * Placeholder to generate content are:
     * # => ordinal number , [#] => random number
     * $ => ordinal upper alpha , [$] => random upper alpha
     * @ => ordinal lower alpha , [@] => random lower alpha
     * [%] => random sign
     * [a-z]  => lower case alpha range , [A-Z] => upper case alpha range , [10-100] => number range
     * date() => only current date , time() => only current time , date_time() => generate current date & time , timestamp() => generate current timestamp
     * hash( content , hash method ) => hash methods are: md5,sha1,password_default
     * lorem_char ( min , max[optional] ) , lorem_word ( min , max[optional] )
     *
     * The placeholders must seperated by pipe sign "|"
     *
     * @param string $field
     * @return string
     */
    public function field (string $field): string {
        return $this->interpreter->make_field ($field);
    }

}
