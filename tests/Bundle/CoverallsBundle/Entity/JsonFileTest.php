<?php

namespace PhpCoveralls\Tests\Bundle\CoverallsBundle\Entity;

use PhpCoveralls\Bundle\CoverallsBundle\Collector\CloverXmlCoverageCollector;
use PhpCoveralls\Bundle\CoverallsBundle\Entity\Git\Commit;
use PhpCoveralls\Bundle\CoverallsBundle\Entity\Git\Git;
use PhpCoveralls\Bundle\CoverallsBundle\Entity\Git\Remote;
use PhpCoveralls\Bundle\CoverallsBundle\Entity\JsonFile;
use PhpCoveralls\Bundle\CoverallsBundle\Entity\SourceFile;
use PhpCoveralls\Bundle\CoverallsBundle\Version;
use PhpCoveralls\Tests\ProjectTestCase;

/**
 * @covers \PhpCoveralls\Bundle\CoverallsBundle\Entity\Coveralls
 * @covers \PhpCoveralls\Bundle\CoverallsBundle\Entity\JsonFile
 *
 * @author Kitamura Satoshi <with.no.parachute@gmail.com>
 *
 * @internal
 */
final class JsonFileTest extends ProjectTestCase
{
    /**
     * @var JsonFile
     */
    private $object;

    // hasSourceFile()
    // getSourceFile()

    /**
     * @test
     */
    public function shouldNotHaveSourceFileOnConstruction()
    {
        $path = 'test.php';

        static::assertFalse($this->object->hasSourceFile($path));
        static::assertNull($this->object->getSourceFile($path));
    }

    // hasSourceFiles()
    // getSourceFiles()

    /**
     * @test
     */
    public function shouldCountZeroSourceFilesOnConstruction()
    {
        static::assertFalse($this->object->hasSourceFiles());
        static::assertEmpty($this->object->getSourceFiles());
    }

    // getServiceName()

    /**
     * @test
     */
    public function shouldNotHaveServiceNameOnConstruction()
    {
        static::assertNull($this->object->getServiceName());
    }

    // getRepoToken()

    /**
     * @test
     */
    public function shouldNotHaveRepoTokenOnConstruction()
    {
        static::assertNull($this->object->getRepoToken());
    }

    // getServiceJobId()

    /**
     * @test
     */
    public function shouldNotHaveServiceJobIdOnConstruction()
    {
        static::assertNull($this->object->getServiceJobId());
    }

    // getServiceNumber()

    /**
     * @test
     */
    public function shouldNotHaveServiceNumberOnConstruction()
    {
        static::assertNull($this->object->getServiceNumber());
    }

    // getServiceEventType()

    /**
     * @test
     */
    public function shouldNotHaveServiceEventTypeOnConstruction()
    {
        static::assertNull($this->object->getServiceEventType());
    }

    // getServiceBuildUrl()

    /**
     * @test
     */
    public function shouldNotHaveServiceBuildUrlOnConstruction()
    {
        static::assertNull($this->object->getServiceBuildUrl());
    }

    // getServiceBranch()

    /**
     * @test
     */
    public function shouldNotHaveServiceBranchOnConstruction()
    {
        static::assertNull($this->object->getServiceBranch());
    }

    // getServicePullRequest()

    /**
     * @test
     */
    public function shouldNotHaveServicePullRequestOnConstruction()
    {
        static::assertNull($this->object->getServicePullRequest());
    }

    // getGit()

    /**
     * @test
     */
    public function shouldNotHaveGitOnConstruction()
    {
        static::assertNull($this->object->getGit());
    }

    // getRunAt()

    /**
     * @test
     */
    public function shouldNotHaveRunAtOnConstruction()
    {
        static::assertNull($this->object->getRunAt());
    }

    // getMetrics()

    /**
     * @test
     */
    public function shouldHaveEmptyMetrics()
    {
        $metrics = $this->object->getMetrics();

        static::assertSame(0, $metrics->getStatements());
        static::assertSame(0, $metrics->getCoveredStatements());
        static::assertSame(0, $metrics->getLineCoverage());
    }

    // setServiceName()

    /**
     * @test
     */
    public function shouldSetServiceName()
    {
        $expected = 'travis-ci';

        $obj = $this->object->setServiceName($expected);

        static::assertSame($expected, $this->object->getServiceName());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setRepoToken()

    /**
     * @test
     */
    public function shouldSetRepoToken()
    {
        $expected = 'token';

        $obj = $this->object->setRepoToken($expected);

        static::assertSame($expected, $this->object->getRepoToken());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setParallel()

    /**
     * @test
     */
    public function shouldSetParallel()
    {
        $expected = true;

        $obj = $this->object->setParallel($expected);

        static::assertSame($expected, $this->object->getParallel());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setFlagName()

    /**
     * @test
     */
    public function shouldSetFlagName()
    {
        $expected = 'php-7.4';

        $obj = $this->object->setFlagName($expected);

        static::assertSame($expected, $this->object->getFlagName());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setServiceJobId()

    /**
     * @test
     */
    public function shouldSetServiceJobId()
    {
        $expected = 'job_id';

        $obj = $this->object->setServiceJobId($expected);

        static::assertSame($expected, $this->object->getServiceJobId());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setGit()

    /**
     * @test
     */
    public function shouldSetGit()
    {
        $remotes = [new Remote()];
        $head = new Commit();
        $git = new Git('master', $head, $remotes);

        $obj = $this->object->setGit($git);

        static::assertSame($git, $this->object->getGit());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // setRunAt()

    /**
     * @test
     */
    public function shouldSetRunAt()
    {
        $expected = '2013-04-04 11:22:33 +0900';

        $obj = $this->object->setRunAt($expected);

        static::assertSame($expected, $this->object->getRunAt());
        static::assertSame($obj, $this->object);

        return $this->object;
    }

    // addSourceFile()
    // sortSourceFiles()

    /**
     * @test
     */
    public function shouldAddSourceFile()
    {
        $sourceFile = $this->createSourceFile();

        $this->object->addSourceFile($sourceFile);
        $this->object->sortSourceFiles();

        $path = $sourceFile->getPath();

        static::assertTrue($this->object->hasSourceFiles());
        static::assertSame([$path => $sourceFile], $this->object->getSourceFiles());
        static::assertTrue($this->object->hasSourceFile($path));
        static::assertSame($sourceFile, $this->object->getSourceFile($path));
    }

    // toArray()

    /**
     * @test
     */
    public function shouldConvertToArray()
    {
        $expected = [
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $this->object->toArray());
        static::assertSame(json_encode($expected), (string) $this->object);
    }

    /**
     * @test
     */
    public function shouldConvertToArrayWithSourceFiles()
    {
        $sourceFile = $this->createSourceFile();

        $this->object->addSourceFile($sourceFile);

        $expected = [
            'source_files' => [$sourceFile->toArray()],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $this->object->toArray());
        static::assertSame(json_encode($expected), (string) $this->object);
    }

    // service_name

    /**
     * @test
     *
     * @depends shouldSetServiceName
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithServiceName($object)
    {
        $item = 'travis-ci';

        $expected = [
            'service_name' => $item,
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // service_job_id

    /**
     * @test
     *
     * @depends shouldSetServiceJobId
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithServiceJobId($object)
    {
        $item = 'job_id';

        $expected = [
            'service_job_id' => $item,
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // repo_token

    /**
     * @test
     *
     * @depends shouldSetRepoToken
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithRepoToken($object)
    {
        $item = 'token';

        $expected = [
            'repo_token' => $item,
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // parallel

    /**
     * @test
     *
     * @depends shouldSetParallel
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithParallel($object)
    {
        $item = true;

        $expected = [
            'parallel' => $item,
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // git

    /**
     * @test
     *
     * @depends shouldSetGit
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithGit($object)
    {
        $remotes = [new Remote()];
        $head = new Commit();
        $git = new Git('master', $head, $remotes);

        $expected = [
            'git' => $git->toArray(),
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // run_at

    /**
     * @test
     *
     * @depends shouldSetRunAt
     *
     * @param mixed $object
     */
    public function shouldConvertToArrayWithRunAt($object)
    {
        $item = '2013-04-04 11:22:33 +0900';

        $expected = [
            'run_at' => $item,
            'source_files' => [],
            'environment' => ['packagist_version' => Version::VERSION],
        ];

        static::assertSame($expected, $object->toArray());
        static::assertSame(json_encode($expected), (string) $object);
    }

    // fillJobs()

    /**
     * @test
     */
    public function shouldFillJobsForServiceJobId()
    {
        $serviceName = 'travis-ci';
        $serviceJobId = '1.1';
        $serviceBuild = 123;

        $env = [];
        $env['CI_NAME'] = $serviceName;
        $env['CI_JOB_ID'] = $serviceJobId;
        $env['CI_BUILD_NUMBER'] = $serviceBuild;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($serviceName, $object->getServiceName());
        static::assertSame($serviceJobId, $object->getServiceJobId());
        static::assertSame($serviceBuild, $object->getServiceNumber());
    }

    /**
     * @test
     */
    public function shouldFillJobsForServiceNumber()
    {
        $repoToken = 'token';
        $serviceName = 'circleci';
        $serviceNumber = '123';

        $env = [];
        $env['COVERALLS_REPO_TOKEN'] = $repoToken;
        $env['CI_NAME'] = $serviceName;
        $env['CI_BUILD_NUMBER'] = $serviceNumber;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($repoToken, $object->getRepoToken());
        static::assertSame($serviceName, $object->getServiceName());
        static::assertSame($serviceNumber, $object->getServiceNumber());
    }

    /**
     * @test
     */
    public function shouldFillJobsForStandardizedEnvVars()
    {
        /*
         * CI_NAME=codeship
         * CI_BUILD_NUMBER=108821
         * CI_BUILD_URL=https://www.codeship.io/projects/2777/builds/108821
         * CI_BRANCH=master
         * CI_PULL_REQUEST=false
         */

        $repoToken = 'token';
        $parallel = true;
        $serviceName = 'codeship';
        $serviceNumber = '108821';
        $serviceBuildUrl = 'https://www.codeship.io/projects/2777/builds/108821';
        $serviceBranch = 'master';
        $servicePullRequest = 'false';

        $env = [];
        $env['COVERALLS_REPO_TOKEN'] = $repoToken;
        $env['COVERALLS_PARALLEL'] = $parallel;
        $env['CI_NAME'] = $serviceName;
        $env['CI_BUILD_NUMBER'] = $serviceNumber;
        $env['CI_BUILD_URL'] = $serviceBuildUrl;
        $env['CI_BRANCH'] = $serviceBranch;
        $env['CI_PULL_REQUEST'] = $servicePullRequest;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($repoToken, $object->getRepoToken());
        static::assertSame($parallel, $object->getParallel());
        static::assertSame($serviceName, $object->getServiceName());
        static::assertSame($serviceNumber, $object->getServiceNumber());
        static::assertSame($serviceBuildUrl, $object->getServiceBuildUrl());
        static::assertSame($serviceBranch, $object->getServiceBranch());
        static::assertSame($servicePullRequest, $object->getServicePullRequest());
    }

    /**
     * @test
     */
    public function shouldFillJobsForServiceEventType()
    {
        $repoToken = 'token';
        $serviceName = 'php-coveralls';
        $serviceEventType = 'manual';

        $env = [];
        $env['COVERALLS_REPO_TOKEN'] = $repoToken;
        $env['COVERALLS_RUN_LOCALLY'] = '1';
        $env['COVERALLS_EVENT_TYPE'] = $serviceEventType;
        $env['CI_NAME'] = $serviceName;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($repoToken, $object->getRepoToken());
        static::assertSame($serviceName, $object->getServiceName());
        static::assertNull($object->getServiceJobId());
        static::assertSame($serviceEventType, $object->getServiceEventType());
    }

    /**
     * @test
     */
    public function shouldFillJobsForGithubActions()
    {
        $repoToken = 'token';
        $serviceName = 'github';
        $serviceJobId = '1.1';

        $env = [];
        $env['CI_NAME'] = $serviceName;
        $env['CI_JOB_ID'] = $serviceJobId;
        $env['COVERALLS_REPO_TOKEN'] = $repoToken;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($serviceName, $object->getServiceName());
        static::assertSame($serviceJobId, $object->getServiceJobId());
    }

    /**
     * @test
     */
    public function shouldFillJobsForUnsupportedJob()
    {
        $repoToken = 'token';

        $env = [];
        $env['COVERALLS_REPO_TOKEN'] = $repoToken;

        $object = $this->collectJsonFile();

        $same = $object->fillJobs($env);

        static::assertSame($same, $object);
        static::assertSame($repoToken, $object->getRepoToken());
    }

    /**
     * @test
     */
    public function throwRuntimeExceptionOnFillingJobsIfInvalidEnv()
    {
        $this->expectException(\PhpCoveralls\Bundle\CoverallsBundle\Entity\Exception\RequirementsNotSatisfiedException::class);

        $env = [];

        $object = $this->collectJsonFile();

        $object->fillJobs($env);
    }

    /**
     * @test
     */
    public function throwRuntimeExceptionOnFillingJobsWithoutSourceFiles()
    {
        $this->expectException(\RuntimeException::class);

        $env = [];
        $env['TRAVIS'] = true;
        $env['TRAVIS_BUILD_NUMBER'] = '123';
        $env['TRAVIS_JOB_ID'] = '1.1';

        $object = $this->collectJsonFileWithoutSourceFiles();

        $object->fillJobs($env);
    }

    // reportLineCoverage()

    /**
     * @test
     */
    public function shouldReportLineCoverage()
    {
        $object = $this->collectJsonFile();

        static::assertSame(50.0, $object->reportLineCoverage());

        $metrics = $object->getMetrics();

        static::assertSame(2, $metrics->getStatements());
        static::assertSame(1, $metrics->getCoveredStatements());
        static::assertSame(50.0, $metrics->getLineCoverage());
    }

    // excludeNoStatementsFiles()

    /**
     * @test
     */
    public function shouldExcludeNoStatementsFiles()
    {
        $srcDir = $this->srcDir . \DIRECTORY_SEPARATOR;

        $object = $this->collectJsonFile();

        // before excluding
        $sourceFiles = $object->getSourceFiles();
        static::assertCount(4, $sourceFiles);

        // filenames
        $paths = array_keys($sourceFiles);
        $filenames = array_map(function ($path) use ($srcDir) {return str_replace($srcDir, '', $path); }, $paths);

        static::assertContains('test.php', $filenames);
        static::assertContains('test2.php', $filenames);
        static::assertContains('TestInterface.php', $filenames);
        static::assertContains('AbstractClass.php', $filenames);

        // after excluding
        $object->excludeNoStatementsFiles();

        $sourceFiles = $object->getSourceFiles();
        static::assertCount(2, $sourceFiles);

        // filenames
        $paths = array_keys($sourceFiles);
        $filenames = array_map(function ($path) use ($srcDir) {return str_replace($srcDir, '', $path); }, $paths);

        static::assertContains('test.php', $filenames);
        static::assertContains('test2.php', $filenames);
        static::assertNotContains('TestInterface.php', $filenames);
        static::assertNotContains('AbstractClass.php', $filenames);
    }

    protected function legacySetUp()
    {
        $this->setUpDir(realpath(__DIR__ . '/../../..'));

        $this->object = new JsonFile();
    }

    /**
     * @return SourceFile
     */
    protected function createSourceFile()
    {
        $filename = 'test.php';
        $path = $this->srcDir . \DIRECTORY_SEPARATOR . $filename;

        return new SourceFile($path, $filename);
    }

    /**
     * @return string
     */
    protected function getCloverXml()
    {
        $xml = <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<coverage generated="1365848893">
  <project timestamp="1365848893">
    <file name="%s/test.php">
      <class name="TestFile" namespace="global">
        <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="1" coveredstatements="0" elements="2" coveredelements="0"/>
      </class>
      <line num="5" type="method" name="__construct" crap="1" count="0"/>
      <line num="7" type="stmt" count="1"/>
    </file>
    <file name="%s/TestInterface.php">
      <class name="TestInterface" namespace="global">
        <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="0" coveredstatements="0" elements="1" coveredelements="0"/>
      </class>
      <line num="5" type="method" name="hello" crap="1" count="0"/>
    </file>
    <file name="%s/AbstractClass.php">
      <class name="AbstractClass" namespace="global">
        <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="0" coveredstatements="0" elements="1" coveredelements="0"/>
      </class>
      <line num="5" type="method" name="hello" crap="1" count="0"/>
    </file>
    <file name="dummy.php">
      <class name="TestFile" namespace="global">
        <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="1" coveredstatements="0" elements="2" coveredelements="0"/>
      </class>
      <line num="5" type="method" name="__construct" crap="1" count="0"/>
      <line num="7" type="stmt" count="0"/>
    </file>
    <package name="Hoge">
      <file name="%s/test2.php">
        <class name="TestFile" namespace="Hoge">
          <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="1" coveredstatements="0" elements="2" coveredelements="0"/>
        </class>
        <line num="6" type="method" name="__construct" crap="1" count="0"/>
        <line num="8" type="stmt" count="0"/>
      </file>
    </package>
  </project>
</coverage>
XML;

        return sprintf($xml, $this->srcDir, $this->srcDir, $this->srcDir, $this->srcDir);
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function createCloverXml()
    {
        $xml = $this->getCloverXml();

        return simplexml_load_string($xml);
    }

    /**
     * @return JsonFile
     */
    protected function collectJsonFile()
    {
        $xml = $this->createCloverXml();
        $collector = new CloverXmlCoverageCollector();

        return $collector->collect($xml, $this->srcDir);
    }

    /**
     * @return string
     */
    protected function getNoSourceCloverXml()
    {
        return <<<'XML'
<?xml version="1.0" encoding="UTF-8"?>
<coverage generated="1365848893">
  <project timestamp="1365848893">
    <file name="dummy.php">
      <class name="TestFile" namespace="global">
        <metrics methods="1" coveredmethods="0" conditionals="0" coveredconditionals="0" statements="1" coveredstatements="0" elements="2" coveredelements="0"/>
      </class>
      <line num="5" type="method" name="__construct" crap="1" count="0"/>
      <line num="7" type="stmt" count="0"/>
    </file>
  </project>
</coverage>
XML;
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function createNoSourceCloverXml()
    {
        $xml = $this->getNoSourceCloverXml();

        return simplexml_load_string($xml);
    }

    /**
     * @return JsonFile
     */
    protected function collectJsonFileWithoutSourceFiles()
    {
        $xml = $this->createNoSourceCloverXml();
        $collector = new CloverXmlCoverageCollector();

        return $collector->collect($xml, $this->srcDir);
    }
}
