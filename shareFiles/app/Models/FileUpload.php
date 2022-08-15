<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FileUpload
{

    /**
     * Gets all picture with the current person.
     *
     * @return array list of picture with the current person
     */
    public static function getFiles()
    {
        return DB::select("SELECT id, mat_sender, name, name_file FROM files WHERE mat_sender = ?",
            [Auth::user()->matricule]);
    }

    /**
     * Get files of the given user.
     *
     * @param User $user given user.
     * @return array files.
     */
    public static function getFilesUser($user)
    {
        return DB::select("SELECT id, mat_sender, name, name_file FROM files WHERE mat_sender = ?",
            [Message::getContact($user)->matricule]);
    }

    /**
     * Get file by file name.
     *
     * @param string $name_file file name.
     * @return mixed
     */
    public static function getFileByName($name_file)
    {
        return DB::table('files')
            ->where('name', $name_file)
            ->get(['mat_sender', 'name_file'])->first();
    }

    /**
     * Delete file by file name.
     *
     * @param string $name_file file name.
     */
    public static function deleteFile($name_file)
    {
        DB::delete("DELETE FROM files WHERE name = ?", [$name_file]);
    }

    /**
     * Store file.
     *
     * @param $mat_sender number of the sender.
     * @param $link file link.
     * @param $name_file file name.
     * @return bool
     */
    public static function insertFile($mat_sender, $link, $name_file)
    {
        return DB::insert("INSERT INTO files (mat_sender, name, name_file) VALUES (?, ?, ?)",
            [$mat_sender, $link, $name_file]);
    }
}
