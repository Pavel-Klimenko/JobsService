<?php


use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }


    //TODO Unit test:
    //createChat()
    //1) если валидные параметры, то АПИ метод отдает код 200 ОК
    //2) если  пользователь не авторизован, то АПИ метод отдает 403 Auathorized
    //3) если не передан параметр candidate_id, то получаю JSON сообщение с "candidate_id is required"
    //4) если передан параметр candidate_id в неверном формате, то получаю JSON сообщение с "candidate_id must be integer"
    //5) если АПИ метод отдает код 200 ОК, то вернет сообщение 'New chat created'

    // messages()
    //1) если пользователь авторизован, то АПИ метод отдает код 200 ОК
    //2) если пользователь не авторизован, то АПИ метод отдает 403 Auathorized

    //sendMessage()
    //1) если валидные параметры, то АПИ метод отдает код 200 ОК
    //2) если  пользователь не авторизован, то АПИ метод отдает 403 Auathorized
    //....



//    public function testDatabaseHasChatTables()
//    {
//        $this->assertDatabaseHas('chats', []);
////        $this->assertDatabaseHas('roles');
////        $this->assertDatabaseHas('roles');
//    }

}
