<?php

namespace App\Module;

use App\BaseController;
use App\Template;

class StarryNight extends BaseController
{
    protected function compute(): void
    {
        $this->tpl = new Template("starry_night", $this->tpl_context);
        $this->tpl->assign("svgString", $this->renderPicture());
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $size <1, 3>
     * @return string
     */
    protected function renderStar(int $x, int $y, int $size): string
    {
        return '<circle fill="white" cx="' . $x . '" cy="' . $y . '" r="' . $size . '" />';
    }


    /**
     * @param int $quantity
     * @return string
     */
    protected function generateStars(int $quantity): string
    {
        $stars = "";
        for ($i = 1; $i <= $quantity; $i++) {
            $stars .= $this->renderStar(rand(0, 750) + 25, rand(0, 550) + 25, rand(1, 3));
        }

        return $stars;
    }

    /**
     * @return string
     */
    protected function renderPicture(): string
    {
        $picture = "<svg width='800' height='600' style='background-color: #000022'>";
        $picture .= $this->generateStars(100);
        $picture .= "</svg>";

        return $picture;
    }

}
