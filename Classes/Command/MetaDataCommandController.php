<?php
namespace Neos\MetaData\Extractor\Command;

/*
 * This file is part of the Neos.MetaData.Extractor package.
 */

use Neos\MetaData\Extractor\Domain\ExtractionManager;
use Neos\MetaData\Extractor\Exception\ExtractorException;
use Neos\MetaData\Extractor\Exception\NoExtractorAvailableException;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;
use TYPO3\Media\Domain\Model\Asset;
use TYPO3\Media\Domain\Repository\AssetRepository;

/**
 * @Flow\Scope("singleton")
 */
class MetaDataCommandController extends CommandController
{
    /**
     * @Flow\Inject
     * @var AssetRepository
     */
    protected $assetRepository;

    /**
     * @Flow\Inject
     * @var ExtractionManager
     */
    protected $extractionManager;

    /**
     * Extracts MetaData from Assets
     */
    public function extractCommand()
    {
        $iterator = $this->assetRepository->findAllIterator();
        $assetCount = $this->assetRepository->countAll();

        $this->output->progressStart($assetCount);
        foreach ($this->assetRepository->iterate($iterator) as $asset) {
            /** @var Asset $asset */
            try {
                $this->extractionManager->extractMetaData($asset);
            } catch (NoExtractorAvailableException $exception) {
                $this->output->outputLine(' ' . $exception->getMessage());
            } catch (ExtractorException $exception) {
                $this->output->outputLine(' ' . $exception->getMessage());
            }

            $this->output->progressAdvance(1);
        }

        $this->outputLine("\nFinished extraction.");
    }
}
