<?php namespace Vankosoft\ThruwayBundle\Annotation;

use Attribute;
use Doctrine\Common\Annotations\Annotation\Required;

/**
 * WAMP Subscribe
 *
 * How to use:
 *   '@Subscribe("com.example.subscribe1")'
 *
 * @Annotation
 * @Target({"METHOD"})
 *
 */
#[Attribute(Attribute::TARGET_METHOD)]
class Subscribe implements AnnotationInterface
{
    /**
     * @Required()
     * @var string
     */
    protected $value;

    protected $serializerGroups;

    protected $serializerEnableMaxDepthChecks;

    protected $worker;

    /**
     * @var string $match The type of URI matcher to use: "exact" or "prefix".
     */
    protected $match;

    /**
     * @param $options
     * @throws \InvalidArgumentException
     */
    public function __construct($options)
    {
        foreach ($options as $key => $value) {
            if (!property_exists($this, $key)) {
                throw new \InvalidArgumentException(sprintf('Property "%s" does not exist for the Subscribe Annotation', $key));
            }
            $this->$key = $value;
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getSerializerEnableMaxDepthChecks()
    {
        return $this->serializerEnableMaxDepthChecks;
    }

    /**
     * @return mixed
     */
    public function getSerializerGroups()
    {
        return $this->serializerGroups;
    }

    /**
     * @return mixed
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * @return string
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param string $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }
}
