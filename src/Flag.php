<?php

declare(strict_types=1);

namespace Rudashi;

enum Flag: string
{
    /**
     * Letters in the pattern match both upper and lower case letters.
     */
    case INSENSITIVE = 'i';

    /**
     * Allows to search across multiple lines.
     */
    case MULTI_LINE = 'm';

    /**
     * A dot metacharacter in the pattern matches all characters, including newlines.
     */
    case SINGLE_LINE = 's';

    /**
     * Whitespace data characters in the pattern are totally ignored.
     */
    case EXTENDED = 'x';

    /**
     * Pattern and context strings are treated as UTF-8.
     */
    case UNICODE = 'u';
}
