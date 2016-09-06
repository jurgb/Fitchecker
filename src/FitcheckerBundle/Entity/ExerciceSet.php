<?php

namespace FitcheckerBundle\Entity;

/**
 * ExerciceSet
 */
class ExerciceSet
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $reps;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reps
     *
     * @param integer $reps
     *
     * @return ExerciceSet
     */
    public function setReps($reps)
    {
        $this->reps = $reps;

        return $this;
    }

    /**
     * Get reps
     *
     * @return int
     */
    public function getReps()
    {
        return $this->reps;
    }
}
