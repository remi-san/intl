<?php

namespace RemiSan\Intl;

class ResourceTranslator
{
    /** @var string */
    private $resourcesDirectory;

    /**
     * @var \ResourceBundle[]
     */
    private $resourceBundles;

    /**
     * Constructor.
     *
     * @param $resourcesDirectory
     */
    public function __construct($resourcesDirectory)
    {
        $this->resourcesDirectory = $resourcesDirectory;
        $this->resourceBundles = [];
    }

    /**
     * Translate the $resource
     *
     * @param string $locale
     * @param string $resource
     * @param array  $params
     *
     * @throws \IntlException
     * @return string
     */
    public function translate($locale, $resource, array $params = [])
    {
        $canonicalLocale = \Locale::canonicalize($locale);
        $messageFormatter = new \MessageFormatter(
            $canonicalLocale,
            $this->retrievePattern($canonicalLocale, $resource)
        );

        return $messageFormatter->format($params);
    }

    /**
     * Retrieve the pattern from the resource bundle
     *
     * @param string $locale
     * @param string $key
     *
     * @throws \IntlException
     * @return mixed
     */
    private function retrievePattern($locale, $key)
    {
        $resBundle = $this->getResourceBundle($locale);

        $pattern = $resBundle->get($key);

        if ($pattern === null) {
            throw new \IntlException($resBundle->getErrorMessage(), $resBundle->getErrorCode());
        }

        return $pattern;
    }

    /**
     * @param string $locale
     *
     * @throws \IntlException
     * @return \ResourceBundle
     */
    private function getResourceBundle($locale)
    {
        if (!isset($this->resourceBundles[$locale])) {
            $resourceBundle = \ResourceBundle::create($locale, $this->resourcesDirectory, true);

            if ($resourceBundle === null) {
                throw new \IntlException('Could not create resource bundle');
            }

            $this->resourceBundles[$locale] = $resourceBundle;
        }

        return $this->resourceBundles[$locale];
    }
}
