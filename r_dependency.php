<?php
interface LowLevelInterface {
    public function operation(): string;
}

// Implementation of the interface by a lower-level module
class LowLevelClass implements LowLevelInterface {

    /**
     * @return string
     */
    public function operation(): string
    {
        return "Low level operation\n";
    }
}

// The high-level module now depends on the abstraction
class HighLevelClass {

    /**
     * @var LowLevelInterface
     */
    private LowLevelInterface $lowLevel;

    /**
     * @param LowLevelInterface $lowLevel
     */
    public function __construct(LowLevelInterface $lowLevel) {
        $this->lowLevel = $lowLevel;
    }

    /**
     * @return string
     */
    public function perform(): string
    {
        return $this->lowLevel->operation();
    }
}

// Creating dependencies and passing them through the constructor
$lowLevel = new LowLevelClass();
$highLevel = new HighLevelClass($lowLevel);
echo $highLevel->perform(); // Will output "low level operation"