<?php

namespace App\Module\Block\Service;

class BlockService
{
    protected $container;
    protected $authorizationChecker;
    protected $eventDispatcher;
    protected $environment;
    protected $temp;

    public function __construct(
        \Psr\Container\ContainerInterface  $container,
        \Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface $authorizationChecker,
        \Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher,
        \Twig\Environment $environment
//        \Symfony\Component\DependencyInjection\ContainerInterface $container
    )
    {
        $this->container = $container;
        $this->authorizationChecker = $authorizationChecker;
        $this->eventDispatcher = $eventDispatcher;
        $this->environment = $environment;
    }

    public function renderBlock(string $block, array $options = []): string
    {
        $block = $this->createBlock($block, $options);
        return $this->render($block);
    }

    public function createBlock(string $block, array $options = []): \App\Module\Block\BlockInterface
    {
        $block = $this->container->get($block);
        if (!$block instanceof \App\Module\Block\BlockInterface)
        {
            throw new \App\Module\Block\Exception\Exception(sprintf('Block is not of type BlockInterface. %s given.', get_class($block)));
        }

        $optionsResolver = new \Symfony\Component\OptionsResolver\OptionsResolver();
        if (method_exists($block, 'configureOptions'))
        {
            $block->configureOptions($optionsResolver);
        }
        $options = $optionsResolver->resolve($options);

        $block->setOptions($options);

        // todo: Disabled as the user does not have a token - due to this running from CLI.
        // Maybe do a check and do the authorisation check if either a token exists or run from non CLI
//        if ($this->authorizationChecker->isGranted('ROLE_BLOCK', $block))
//        {
//            throw new \App\Module\Block\Exception\NotAuthorisedException();
//        }

        return $block;
    }

    public function getTemplate(\App\Module\Block\BlockInterface $block): string
    {
        // Generate the twig filename
        $templateParts = explode('\\', get_class($block));

        // Remove the App namespace
        array_shift($templateParts);

        foreach ($templateParts as $key=>$templatePart)
        {
            // Decamelise the block name into a twig friendly format
            $templatePart = strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $templatePart));
            // Remove any leading underscores
            $templateParts[$key] = trim($templatePart, '_');
        }

        $template = implode('/', $templateParts);
        $template .= '.html.twig';

        return $template;
    }

    public function render(\App\Module\Block\BlockInterface $block): string
    {
        $event = new \App\Module\Block\Event\RenderBlockEvent($block);
        $this->eventDispatcher->dispatch($event);

        return $this->environment->render($this->getTemplate($event->getBlock()), array_merge($block->getOptions(), ['block' => $event->getBlock()]));
    }
}