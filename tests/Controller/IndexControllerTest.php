<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\Utils\CreateEntityWebTestCase;

/**
 * @internal
 */
class InboxControllerTest extends CreateEntityWebTestCase
{
    /** @var User */
    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = $this->createEntity(User::class, [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'jdoe@morningcroissant.fr',
            'password '=> 'xx',
        ]);
    }

    protected function tearDown(): void
    {
        $this->user = null;

        parent::tearDown();
    }

    public function testCountUserUnreadConversations()
    {
        // Not logued
        $this->client->request('GET', '/count', [], [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        // No Ajax
        $this->setLoggedClient($this->user);
        $this->client->request('GET', '/count');
        $this->assertFalse($this->client->getResponse()->isSuccessful());
        // Ok
        $this->client->request('GET', '/count', [], [], ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $this->assertTrue($this->client->getResponse()->isSuccessful());
        // Ok
    }
}
