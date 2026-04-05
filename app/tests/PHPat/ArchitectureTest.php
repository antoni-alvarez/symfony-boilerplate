<?php

declare(strict_types=1);

namespace Tests\PHPat;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

class ArchitectureTest
{
    public function testHexagonalDomainIndependence(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain'))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('App\Domain'),
                Selector::inNamespace('Psr'),
                Selector::inNamespace('Ramsey\Uuid'),
            );
    }

    public function testHexagonalApplicationIndependence(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Application'))
            ->canOnlyDependOn()
            ->classes(
                Selector::inNamespace('App\Application'),
                Selector::inNamespace('App\Domain'),
                Selector::inNamespace('Psr'),
                Selector::inNamespace('Ramsey\Uuid'),
            );
    }
}
