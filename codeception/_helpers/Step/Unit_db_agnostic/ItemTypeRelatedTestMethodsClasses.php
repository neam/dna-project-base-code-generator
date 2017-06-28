<?php

namespace Step\Unit_db_agnostic;

class ItemTypeRelatedTestMethodsClasses extends \DbAgnosticCodeGuy
{

    /**
     * @Given I generate item related test method classes for all item types
     */
    public function iGenerateItemRelatedTestMethodClassesForAllItemTypes()
    {


    }

    /**
     * @Then I should arrive here without errors
     */
    public function iShouldArriveHereWithoutErrors()
    {
        throw new \Codeception\Exception\Incomplete("Step `I should arrive here without errors` is not defined");
    }

}