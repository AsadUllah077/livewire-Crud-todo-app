<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\TodoList as ModelsTodoList;
use Livewire\Component;
use Livewire\WithFileUploads;

class TodoList extends Component
{
    use WithFileUploads;
    public $todo_items;
    public $item = '';
    public $image = '';
    public $editId ='';
    public $existingImg;



    public function addItem()
    {
        // dd($this->image);

        $path = $this->image->store('images','public');
        // dd($path);
        $fileName = basename($path);
        // dd($fileName);
        Item::create([
            'title'=> $this->item,
            'image' =>$fileName,
        ]);

        // Reset the item field
        $this->item = '';
        $this->image = '';
        session()->flash('message', 'Item added successfully!');
        // return $this->redirect('/todo');
    }

    public function updateTodo()
    {

        if ($this->image) {
            $path = $this->image->store('images', 'public');
            $fileName = basename($path);
        } else {
            $fileName = Item::findOrFail($this->editId)->image; // Retain old image if no new one is uploaded
        }
        Item::findOrFail($this->editId)->update([
            'title'=> $this->item,
            'image' => $fileName,
        ]);

        // Reset the item field
        $this->item = '';
        $this->image = '';
        $this->editId = '';
        session()->flash('message', 'Item update successfully!');
        // return $this->redirect('/todo');
    }

    public function editTodo($id){
        // dd("ffsfsf");
        $this->editId = $id;
        $item =Item::findOrFail($id);
        $this->item =$item->title;
        $this->existingImg = $item->image;
    }

    public function deleteTodo($id){
        Item::findOrFail($id)->delete();
        session()->flash('message', 'Item deleted successfully!');
        // return $this->redirect('/todo');
    }

    // public function mount()
    // {
    //     $this->todo_items = Item::all();
    // }
    public function render()
    {
        $this->todo_items = Item::all();
        return view('livewire.todo-list');
    }
}
