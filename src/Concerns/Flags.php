<?php

declare(strict_types=1);

namespace Rudashi\Concerns;

use Rudashi\Flag;
use Rudashi\FluentBuilder;

trait Flags
{
    /**
     * Adds a flag that ignores the distinction between uppercase and lowercase characters.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function ignoreCase(): FluentBuilder
    {
        return $this->addFlag(Flag::INSENSITIVE);
    }

    /**
     * Adds a flag to support multi-line in a string.
     * Start and end anchor now match each line individually.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function multiline(): FluentBuilder
    {
        return $this->addFlag(Flag::MULTI_LINE);
    }

    /**
     * Adds a flag that allows the dot character (.) to also match newlines.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function matchNewLine(): FluentBuilder
    {
        return $this->addFlag(Flag::SINGLE_LINE);
    }

    /**
     * Adds a flag that ignores all whitespace and allow for comments in the regular expression.
     * Additionally, this flag allows for comments. Run them using the `#` character.
     * However, each space character must be escaped by a `\` character.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function ignoreWhitespace(): FluentBuilder
    {
        return $this->addFlag(Flag::EXTENDED);
    }

    /**
     * Adds a flag where unicode characters will be included in letter and words methods.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function utf8(): FluentBuilder
    {
        return $this->addFlag(Flag::UNICODE);
    }

    /**
     * Alias for the `utf8` method.
     *
     * @return \Rudashi\FluentBuilder
     */
    public function unicode(): FluentBuilder
    {
        return $this->utf8();
    }

    /**
     * Insert flag into pattern.
     *
     * @param  \Rudashi\Flag  $flag
     * @return \Rudashi\FluentBuilder
     */
    private function addFlag(Flag $flag): FluentBuilder
    {
        if (in_array($flag->value, $this->modifiers, true) === false) {
            $this->modifiers[] = $flag->value;
        }

        return $this;
    }
}
