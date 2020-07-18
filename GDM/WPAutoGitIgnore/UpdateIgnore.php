<?php

namespace GDM\WPAutoGitIgnore;

use Composer\Script\Event;

class UpdateIgnore
{

    /**
     * @param Event $event
     *
     * @throws Errors\AutoGitIgnoreInvalidParameterException
     * @throws Errors\AutoGitIgnoreParseException
     * @throws Errors\AutoGitIgnorePermissionException
     * @throws Errors\AutoGitIgnoreSaveFailedException
     */
    public static function Go(Event $event)
    {
        $event->getIO()->writeError('<info>Generating .gitignore: </info>', false);
        $gi          = new GitIgnoreEditor(getcwd() . '/.gitignore');
        $packageInfo = new PackageInfo($event->getComposer());
        $ignores     = array();
        foreach ($packageInfo->findAll() as $package) {
            $ignores[] = '/' . $package['path'] ;//. "/";
        }
        $ignores = array_unique($ignores);
        sort($ignores);

        $gi->setLines($ignores);
        $gi->save();
        $event->getIO()->writeError('<info>Done - Set to ignore '.count($ignores).' packages</info>');
    }
}
