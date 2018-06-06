<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Todo;

class TodoController extends Controller
{
    public function getTodo(Request $req) {
        if($req->input('id')) {
            if($todo = Todo::find($req->input('id'))) {
                $res = (object)[];
                $res->status = 'OK';
                $res->todo = $todo;
                return json_encode($res);
            }
            else {
                $res = (object)[];
                $res->status = 'TODO_NOT_FOUND';
                return json_encode($res);
            }
        }
        else {
            $todos = Todo::all();
            $res = (object)[];
            $res->status = 'OK';
            $res->todos = $todos;
            return json_encode($res);
        }
    }

    public function postTodo(Request $req) {
        $todo = new Todo;
        $todo->title = $req->title;
        $todo->save();
        $res = (object)[];
        $res->status = 'OK';
        $res->todo = $todo;
        return json_encode($res);
    }

    public function putTodo(Request $req) {
        if($todo = Todo::find($req->id)) {
            $todo->title = $req->title;
            $todo->save();
            $res = (object)[];
            $res->status = 'OK';
            $res->todo = $todo;
            return json_encode($res);
        }
        else {
            $res = (object)[];
            $res->status = 'TODO_NOT_FOUND';
            return json_encode($res);
        }
    }

    public function deleteTodo(Request $req) {
        if($todo = Todo::find($req->input('id'))) {
            $todo->delete();
            $res = (object)[];
            $res->status = 'OK';
            return json_encode($res);
        }
        else {
            $res = (object)[];
            $res->status = 'TODO_NOT_FOUND';
            return json_encode($res);
        }
    }
}
