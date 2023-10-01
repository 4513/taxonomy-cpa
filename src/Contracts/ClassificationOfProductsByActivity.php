<?php

declare(strict_types=1);

namespace MiBo\Taxonomy\Contracts;

/**
 * Interface ClassificationOfProductsByActivity
 *
 * @package MiBo\Taxonomy\Contracts
 *
 * @author Michal Boris <michal.boris27@gmail.com>
 *
 * @since 0.1
 *
 * @no-named-arguments Parameter names are not covered by the backward compatibility promise.
 */
interface ClassificationOfProductsByActivity extends ProductTaxonomy
{
    /**
     * Section of the CPA.
     *
     * The first level.
     * Its items are marked with one letter (A-U).
     *
     * @return non-empty-string
     */
    public function getSection(): string;

    /**
     * Division of the CPA.
     *
     * The second level.
     * Its items are marked with two digits (01-99).
     *
     * @return non-empty-string
     */
    public function getDivision(): string;

    /**
     * Group of the CPA.
     *
     * The third level.
     * Its items are marked with three digits - the division + (1-9).
     *
     * @return non-empty-string
     */
    public function getGroup(): string;

    /**
     * Class of the CPA.
     *
     * The fourth level.
     * Its items are marked with four digits - the group + (1-9).
     *
     * @return non-empty-string
     */
    public function getClass(): string;

    /**
     * Category of the CPA.
     *
     * The fifth level.
     * Its items are marked with five digits - the class + (1-9).
     *
     * @return non-empty-string
     */
    public function getCategory(): string;

    /**
     * Subcategory of the CPA.
     *
     * The sixth level.
     * Its items are marked with six digits - the category + (1-9).
     *
     * @return non-empty-string
     */
    public function getSubcategory(): string;

    public function is1996(): bool;

    public function is2002(): bool;

    public function is2008(): bool;

    public function isV2_1(): bool;
}
