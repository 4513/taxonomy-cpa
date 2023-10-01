<?php

declare(strict_types=1);

namespace MiBo\Taxonomy\Tests;

use MiBo\Taxonomy\CPA;

/**
 * Class CPAProvider
 *
 * @package MiBo\Taxonomy\Tests
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
final class CPAProvider
{
    /**
     * @return array<string, array{
     *     0: \MiBo\Taxonomy\CPA,
     *     1: \MiBo\Taxonomy\CPA,
     *     2: \MiBo\Taxonomy\CPA,
     *     3: \MiBo\Taxonomy\CPA,
     *     4: string,
     *     5?: string,
     *     6?: string,
     *     7?: string,
     *     8?: string,
     *     9?: string
     * }>
     */
    public static function getData(): array
    {
        return [
            CPA::A011->name => [
                CPA::A011,
                CPA::A01112,
                CPA::A01,
                CPA::B06,
                'A',
                '01',
                '1',
            ],
            CPA::A01111->name => [
                CPA::A01111,
                CPA::A01111,
                CPA::A0111,
                CPA::B06,
                'A',
                '01',
                '1',
                '1',
                '1',
            ],
            CPA::A011112->name => [
                CPA::A011112,
                CPA::A011112,
                CPA::A011,
                CPA::B06,
                'A',
                '01',
                '1',
                '1',
                '1',
                '2',
            ],
            CPA::B->name => [
                CPA::B,
                CPA::B07211,
                CPA::B,
                CPA::A,
                'B',
            ],
            CPA::C20->name => [
                CPA::C20,
                CPA::C202,
                CPA::C,
                CPA::C2222,
                'C',
                '20',
            ],
            CPA::D3511->name => [
                CPA::D3511,
                CPA::D351110,
                CPA::D35,
                CPA::B06,
                'D',
                '35',
                '1',
                '1',
            ],
        ];
    }

    /** @return array<string, array{0: bool, 1: string}> */
    public static function getDataToValidate(): array
    {
        return [
            'Does not exists #1' => [
                false,
                'A1',
            ],
            'Does not exists #2' => [
                false,
                'A019999',
            ],
            'Does not exists #3' => [
                false,
                'U11',
            ],
            'Fine #1' => [
                true,
                'A',
            ],
            'Fine #2' => [
                true,
                'A01',
            ],
            'Fine #3' => [
                true,
                'A011',
            ],
            'Fine #4' => [
                true,
                'A0111',
            ],
            'Fine #5' => [
                true,
                'A01111',
            ],
            'Fine #6' => [
                true,
                'A011111',
            ],
            'Regex False #1 Invalid section' => [
                false,
                'Z123345',
            ],
            'Regex False #2 Invalid length' => [
                false,
                'A011111111111',
            ],
            'Regex False #3 Empty' => [
                false,
                '',
            ],
        ];
    }
}
