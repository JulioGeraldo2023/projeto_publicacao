<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publication;
use App\Models\User;

class PublicationController extends Controller
{
    public function index() {

        $search = request('search');

        if($search) {

            $publications = Publication::where([
                ['type', 'like', '%'.$search.'%']
            ])->get();

        }else if($search){ //mudar forma de pesquisa

            $publications = Publication::where([
                ['author', 'like', '%'.$search.'%']
            ])->get();
        
        } else {

            $publications = Publication::all();
            
        }        
    
        return view('welcome',['publications' => $publications, 'search' => $search]);

    }

    public function create(){
        return view('publications.create');
    }

    public function store(Request $request) {

        $publication = new Publication;

        $publication->type = $request->type;
        $publication->date = $request->date;
        $publication->author = $request->author;
        $publication->reference = $request->reference;
        $publication->items = $request->items;

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/publications'), $imageName);

            $publication->image = $imageName;

        }

        $user = auth()->user();
        $publication->user_id = $user->id;

        $publication->save();

        return redirect('/')->with('msg', 'Publicação criado com sucesso!');

    }

    public function show($id) {

        $publication = Publication::findOrFail($id);

        $user = auth()->user();
        $hasUserJoined = false;

        if($user) {

            $userPublications = $user->publicationsAsParticipant->toArray();

            foreach($userPublications as $userPublication) {
                if($userPublication['id'] == $id) {
                    $hasUserJoined = true;
                }
            }

        }

        $publicationOwner = User::where('id', $publication->user_id)->first()->toArray();

        return view('publications.show', ['publication' => $publication, 'publicationOwner' => $publicationOwner, 'hasUserJoined' => $hasUserJoined]);
        
    }

    public function dashboard() {

        $user = auth()->user();

        $publications = $user->publications;

        $publicationsAsParticipant = $user->publicationsAsParticipant;

        return view('publications.dashboard', 
            ['publications' => $publications, 'publicationsasparticipant' => $publicationsAsParticipant]
        );
    }

    public function destroy($id) {

        Publication::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'publicação excluído com sucesso!');

    }

    public function edit($id) {

        $publication = Publication::findOrFail($id);

        return view('publications.edit', ['publication' => $publication]);

    }

    public function update(Request $request) {

        $data = $request->all();

        // Image Upload
        if($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/publications'), $imageName);

            $data['image'] = $imageName;

        }

        Publication::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Publicação editada com sucesso!');

    }

    public function joinPublication($id) {

        $user = auth()->user();

        $user->publicationsAsParticipant()->attach($id);

        $publication = Publication::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no publicação ' . $publication->type);

    }

    public function leavePublication($id) {

        $user = auth()->user();

        $user->publicationsAsParticipant()->detach($id);

        $publication = Publication::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Você saiu com sucesso da publicação: ' . $publication->type);

    }
}
