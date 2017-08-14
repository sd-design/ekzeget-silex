<?php

namespace widgets;


class BackAndForth extends Widget
{
    /* @var int $total, $current */
    protected $total, $current;

    /* @var string $template, $currentUrlParam, $url */
    protected $template, $currentUrlParam, $url;

    protected $params = [], $urlParams = [];

    public function run()
    {
        $prevParams = $nextParams =
            isset($this->urlParams[$this->currentUrlParam])
                ? $this->urlParams
                : array_merge($this->urlParams, [$this->currentUrlParam => $this->current]);

        $nextParams[$this->currentUrlParam]++;
        $prevParams[$this->currentUrlParam]++;

        return $this->render('back_and_forth/' . $this->template, [
            'back' =>  $this->current > 1 ? get_app()->url($this->url, $prevParams) : false,
            'forth' => $this->current < $this->total ? get_app()->url($this->url, $nextParams) : false,
            'params' => $this->params,
            'current' => $this->current
        ]);
    }
}