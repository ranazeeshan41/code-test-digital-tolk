<?php

use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testCreateOrUpdateWithNewCustomer()
    {
        $requestData = [
            'role' => env('CUSTOMER_ROLE_ID'),
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];

        $userModelMock = $this->createMock(User::class);
        $userModelMock->expects($this->once())
            ->method('save')
            ->willReturn(true);
        $userMetaModelMock = $this->createMock(UserMeta::class);
        $userMetaModelMock->expects($this->once())
            ->method('save')
            ->willReturn(true);

        $userRepository = new UserRepository($userModelMock);

        $result = $userRepository->createOrUpdate(null, $requestData);

        $this->assertInstanceOf(User::class, $result);
    }

    public function testCreateOrUpdateWithExistingTranslator()
    {
        $requestData = [
            'role' => env('TRANSLATOR_ROLE_ID'),
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
        ];

        $userModelMock = $this->createMock(User::class);
        $userModelMock->expects($this->once())
            ->method('save')
            ->willReturn(true);

        $userRepository = new UserRepository($userModelMock);

        $result = $userRepository->createOrUpdate(1, $requestData);

        $this->assertInstanceOf(User::class, $result);
    }
}
