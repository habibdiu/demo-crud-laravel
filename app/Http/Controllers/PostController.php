<?php

namespace App\Http\Controllers;

use App\Models\POST;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(){
        return view('create');
    }
    public function ourfilestore(REQUEST $request){

        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,bmb,tiff,pdf',
        ]);

        //Upload Image
        $imageName = null;
        if(isset($request->image)){
            
            $imageName = time().'.'.$request->image->extension();
            $request->image-> move(public_path('images'),$imageName);
        }
        


        //Add new image
        $post = new POST;

        $post->name = $request->name;
        $post->description = $request->description;
        $post->image = $imageName;
        
        $post->save();
        
        return redirect()->route('home')->with('success','Your post has been created');
    }
    public function editData($id){
        $post = Post::findOrFail($id);
        return view('edit',['ourPost' => $post]);
    }

    public function updateData($id, Request $request){
        
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpg,bmb,tiff,pdf',
        ]);

        //Update Data
        $post = Post::findOrFail($id);
        
        $post->name = $request->name;
        $post->description = $request->description;

        //Update Image
        if(isset($request->image)){
            
            $imageName = time().'.'.$request->image->extension();
            $request->image-> move(public_path('images'),$imageName);
            $post->image = $imageName;
        }
        
        
        $post->save();
        
        return redirect()->route('home')->with('success','Your post has been Upated');
    
        

    }

    public function deleteData($id){

        $post = Post::findOrFail($id);
        $post->delete();

        
        flash()
        ->options([
            'timeout' => 2000, // 2 seconds
            'position' => 'top-right',
        ])
        ->addError('Your post has been Deleted.');
        return redirect()->route('home');

    }
}
