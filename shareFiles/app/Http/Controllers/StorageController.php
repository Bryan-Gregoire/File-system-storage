<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContact;
use App\Models\Message;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StorageController extends Controller {

    /**
     * Checks the user is connected to access theses pages.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Shows home without messages and with any choose of discussion.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index() {
        $contacts = Message::getContacts();
        $invitations = Message::getInvitations();
        $files = FileUpload::getFiles();
        return view('home', compact('contacts', 'invitations', 'files'));
    }

    /**
     * Shows semeone's files.
     *
     * @param Request $request the given request with all informations
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request) {
        if (!isset($request->id_other_contact) || !Message::isContact($request->id_other_contact)) {
            abort(404);
        }

        $invitations = Message::getInvitations();
        $currentContact = Message::getContact($request->id_other_contact);
        $currentMatriculeHash = sha1($currentContact->matricule);
        $contacts = Message::getContacts();
        $storageId = $request->id_other_contact;
        return view('storage', compact('storageId', 'contacts', 'currentContact', 'invitations', 'currentMatriculeHash'));
    }

    /**
     * Deletes contact between two persons
     */
    public function contactRemove(Request $request) {
        if (!isset($request->id_other_contact) || !Message::isContact($request->id_other_contact)) {
            abort(404);
        }
        Message::contactRemove($request->id_other_contact);
        return redirect("/home")->with('status', 'Contact correctement supprimé !');
    }

    /**
     * Accepts or refuses the new ask of contact.
     *
     * @param AddContact $request the given request with all informations
     * @return \Illuminate\Http\RedirectResponse
     */
    public function contactStore(AddContact $request) {
        if (!isset($request->matricule)) {
            abort(404);
        }

        if (!Message::getContact($request->matricule, true)) {
            return redirect()->back()->with('error', 'Cette personne n\'existe pas...');
        }

        if (Message::isContact($request->matricule, true)) {
            return redirect()->back()->with('error', 'Vous êtes déjà en contact avec cette personne.');
        }

        if (Message::isAlreayAsked($request->matricule)) {
            return redirect()->back()->with('error', 'Vous avez déjà demandé à vous abonner à cette personne.');
        }

        if ($request->matricule == Auth::user()->matricule) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous envoyer d\'invitation');
        }

        Message::askContact(Auth::user()->matricule, $request->matricule);
        return redirect()->back()->with('status', 'Demande correctement envoyée !');
    }

    /**
     * Sends the new invitation to make contact with someone.
     *
     * @param Request $request the given request with all informations
     * @return \Illuminate\Http\RedirectResponse
     */
    public function invitStore(Request $request) {
        if (!isset($request->id_sender) || Message::isContact($request->id_sender)) {
            abort(404);
        }

        if (!Message::getContact($request->id_sender)) {
            return redirect()->back()->with('error', 'Cette personne n\'existe pas...');
        }

        if ($request->submit == "accept") {
            Message::acceptInvit($request->id_sender);
            return redirect()->back()->with('status', 'Invitation correctement acceptée !');
        } else {
            Message::refuseInvit($request->id_sender);
            return redirect()->back()->with('status', 'Invitation correctement supprimée !');
        }
    }

    /**
     * Gets all files in json response
     *
     * @param Request $request the given request with all informations
     * @return \Illuminate\Http\JsonResponse
     */
    public function filesJson(Request $request) {
        if (!isset($request->id_other_contact) || !Message::isContact($request->id_other_contact)) {
            abort(404);
        }
        $files = FileUpload::getFilesUser($request->id_other_contact);
        return response()->json($files);
    }
}
