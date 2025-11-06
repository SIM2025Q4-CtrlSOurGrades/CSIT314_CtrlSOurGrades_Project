<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/controllers/CreateUserProfileController.php';
require_once __DIR__ . '/../src/entities/UserProfile.php';

class CreateUserProfileControllerTest extends TestCase
{
    private $controller;
    private $userProfileMock;

    protected function setUp(): void
    {
        // Mock the UserProfile entity
        $this->userProfileMock = $this->createMock(UserProfile::class);

        // Inject mock into controller
        $this->controller = new CreateUserProfileController($this->userProfileMock);
    }

    public function testCreateUserProfileSuccess()
    {
        // Simulate successful creation (e.g., new role: Event Coordinator)
        $this->userProfileMock
            ->expects($this->once())
            ->method('createProfile')
            ->with('Event Coordinator', 'Manages and coordinates volunteering events', 'Active')
            ->willReturn(true);

        $result = $this->controller->CreateUserProfile('Event Coordinator', 'Manages and coordinates volunteering events', 'Active');

        // (If controller is updated to return $message, replace this with assertEquals)
        $this->assertNull($result, "Expected no direct return value from CreateUserProfile()");
    }

    public function testCreateUserProfileFailure()
    {
        // Simulate failed creation (e.g., another role: Data Analyst)
        $this->userProfileMock
            ->expects($this->once())
            ->method('createProfile')
            ->with('Data Analyst', 'Analyzes volunteer engagement and performance data', 'Suspended')
            ->willReturn(false);

        $result = $this->controller->CreateUserProfile('Data Analyst', 'Analyzes volunteer engagement and performance data', 'Suspended');

        $this->assertNull($result);
    }
}
?>

