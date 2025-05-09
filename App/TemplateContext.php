<?php

namespace App;

use http\Url;

class TemplateContext extends Bone
{
    public string $title = "";
    public string $head;
    public bool $container = true;
    public string $titleSuffix = "";
    public DependencyContainer $dc;

    public function setTitleSuffix(string $suffix): TemplateContext
    {
        $this->titleSuffix = $suffix;
        return $this;
    }

    public function setTitle(string $title, bool $suffix = true): TemplateContext
    {
        $this->title = $title . ($suffix ? $this->titleSuffix : "");
        return $this;
    }

    public function headLink(string $href, string $rel): TemplateContext
    {
        $this->head .= '<link href="' . $href . '" rel="' . $rel . '">';
        return $this;
    }

    public function headScript(string $src, string $type): TemplateContext
    {
        $this->head .= '<script src="' . $src . '" type="' . $type . '"></script>';
        return $this;
    }

    public function headStyle(string $href, string $type): TemplateContext
    {
        $this->head .= '<link href="' . $href . '" type="' . $type . '" rel="stylesheet">';
        return $this;
    }

    public function headMeta(string $name, string $content): TemplateContext
    {
        $this->head .= '<meta name="' . $name . '" content="' . $content . '">';
        return $this;
    }

    public function script(string $src, string $type): TemplateContext
    {
        $this->head .= '<script src="' . $src . '" type="' . $type . '"></script>';
        return $this;
    }
}
