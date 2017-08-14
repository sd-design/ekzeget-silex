<?php
namespace widgets;

class RegularVisitor extends Widget
{
    protected $top = 0;

    public function run()
    {
        $app = get_app();
        $res = '';
        if (!$app['session']->get('showed_invitation')) {
            $res = '';
        } elseif (rand(0, $app['appeal_to_donate_odds']) === 1) {
            $res = $this->render('notification', [
                'top' => $this->top,
                'text' => $app['translator']->trans('appeal_to_donate')
            ]);
        }
        return $res;
    }
}