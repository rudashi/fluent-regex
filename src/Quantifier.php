<?php

declare(strict_types=1);

namespace Rudashi;

enum Quantifier: string
{
    /**
     * Matches the token once or not at all.
     */
    case ZERO_OR_ONE = '?';

    /**
     * Matches the token between zero and unlimited times.
     */
    case ZERO_OR_MORE = '*';

    /**
     * Matches the token between one and unlimited times.
     */
    case ONE_OR_MORE = '+';
}
