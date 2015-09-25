<?php

namespace atoum\AtoumBundle\Test\Asserters;

use mageekguy\atoum;
use mageekguy\atoum\asserter;
use mageekguy\atoum\asserters;
use atoum\AtoumBundle\Test\Asserters\PhpString;
use atoum\AtoumBundle\Test\Asserters\PhpFloat;
use atoum\AtoumBundle\Test\Asserters\Integer;
use atoum\AtoumBundle\Test\Asserters\Boolean;

class RecursiveArray extends asserters\phpArray
{
    /** @var \atoum\AtoumBundle\Test\Asserters\Crawler  */
    private $parent;


    /**
     * Set parent
     *
     * @param \atoum\AtoumBundle\Test\Asserters\RecursiveArray $parent
     */
    public function setParent(RecursiveArray $parent)
    {
        $this->parent = $parent;
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\variable
     */
    public function hasVariable($key)
    {
        $asserter = new Variable($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return RecursiveArray
     */
    public function hasArray($key)
    {
        $asserter = new RecursiveArray($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\integer
     */
    public function hasInteger($key)
    {
        $asserter = new Integer($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\float
     */
    public function hasFloat($key)
    {
        $asserter = new PhpFloat($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\string
     */
    public function hasString($key)
    {
        $asserter = new PhpString($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     *
     * @return \mageekguy\atoum\asserters\boolean
     */
    public function hasBoolean($key)
    {
        $asserter = new Boolean($this->generator);
        $asserter->setParent($this);
        $asserter->setWithTest($this->test);

        return $asserter->setWith($this->value[$key], $key);
    }

    /**
     * @param string $key
     */
    public function hasNot($key, $failMessage = null)
    {
        if (!array_key_exists($key, $this->value)) {
            $this->pass();
        } else {
            $this->fail($failMessage ?: $this->_('key %s exists in array', $key));
        }

        return $this;
    }

    public function end()
    {
        return $this->parent;
    }
}
