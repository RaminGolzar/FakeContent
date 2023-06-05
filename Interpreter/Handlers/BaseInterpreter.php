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
        /* ToDo: add a back slash to before namespace */
        $this->gc = new \FakeContent\GenContent\GenContent();
    }

}
