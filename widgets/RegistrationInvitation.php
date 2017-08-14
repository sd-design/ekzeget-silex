<?php
namespace widgets;

class RegistrationInvitation extends Widget
{
    protected $top = 0;

    public function run()
    {
        $app = get_app();
        if (!$app['session']->get('loggedin') && !$app['session']->get('showed_invitation')) {
            $app['session']->set('showed_invitation', true);
            return $this->render('notification', [
                'top' => $this->top,
                'text' => $app['translator']->trans('invitation_to_registration'),
                'details' => $app['translator']->trans('benefits_of_registration') . $this->render('reg_or_log'),
            ]);
        }
        return '';
    }
}