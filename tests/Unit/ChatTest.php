<?php

use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Domains\Chat\Models\Chat;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    private $randomCompanyUser;
    private $randomCandidateUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        $this->randomCompanyUser = $this->getRandomCompanyUser();
        $this->randomCandidateUser = $this->getRandomCandidateUser();
        $this->randomUser = $this->getRandomUser();
    }


    //TODO Unit test:


    // messages()
    //1) если пользователь авторизован, то АПИ метод отдает код 200 ОК
    //2) если пользователь не авторизован, то АПИ метод отдает 403 Auathorized


    //php artisan test --filter ChatTest

    public function testCreatingNewChat() {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $response = $this->post('/api/chat/create', [
            'candidate_id' => $this->randomCandidateUser->id,
        ]);
        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'New chat created']);
    }

    public function testCreatingWithoutCandidateId() {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $response = $this->post('/api/chat/create');
        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson(['message' => 'Validation errors']);
    }

    public function testCreatingWithCandidateIdWrongFormat() {
        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
        $response = $this->post('/api/chat/create', [
            'candidate_id' => 'TEST',
        ]);
        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson(['message' => 'Validation errors']);
    }

    public function testCreatingNewChatByCandidate() {
        Sanctum::actingAs($this->randomCompanyUser, ['candidate_rules']);
        $response = $this->post('/api/chat/create', [
            'candidate_id' => $this->randomCandidateUser->id,
        ]);
        $response->assertStatus(Response::HTTP_FORBIDDEN);
    }

//    public function testGettingMessagesNewChat() {
//        Sanctum::actingAs($this->randomCompanyUser, ['company_rules']);
//        $response = $this->post('/api/chat/create', [
//            'candidate_id' => $this->randomCandidateUser->id,
//        ]);
//        $response->assertStatus(Response::HTTP_OK)
//            ->assertJson(['message' => 'New chat created']);
//    }

    //sendMessage()
    //1) если валидные параметры, то АПИ метод отдает код 200 ОК и Json сообщение
    //2) если пользователь не авторизован, то АПИ метод отдает 403 Auathorized
    //3) если message не верного формата, то код 400 и текст ошибки валидации
    //4) если chat_id не верного формата, то код 400 и текст ошибки валидации
    //5) если пользователь не участник чата

    public function testCreatingNewMessage() {
        Sanctum::actingAs($this->randomUser, ['company_rules', 'candidate_rules']);

        //TODO создавать чаты фабрикой!
        $createdChat = Chat::create([
            'candidate_id' => $this->randomCandidateUser->id,
            'company_id' => $this->randomCompanyUser->id,
        ]);

        $response = $this->post('/api/chat/send-message', [
            'message' => 'Test',
            'chat_id' => $createdChat->id,
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Message has already sent']);
    }

    public function testCreatingNewMessageWithoutChatId() {
        Sanctum::actingAs($this->randomUser, ['company_rules', 'candidate_rules']);

        $response = $this->post('/api/chat/send-message', [
            'message' => 'Test',
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson(['message' => 'Validation errors']);
    }
}
