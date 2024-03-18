<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ContactsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\{Factory,View};
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    private $contactService;
    
    /**
     * __construct
     *
     * @param  mixed $contactService
     * @return void
     */
    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;

        $this->middleware('permission:read-contacts', ['only' => ['index', 'show']]);
        $this->middleware('permission:delete-contacts', ['only' => ['destroy', 'massdestroy']]);
    }

    /**
     * @param ContactsDataTable $dataTable
     * @return mixed
     */
    public function index(ContactsDataTable $dataTable)
    {
        return $dataTable->render('admin.contacts.index');
    }

    /**
     * @param $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'read']);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        if (!Gate::allows('delete-contacts')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $this->contactService->remove($id);
        
        return response()->json(['success' => __('message.deleted_successfully')]);
    }
    
    /**
     * massdestroy
     *
     * @return void
     */
    public function massdestroy()
    {
        if (!Gate::allows('delete-contacts')) {
            return response()->json(['error' =>  __('message.dont_have_permission')]);
        }

        $contacts = $this->contactService->massRemove(request('id'));

        if ($contacts->delete()) {
            return response()->json(['success' => __('message.deleted_successfully')]);
        } else {
            return response()->json(['error' => __('message.deleted_not_successfully')]);
        }
    }
}
