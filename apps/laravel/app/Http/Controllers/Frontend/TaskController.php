<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Modules\Task\Domain\Model\Task;

class TaskController extends Controller {

    public function index() {
        $tasks = Task::all();
        return view('tasks', compact('tasks'));
    }
}