<?php

use Illuminate\Http\Response;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;
use Tests\Unit\Task\TaskMother;

beforeEach(function(){
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::dummy()->value(),
    ];
    $this->response = $this->post('/api/v1/tasks', $params);
    $this->expected = json_decode($this->response->getContent())->data;
});

it('update a task with all fields', function () {

    $actual = json_decode($this->response->getContent())->data;
    
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::dummy()->value(),
    ];
    $this->patch('/api/v1/tasks/' . $actual->id, $params);

    $response = $this->get('/api/v1/tasks/' . $actual->id);
    
    $actual = json_decode($response->getContent())->data;

    expect($this->expected->id)->toEqual($actual->id);
    expect($this->expected->title)->not->toEqual($actual->title);
    expect($this->expected->status)->not->toEqual($actual->status);
    expect($this->expected->content)->not->toEqual($actual->content);
});

it('update a task with only one fields', function () {
    
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
    ];
    $this->patch('/api/v1/tasks/' . $this->expected->id, $params);

    $response = $this->get('/api/v1/tasks/' . $this->expected->id);
    
    $actual = json_decode($response->getContent())->data;

    expect($this->expected->id)->toEqual($actual->id);
    expect($this->expected->title)->not->toEqual($actual->title);
    expect($this->expected->status)->not->toEqual($actual->status);
    expect($this->expected->content)->toEqual($actual->content);
});

it('update a task with empty status', function () {
    
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
    ];
    $this->patch('/api/v1/tasks/' . $this->expected->id, $params);

    $response = $this->get('/api/v1/tasks/' . $this->expected->id);
    
    $actual = json_decode($response->getContent())->data;

    dump($this->expected);
    dd($actual);
});