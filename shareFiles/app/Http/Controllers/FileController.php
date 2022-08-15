<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddContact;
use App\Models\Message;
use Illuminate\Support\Facades\File;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{

    /**
     * Checks the user is connected to access theses pages.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Adds new file on the server.
     *
     * @param Request $request the given request with all informations
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileStore(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,png,jpg,gif,pdf,docx,doc,svg|max:2048',
            'name_file' => 'required|max:255'
        ]);

        // Nom du fichier hashé en SHA1 en prennant en compte le matricule et la date en milliseconde (pour avir des dates uniques)
        $nameFile = sha1(Auth::user()->matricule . "-" . date("U")) . '.' . $request->file->extension();

        // Crée un dossier avec le matricule de l'utilisateur hashé en SHA1 (dans le dossier sharefile qui est lui aussi créé)
        // et on place dedans le nom du fichier hashé (nameFile)
        $request->file->move(public_path('sharefile/' . sha1(Auth::user()->matricule)), $nameFile);

        FileUpload::insertFile(Auth::user()->matricule, $nameFile, $request->name_file);
        return redirect()->back()->with('status', 'Fichier correctement upload');
    }

    /**
     * Delete the given file.
     *
     * @param Request $request contain the file to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function fileDelete(Request $request)
    {
        $request->validate([
            'name_file' => 'required|max:255'
        ]);

        $file = FileUpload::getFileByName($request->name_file);
        if ($file->mat_sender == Auth::user()->matricule) {
            File::delete(public_path('sharefile/' . sha1(Auth::user()->matricule)) . "/" . $request->name_file);
            FileUpload::deleteFile($request->name_file);
            return redirect()->back()->with('status', 'Fichier correctement supprimé');
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue !');
        }
    }

    /**
     * Download the given file.
     *
     * @param Request $request contain de given file.
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function fileDownload(Request $request)
    {
        $request->validate([
            'name_file' => 'required|max:255'
        ]);

        $file = FileUpload::getFileByName($request->name_file);
        if ($file->mat_sender == Auth::user()->matricule || Message::isContact($file->mat_sender, true)) {
            $split = explode(".", $request->name_file);
            return Response::download(
                public_path('sharefile/' . sha1($file->mat_sender)) . "/" . $request->name_file,
                $file->name_file . "." . $split[1]
            );
        } else {
            return redirect()->back()->with('error', 'Une erreur est survenue !');
        }
    }
}
