<?php
namespace widgets;


use models\Version;
use Symfony\Component\HttpFoundation\Request;

class Audio extends Widget
{
    /* @var int $chapterNum */
    protected $chapterNum;

    /* @var string $bookCode */
    protected $bookCode;

    public function run()
    {
        $audioSrc = Version::getAudioSrc(get_app(), $this->bookCode, $this->chapterNum);
        if (file_exists($audioSrc)) {
            return $this->render('audio', [
                'audioUrl' => Version::getAudioUrl(get_app(), $audioSrc)
            ]);
        }

    }
}