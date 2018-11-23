<?php
/**
 * Part of CodeIgniter Composer Installer
 * 
 * For ci-blox/ciauth, All credits to:
 *
 * @author     Kenji Suzuki <https://github.com/kenjis>
 * @license    MIT License
 * @copyright  2015 Kenji Suzuki
 * @link       https://github.com/kenjis/codeigniter-composer-installer
 */

namespace InstallCI4;

use Composer\Script\Event;
use PHPUnit\Framework\Constraint\DirectoryExists;

class ComposerScripts
{
    const DOCROOT = 'public';

    /**
     * Composer post install script
     *
     * @param Event $event
     */
    public static function postInstall(Event $event = null)
    {
        // Copy Key CodeIgniter files
        //self::recursiveCopy('vendor/codeigniter4/framework/application', 'application');
        self::recursiveCopy('./vendor/codeigniter4/framework/application/Filters', './Application/Filters');
        //self::recursiveCopy('vendor/codeigniter4/framework/public', 'public');
        self::recursiveCopy('./vendor/codeigniter4/framework/writable', './writable');
        self::recursiveCopy('./vendor/codeigniter4/framework/tests', './tests');
        copy('./vendor/codeigniter4/framework/spark', './spark');
        copy('./vendor/codeigniter4/framework/phpunit.xml.dist', './phpunit.xml.dist');
        copy('./vendor/codeigniter4/framework/.gitignore', './.gitignore');
        //copy('vendor/codeigniter4/framework/env', 'env');

        // Fix paths in Paths.php
        self::replacePaths();

        // Create .env file
        self::createDotEnv();

        // Update composer.json
        //copy('composer.json.dist', 'composer.json');

        // Run composer update
        //self::composerUpdate();

        // Show message
        self::showMessage($event);

        // Delete unneeded files
        //self::cleanupSelf();
    }

    private static function createDotEnv()
    {
        copy('./vendor/codeigniter4/framework/env', './.env');
        $file = '.env';
        $contents = file_get_contents($file);
        $contents = str_replace(
            '# app.baseURL = \'\'',
            'app.baseURL = \'http://localhost:8080/\'',
            $contents
        );
        $contents = str_replace(
            '# database.default',
            'database.default',
            $contents
        );
        file_put_contents($file, $contents);
    }

    private static function replacePaths()
    {
        $file = './Application/Config/Paths.php';
        $contents = file_get_contents($file);
        $contents = str_replace(
            'public $systemDirectory = \'system\';',
            'public $systemDirectory = \'vendor/codeigniter4/framework/system\';',
            $contents
        );
    //    file_put_contents($file, $contents);
    }

    
    private static function composerUpdate()
    {
        passthru('composer update');
    }

    /**
     * Composer post install script
     *
     * @param Event $event
     */
    private static function showMessage(Event $event = null)
    {
        $io = $event->getIO();
        $io->write('=======================================================');
        $io->write('<info>CodeIgniter4 was configured and .env file created.</info>');
        $io->write('=======================================================');
    }

    private static function cleanupSelf()
    {
        unlink(__FILE__);
        rmdir('src');
        unlink('composer.json.dist');
        unlink('LICENSE.md');
    }

    /**
     * Recursive Copy
     *
     * @param string $src
     * @param string $dst
     */
    private static function recursiveCopy($src, $dst)
    {
        if (!is_dir($dst )) 
            mkdir($dst, 0755);
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $file) {
            //echo $file;
            if ($file->isDir() && !is_dir($dst . '/' . $iterator->getSubPathName())) {
                mkdir($dst . '/' . $iterator->getSubPathName());
            } else if (!$file->isDir())  {
                copy($file, $dst . '/' . $iterator->getSubPathName());
            }
        }
    }
}
