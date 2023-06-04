<?php
namespace FakeContent\Interpreter\Handlers;

abstract class BaseInterpreter
{

    /**
     * GenContent object
     *
     * "gc" stands for Gen Content
     *
     * @var object
     */
    protected object $gc;

    /**
     * Assignment $gc property
     */
    public function __construct () {
        $this->gc = new \App\Libraries\TEFakeContent\GenContent\GenContent();
    }

}
