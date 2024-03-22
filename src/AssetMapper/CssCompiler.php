<?php

namespace App\AssetMapper;

use Symfony\Component\AssetMapper\AssetMapperInterface;
use Symfony\Component\AssetMapper\Compiler\AssetCompilerInterface;
use Symfony\Component\AssetMapper\MappedAsset;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsDecorator('sass.css_asset_compiler')]
class CssCompiler implements AssetCompilerInterface
{
    public function __construct(
        private AssetCompilerInterface $sassCompiler,
        #[Autowire(service: 'tailwind.css_asset_compiler')]
        private AssetCompilerInterface $tailwindCompiler
    )
    {
    }

    public function supports(MappedAsset $asset): bool
    {
        return $this->sassCompiler->supports($asset);
    }

    public function compile(string $content, MappedAsset $asset, AssetMapperInterface $assetMapper): string
    {
        $content = $this->sassCompiler->compile($content, $asset, $assetMapper);
        return $this->tailwindCompiler->compile($content, $asset, $assetMapper);
    }
}