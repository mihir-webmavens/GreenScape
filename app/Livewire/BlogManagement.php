<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BlogManagement extends Component
{
    use WithFileUploads;
    public $blog_id, $title, $content, $image;
    public $showModal = false;

    public function addBlog()
    {
        $this->dispatch('refreshComponent');
        $this->resetFields();
        $this->showModal = true;
    }

    public function editBlog($id)
    {
        $this->blog_id = $id;
        $blog = Blog::find($this->blog_id);
        $this->title = $blog->title;
        $this->content = $blog->content;
        $this->image = $blog->image;
        $this->showModal = true;
    }

    public function updateOrCreate()
    {
        $blog = Blog::find($this->blog_id);

        $validate = $this->validate([
            "title" => "required",
            "content" => "required",
        ]);

        $fileName = $this->image;
        if ($this->blog_id) {
            if ($this->image && is_object($this->image)) {
                if ($blog && $blog->image && file_exists(public_path('storage/' . $blog->image))) {
                    Storage::disk('public')->delete($blog->image);
                }
                $imageName = $this->image->store('Blogs', 'public');
            } else {
                $imageName = $blog ? $blog->image : null;
            }
        } else {
            if ($this->image && is_object($this->image)) {
                $imageName = $this->image->store('Blogs', 'public');
            } else {
                $imageName = null;
            }
        }
        // dd($this);

        Blog::updateOrCreate(['id' => (int) $this->blog_id], [
            'title' => $this->title,
            'content' => $this->content,
            'image' => $imageName,
        ]);
        
        if ($this->blog_id) {
            session()->flash('message', 'Blog updated successfully');
        } else {
            session()->flash('message', 'Blog added successfully');
        }
        
        $this->closeModal();
        return $blog;
    }

    public function RemoveBlog($id)
    {
        $blog = Blog::find($id);
        if ($blog) {
            if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->delete();
            session()->flash('message', 'Blog deleted successfully');
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
    
       
    }
    
    public function resetFields()
    {
        $this->blog_id = '';
        $this->title = '';
        $this->content = '';
        $this->image = '';
    }

    public function render()
    {
        $blogs = Blog::all();
        return view('livewire.blog-management', compact('blogs'));
    }
}