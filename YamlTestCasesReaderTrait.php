<?php
namespace MockFromYaml;

use Symfony\Component\Yaml\Yaml;

/** Trait YamlTestCasesReader
 * Contains method for reading test cases from a yaml file.
 * @author Fred Woods
 * @version 1.0.0
 */
trait YamlTestCasesReaderTrait
{
    /** Loads test cases data for a test data provider.
     * @param[in] $path String path of yaml file to read test cases from.
     * @return Array of test cases.
     */
    protected static function readYamlTestCases($path)
    {
        return Yaml::parse(file_get_contents($path));
    }
}
