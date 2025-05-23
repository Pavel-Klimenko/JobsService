<?php

use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Domains\Chat\Models\Chat;
use App\Domains\Candidates\Models\Candidate;
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

    public function testCreatingNewMessageWithoutChatId() {
        Sanctum::actingAs($this->randomUser, ['company_rules', 'candidate_rules']);

        $response = $this->post('/api/chat/send-message', [
            'message' => 'Test',
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST)
            ->assertJson(['message' => 'Validation errors']);
    }

    public function testCreatingNewMessageFromChatMember() {
        $chat = Chat::first();

        $candidateService = new \App\Services\CandidateService();
        $chatCandidate = $candidateService->getCandidate($chat->candidate_id);
        Sanctum::actingAs($chatCandidate->user, ['candidate_rules']);

        $response = $this->post('/api/chat/send-message', [
            'message' => 'Test',
            'chat_id' => $chat->id,
        ]);

        $response->assertStatus(Response::HTTP_OK)
            ->assertJson(['message' => 'Message has already sent']);
    }

    public function testCreatingNewMessageFromNotChatMember() {
        $chat = Chat::first();
        $notChatMemberCandidate = Candidate::where('id', '!=', $chat->candidate_id)->first();
        Sanctum::actingAs($notChatMemberCandidate->user, ['candidate_rules']);

        $response = $this->post('/api/chat/send-message', [
            'message' => 'Test',
            'chat_id' => $chat->id,
        ]);

        $response->assertStatus(Response::HTTP_INTERNAL_SERVER_ERROR)
            ->assertJson(['message' => 'Current user is not a chat member']);
    }
}

