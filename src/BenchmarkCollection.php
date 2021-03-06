<?php

/*
 * Copyright (c) Tyler Sommer
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace Nice\Benchmark;

/**
 * A collection of Benchmarks
 */
class BenchmarkCollection implements BenchmarkInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var array|BenchmarkInterface[]
     */
    protected $benchmarks = array();

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct($name = 'A simple bunch of benchmarks')
    {
        $this->name = $name;
    }

    /**
     * Add a Benchmark to this Collection
     *
     * @param BenchmarkInterface $benchmark
     */
    public function addBenchmark(BenchmarkInterface $benchmark)
    {
        $this->benchmarks[] = $benchmark;
    }

    /**
     * Get the name of the Benchmark
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get all registered Tests
     *
     * @return array|\Nice\Benchmark\TestInterface[]
     */
    public function getTests()
    {
        $tests = array();
        foreach ($this->benchmarks as $benchmark) {
            $tests += $benchmark->getTests();
        }

        return $tests;
    }

    /**
     * Execute the registered tests and return the results
     *
     * @return array The results
     */
    public function execute()
    {
        $results = array();
        foreach ($this->benchmarks as $benchmark) {
            $results += $benchmark->execute();
        }

        return $results;
    }

    /**
     * @param array|\Nice\Benchmark\BenchmarkInterface[] $benchmarks
     */
    public function setBenchmarks($benchmarks)
    {
        $this->benchmarks = $benchmarks;
    }

    /**
     * @return array|\Nice\Benchmark\BenchmarkInterface[]
     */
    public function getBenchmarks()
    {
        return $this->benchmarks;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = (string) $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
