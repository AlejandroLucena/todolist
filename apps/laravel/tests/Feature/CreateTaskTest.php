<?php

use Illuminate\Http\Response;
use Tests\Unit\Task\Domain\ValueObject\TaskContentMother;
use Tests\Unit\Task\Domain\ValueObject\TaskTitleMother;
use Tests\Unit\Task\Domain\ValueObject\TaskStatusMother;

it('create a task with all fields', function () {
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::dummy()->value(),
    ];

    $response = $this->post('/api/v1/tasks', $params);

    $response->assertStatus(Response::HTTP_CREATED);
});

it('create a task without content', function () {
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
        'status' => TaskStatusMother::dummy()->value(),
        'content' => TaskContentMother::empty()->value(),
    ];

    $response = $this->task('/api/v1/tasks', $params);

    $response->assertStatus(Response::HTTP_CREATED);
});

it('create a task without slug', function () {
    $params = [
        'title' => TaskTitleMother::dummy()->value(),
        'slug' => null,
        'content' => TaskContentMother::dummy()->value(),
    ];

    $response = $this->task('/api/v1/tasks', $params);

    $actual = json_decode($response->getContent())->data;

    expect($actual->title)->toEqual($params['title']);
    expect($actual->slug)->not->toEqual($params['slug']);
    expect($actual->content)->toEqual($params['content']);
});