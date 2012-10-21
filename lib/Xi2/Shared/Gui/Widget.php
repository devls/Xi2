<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 25/08/12
 * Time: 16:11
 */
namespace Xi2\Shared\Gui;

/**
 * Defines widget behaviour and gives a boilerplate for how they return themselves.
 *
 * @author Craig Bass <craig@devls.co.uk>
 */
abstract class Widget
{
    /* @var string */
    private $cssClasses;

    /* @var string */
    private $handle;

    /**
     * Constructs this Widget
     *
     * @param $handle
     * @param array $cssClasses
     */
    public function __construct( $handle, array $cssClasses = array() )
    {

        $this->handle = $handle;
        $this->cssClasses = $cssClasses;

    }

    /**
     * Gets the Widget HTML representation.
     *
     * @return string
     */
    abstract protected function getWidgetHtml();

    /**
     * Returns an array of string css classes
     *
     * @return array
     */
    protected function getCssClasses()
    {

        return $this->cssClasses;

    }

    /**
     * Magically cast this widget to a string.
     *
     * @return string
     */
    public function __toString()
    {

        return sprintf (
            '<widget class="%s%s">%s</widget>',
            $this->handle,
            implode( '', array_unshift( $this->getCssClasses(), '' ) ),
            $this->getWidgetHtml()
        );

    }

    /**
     * Gets an instance of a pseudo widget
     *
     * @param string $templateFile
     * @param string $handle
     * @param array $cssClasses
     * @return Pseudo\Widget
     */
    public static function getPseudo( $templateFile, $handle, array $cssClasses = array() )
    {
        return new Pseudo\Widget( $handle, $cssClasses );
    }

}
