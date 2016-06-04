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
     * @return \ResourceBundle
     */
    private function getResourceBundle($locale)
    {
        if (!isset($this->resourceBundles[$locale])) {
            $this->resourceBundles[$locale] = new \ResourceBundle($locale, $this->resourcesDirectory, true);
        }

        return $this->resourceBundles[$locale];
    }
}
