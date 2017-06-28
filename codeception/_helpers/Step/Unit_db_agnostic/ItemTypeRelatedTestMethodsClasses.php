<?php

namespace Step\Unit_db_agnostic;

use ItemTypes;

class ItemTypeRelatedTestMethodsClasses extends \DbAgnosticCodeGuy
{

    /**
     * @Given I generate item related test method classes for all item types
     */
    public function iGenerateItemRelatedTestMethodClassesForAllItemTypes()
    {

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

        foreach (ItemTypes::all() as $itemTypePhpName => $dbTable) {

            $destinationPath = \Paths::dna(
                ) . DIRECTORY_SEPARATOR . 'tests/codeception/_helpers/Step/Unit_db_dependent/crud/base/' . $itemTypePhpName . 'RelatedTestMethods.php';

            ob_start();
            include \Paths::dna(
                ) . DIRECTORY_SEPARATOR . 'generators/dna-project-base-code-generator-templates/test_crud/codeception/item-type-related-test-methods-base-class.php';
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