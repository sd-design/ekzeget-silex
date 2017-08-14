<?php
namespace views\assets;


use services\ViewServiceProvider;

abstract class AssetBundle
{
    protected static $assets = [], $depends = [];
    private static $inclTags = [
        'css' => '<link type="text/css" rel="stylesheet" href="%s" />',
        'js' => '<script defer src="%s"></script>',
    ];

    public static function register(ViewServiceProvider $view)
    {
        $view->setAssets(self::renderResources());
    }

    protected static function renderResources()
    {
        $html = '';
        foreach (static::$depends as $dependency) {
            $html .= $dependency::renderResources();
        }
        foreach (static::$assets as $group => $assets) {
            if (!key_exists($group, self::$inclTags))
            {continue;}
            foreach ($assets as $asset) {
                $html .= self::applyTag(
                    self::resolvePaths($asset, $group), $group
                );
            }
        }

        return $html;
    }

    private static function resolvePaths($asset, $group)
    {
        if (!self::validateAsset($asset))
        {return [];}

        if (self::isAssetFile($asset, $group)) {
            if(self::isLocalAsset($asset)) {
                $asset = get_app()['assets.url'] . $asset;
            }
            return [$asset];
        } else {
            return self::resolveDirAssets($asset, $group);
        }
    }

    private static function applyTag(Array $paths, $group)
    {
        $res = '';
        foreach ($paths as $path) {
            $res .= sprintf(self::$inclTags[$group], $path);
        }
        return $res;
    }

    private static function validateAsset($asset)
    {
        return !self::isLocalAsset($asset) || file_exists(get_app()['assets.root'] . $asset);
    }

    private static function isLocalAsset($asset)
    {
        return !(substr($asset, 0, 2) === '//'
            || substr($asset, 0, 4) === 'http');
    }

    private static function isAssetFile($asset, $group)
    {
        return substr($asset, -strlen($group)) === $group;
    }

    /**
     * @param $asset
     * @param $group
     * @return array
     */
    private static function resolveDirAssets($asset, $group)
    {
        $assetsOfDir = glob(get_app()['assets.root'] . $asset . '/*.' . $group);
        $handledAssetsOfDir = [];
        foreach ($assetsOfDir as $assetEntry) {
            $handledAssetsOfDir[] = str_replace(get_app()['assets.root'], get_app()['assets.url'], $assetEntry);
        }
        return $handledAssetsOfDir;
    }
}