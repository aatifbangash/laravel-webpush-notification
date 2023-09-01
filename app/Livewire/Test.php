<?php

namespace App\Livewire;

use Cookie;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Test extends Component
{
    public ?string $name = "testing commonent";
    public ?array $posts;
    public ?array $post;

    public ?string $title;
    public ?string $body;
    public ?string $editPostId;

    public function mount(SessionManager $s)
    {

        if (!$s->exists('data')) $s->put('data', []);
        $this->posts = $s->get('data') ?? null;

//        dd($s->all());

    }


    public function delete($id, SessionManager $s)
    {
        $data = collect($s->get('data'));
        $filteredData = $data->filter(fn($i) => $i['id'] != $id);

        $s->put('data', $filteredData->toArray());
        $s->save();

//        $filteredData->each(fn($i) => $s->push('data', $i));

        $this->posts = $filteredData->toArray();
    }

    public function add(SessionManager $s)
    {
        if (!empty($this->editPostId)) {
//            dd($this->editPostId);
//            $data = collect($s->get('data'));
//            $filteredData = last($data->filter(fn($i) => $i['id'] == $this->editPostId)->toArray());
////            $filteredData
//            dd($data->find('id', ));
//            $filteredData['title'] = $this->title;
//            $filteredData['body'] = $this->body;
//            dd($filteredData);
            $this->reset('title', 'body', 'editPostId');
        } else {
            $s->push('data', ['id' => rand(0, 10000), 'title' => $this->title, 'body' => $this->body]);
            $this->posts = $s->get('data');
            $this->reset('title', 'body', 'editPostId');
        }
    }

    public function edit($id, SessionManager $s)
    {
        $data = collect($s->get('data'));
        $filteredData = last($data->filter(fn($i) => $i['id'] == $id)->toArray());
        $this->title = $filteredData['title'];
        $this->body = $filteredData['body'];
        $this->editPostId = $filteredData['id'];
    }

    public function render()
    {
        return view('livewire.test')->layout('components.layouts.app', ['showFooter' => 'Show']);
    }
}
