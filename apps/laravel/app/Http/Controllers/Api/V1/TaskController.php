<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\ApiController;
use App\OpenApi\Parameters\CreateTasksParameters;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Task\Infrastructure\Controller\AttachUserToTaskController;
use Modules\Task\Infrastructure\Controller\CreateTaskController;
use Modules\Task\Infrastructure\Controller\DeleteTaskController;
use Modules\Task\Infrastructure\Controller\FindAllTasksController;
use Modules\Task\Infrastructure\Controller\FindTaskByIdController;
use Modules\Task\Infrastructure\Controller\UpdateStatusController;
use Modules\Task\Infrastructure\Controller\UpdateTaskController;
use Vyuldashev\LaravelOpenApi\Attributes as OpenApi;

#[OpenApi\PathItem]

class TaskController extends ApiController
{
    public function __construct(
        private readonly CreateTaskController $createTaskController,
        private readonly UpdateTaskController $updateTaskController,
        private readonly DeleteTaskController $deleteTaskController,
        private readonly FindAllTasksController $findAllTasksController,
        private readonly FindTaskByIdController $findTaskByIdController,
        private readonly AttachUserToTaskController $attachUserToTask,
        private readonly UpdateStatusController $updateStatusController,
    ) {
        $this->middleware('auth:api', ['except' => []]);
    }


    public function store(Request $request)
    {
        try {
            $this->createTaskController->__invoke($request);

            return response()->json('Entity Created', Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $this->updateTaskController->__invoke($request, $id);

            return response()->json('Entity Updated', Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_NOT_MODIFIED);
        }
    }

    public function destroy(int $id)
    {
        try {
            $this->deleteTaskController->__invoke($id);

            return response()->json('Entity Deleted', Response::HTTP_NO_CONTENT);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function index()
    {
        try {
            $response = $this->findAllTasksController->__invoke();

            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $response = $this->findTaskByIdController->__invoke($id);

            return response()->json($response, Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function attach(int $id, int $userId)
    {
        try {
            $this->attachUserToTask->__invoke($id, $userId);

            return response()->json("User Attached", Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_NOT_MODIFIED);
        }
    }

    public function updateStatus(int $id, string $status): JsonResponse
    {
        try {
            $this->updateStatusController->__invoke($id, $status);

            return response()->json("Status Updated", Response::HTTP_OK);
        } catch (Exception $e) {

            return response()->json($e->getMessage(), Response::HTTP_NOT_MODIFIED);
        }
    }
}
