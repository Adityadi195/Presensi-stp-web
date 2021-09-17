<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Upload Foto for Profile
 * And Attendance
 */
trait FotoStorage
{
    /**
     * For Upload foto
     * @param mixed $foto
     * @param mixed $name
     * @param mixed $path
     * @param bool $update
     * @param mixed|null $old_foto
     * @return void
     */
    public function uploadFoto($foto, $nama, $path, $update = false, $old_foto = null)
    {
        if ($update) {
            Storage::delete("/public/{$path}/" . $old_foto);
        }

        $nama = Str::slug($nama) . '-' . time();
        $extension = $foto->getClientOriginalExtension();
        $newName = $nama . '.' . $extension;
        Storage::putFileAs("/public/{$path}", $foto, $newName);
        return $newName;
    }

    /**
     *
     * @param mixed $old_foto
     * @param mixed $path
     * @return void
     */
    public function deleteFoto($old_foto, $path)
    {
        Storage::delete("/public/{$path}" . $old_foto);
    }
}