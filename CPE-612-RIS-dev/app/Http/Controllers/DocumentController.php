<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DocumentIndexRequest;
use App\Http\Requests\DocumentStoreRequest;
use App\Http\Requests\DocumentUpdateRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \App\Http\Requests\DocumentIndexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(DocumentIndexRequest $request)
    {
        $documents = Document::orderBy('updated_at');

        if ($request->filled('type')) {
            switch ($request->type) {
                case 'research':
                    $documents->where('research', true);
                    break;
                case 'service':
                    $documents->where('service', true);
                    break;
                case 'foreign':
                    $documents->where('foreign', true);
                    break;
            }
        }

        if ($request->filled('search')) {
            $documents->where(function ($query) use ($request) {
                $query->where('description', 'like', '%' . $request->search . '%')
                    ->orWhere('name', 'like', '%' . $request->search . '%');
            });
        }

        $documents = $documents->paginate($request->input('size', 20));

        return view('document.index', compact(
            'documents'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('document.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DocumentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentStoreRequest $request)
    {
        $document = Document::create($request->all());

        $path = $request->attachment->store('files');
        $file = new File([
            'name' => $request->attachment->getClientOriginalName(),
            'path' => $path
        ]);

        $document->attachment()->save($file);

        $document->save();

        return redirect()->route('document.show', $document);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return view('document.show', compact(
            'document'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('document.edit', compact(
            'document'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DocumentStoreRequest  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(DocumentUpdateRequest $request, Document $document)
    {
        $document->fill($request->all());
        if ($request->hasFile('attachment')){
            if ($document->attachment()->exists()) {
                Storage::delete($document->attachment->path);
                $document->attachment()->delete();
            }
            
            $path = $request->attachment->store('files');
            $file = new File([
                'name' => $request->attachment->getClientOriginalName(),
                'path' => $path
            ]);
                
            $document->attachment()->save($file);
        }
        
        $document->save();

        return redirect()->route('document.show', $document);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return back();
    }
}
