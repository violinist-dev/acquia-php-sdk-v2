<?php

namespace AcquiaCloudApi\Endpoints;

use AcquiaCloudApi\Connector\ClientInterface;
use AcquiaCloudApi\Response\IdesResponse;
use AcquiaCloudApi\Response\IdeResponse;
use AcquiaCloudApi\Response\OperationResponse;

/**
 * Class Ides
 * @package AcquiaCloudApi\CloudApi
 */
class Ides extends CloudApiBase implements CloudApiInterface
{

    /**
     * Returns a list of remote IDEs.
     *
     * @param string $applicationUuid The application ID
     * @return IdesResponse
     */
    public function getAll($applicationUuid)
    {
        return new IdesResponse(
            $this->client->request(
                'get',
                "/applications/${applicationUuid}/ides"
            )
        );
    }

    /**
     * Get remote IDE info.
     *
     * @param string $ideUuid The Remote IDE universally unique identifier.
     * @return IdeResponse
     */
    public function get($ideUuid)
    {
        return new IdeResponse(
            $this->client->request(
                'get',
                "/ides/${ideUuid}"
            )
        );
    }

    /**
     * Creates a new remote IDE.
     *
     * @param string $applicationUuid
     * @param string $name
     * @return OperationResponse
     */
    public function create($applicationUuid, $name)
    {

        $options = [
            'form_params' => [
                'name' => $name,
            ],
        ];

        return new OperationResponse(
            $this->client->request('post', "/applications/${applicationUuid}/ides", $options)
        );
    }

    /**
     * De-provisions a specific Remote IDE.
     *
     * @param string $ideUuid
     * @return OperationResponse
     */
    public function delete($ideUuid)
    {
        return new OperationResponse(
            $this->client->request('delete', "/ides/{ideUuid}")
        );
    }
}
