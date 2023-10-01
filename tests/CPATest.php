<?php

declare(strict_types=1);

namespace MiBo\Taxonomy\Tests;

use CompileError;
use MiBo\Taxonomy\CPA;
use PHPUnit\Framework\TestCase;

/**
 * Class CPATest
 *
 * @package MiBo\Taxonomy\Tests
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 *
 * @coversDefaultClass \MiBo\Taxonomy\CPA
 */
final class CPATest extends TestCase
{
    /**
     * @small
     *
     * @covers ::getCode
     * @covers ::getSection
     * @covers ::getDivision
     * @covers ::getGroup
     * @covers ::getClass
     * @covers ::getCategory
     * @covers ::getSubcategory
     * @covers ::is1996
     * @covers ::is2002
     * @covers ::is2008
     * @covers ::isV2_1
     * @covers ::is
     * @covers ::belongsTo
     * @covers ::wraps
     *
     * @param \MiBo\Taxonomy\CPA $sameCPA
     * @param \MiBo\Taxonomy\CPA $child
     * @param \MiBo\Taxonomy\CPA $parent
     * @param \MiBo\Taxonomy\CPA $differentCPA
     * @param string $section
     * @param string|null $division
     * @param string|null $group
     * @param string|null $class
     * @param string|null $category
     * @param string|null $subcategory
     *
     * @return void
     *
     * @dataProvider \MiBo\Taxonomy\Tests\CPAProvider::getData()
     */
    public function testSymbols(
        CPA $sameCPA,
        CPA $child,
        CPA $parent,
        CPA $differentCPA,
        string $section,
        ?string $division = null,
        ?string $group = null,
        ?string $class = null,
        ?string $category = null,
        ?string $subcategory = null
    ): void
    {
        $expectedCode = $section
            . ($division ?? '')
            . ($group ?? '')
            . ($class ?? '')
            . ($category ?? '')
            . ($subcategory ?? '');
        $expectedDivision = $section . ($division ?? '');
        $expectedGroup = $expectedDivision . ($group ?? '');
        $expectedClass = $expectedGroup . ($class ?? '');
        $expectedCategory = $expectedClass . ($category ?? '');
        $expectedSubcategory = $expectedCategory . ($subcategory ?? '');
        $current = CPA::tryFromName($expectedCode);

        $this->assertSame($expectedCode, $current->getCode());
        $this->assertSame($sameCPA->getCode(), $current->getCode());

        $this->assertSame($section, $current->getSection());

        try {
            $this->assertSame($expectedDivision, $current->getDivision());
        } catch (CompileError) {
            $this->assertNull($division);
        }

        try {
            $this->assertSame($expectedGroup, $current->getGroup());
        } catch (CompileError) {
            $this->assertNull($group);
        }

        try {
            $this->assertSame($expectedClass, $current->getClass());
        } catch (CompileError) {
            $this->assertNull($class);
        }

        try {
            $this->assertSame($expectedCategory, $current->getCategory());
        } catch (CompileError) {
            $this->assertNull($category);
        }

        try {
            $this->assertSame($expectedSubcategory, $current->getSubcategory());
        } catch (CompileError) {
            $this->assertNull($subcategory);
        }

        $this->assertTrue($current->isV2_1());
        $this->assertFalse($current->is1996());
        $this->assertFalse($current->is2002());
        $this->assertFalse($current->is2008());

        $this->assertTrue($current->is($sameCPA));
        $this->assertTrue($current->belongsTo($parent));
        $this->assertTrue($current->wraps($child));
        $this->assertFalse($current->is($differentCPA));
    }

    /**
     * @small
     *
     * @covers ::isValid
     * @covers ::wraps
     * @covers ::belongsTo
     *
     * @param bool $isValid
     * @param string $code
     *
     * @return void
     *
     * @dataProvider \MiBo\Taxonomy\Tests\CPAProvider::getDataToValidate()
     */
    public function testValidity(bool $isValid, string $code): void
    {
        $this->assertSame($isValid, CPA::isValid($code));

        if ($isValid) {
            return;
        }

        $this->assertFalse(CPA::A01->wraps($code));
        $this->assertFalse(CPA::A01->belongsTo($code));
    }
}
