<?php

namespace AcquiaCloudApi\Tests\Endpoints;

use AcquiaCloudApi\Tests\CloudApiTestCase;
use AcquiaCloudApi\Endpoints\Account;

class DrushTest extends CloudApiTestCase
{

    public function testGetApplications()
    {
        $response = $this->getPsr7GzipResponseForFixture('Endpoints/getDrushAliases.json');
        $client = $this->getMockClient($response);

      /** @var \AcquiaCloudApi\CloudApi\ClientInterface $client */
        $account = new Account($client);
        $result = $account->getDrushAliases();

        $headers = $response->getHeader('Content-Type');
        $this->assertEquals('application/gzip', reset($headers));

        $this->assertNotInstanceOf('\ArrayObject', $result);
        $this->assertInstanceOf('GuzzleHttp\Psr7\Stream', $result);
    }
}
