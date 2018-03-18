<?php

namespace Step\Unit_db_agnostic;

use ItemTypes;
use Propel\Runtime\Map\TableMap;

class ItemTypeRelatedTestMethodsClasses extends \DbAgnosticCodeGuy
{

    /**
     * @Given I generate item related test method classes for all item types
     */
    public function iGenerateItemRelatedTestMethodClassesForAllItemTypes()
    {

        /*
        // read item types from ItemTypes

        codecept_debug(ItemTypes::all());

        // read item types with metadata from schema.xml

        $modelNamespace = 'propel\\models';
        $contentModelMetadataJsonPath = \Paths::dna() . DIRECTORY_SEPARATOR . 'content-model-metadata.json';

        // Load content model metadata
        $contentModelMetadata = new \sq_personal_unit\dna\config\ContentModelMetadata(
            $contentModelMetadataJsonPath
        );

        $itemTypes = $contentModelMetadata->getItemTypes();

        //codecept_debug($itemTypes);

        // foreach item type, generate file
        $this->generateItemRelatedTestMethodClasses(ItemTypes::all());
        */

        // read item types from propel models

        $propelTableMapsPath = \Paths::dna() . DIRECTORY_SEPARATOR . 'generated-classes' . DIRECTORY_SEPARATOR . 'propel' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Map' . DIRECTORY_SEPARATOR;

        $itemTypesFromPropelModels = [];

        foreach (glob($propelTableMapsPath . '*TableMap.php') as $path) {
            $pathinfo = pathinfo($path);
            $modelName = str_replace("TableMap", "", $pathinfo["filename"]);

            $tableMapClass = "\\propel\\models\\Map\\" . $modelName . "TableMap";
            //codecept_debug($tableMapClass);
            /** @var TableMap $tableMap */
            //$tableMap = new $tableMapClass();

            $itemTypesFromPropelModels[$modelName] = "todo-set-this-if-necessary";

        }

        //codecept_debug($itemTypesFromPropelModels);
        $this->generateItemRelatedTestMethodClasses($itemTypesFromPropelModels);

    }

    protected function generateItemRelatedTestMethodClasses($itemTypes)
    {

        foreach ($itemTypes as $itemTypePhpName => $dbTable) {

            $destinationPath = \Paths::dna() . DIRECTORY_SEPARATOR . 'tests/codeception/_helpers/Step/Unit_db_dependent/crud/base/' . $itemTypePhpName . 'RelatedTestMethods.php';

            ob_start();
            include \Paths::dna() . DIRECTORY_SEPARATOR . 'generators/dna-project-base-code-generator-templates/test_crud/codeception/item-type-related-test-methods-base-class.php';
            $contents = ob_get_clean();

            file_put_contents(
                $destinationPath,
                $contents
            );

        }

    }

    /**
     * @Then I should arrive here without errors
     */
    public function iShouldArriveHereWithoutErrors()
    {
        codecept_debug('All good!');
    }

}