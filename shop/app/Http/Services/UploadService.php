<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Log;

class UploadService
{
    public function store($request, $fieldName, string $folder = "products")
    {
        try {
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);

                if ($file->isValid()) {
                    $name = time() . '_' . $file->getClientOriginalName();
                    $pathFull = "uploads/$folder";

                    $file->move(public_path($pathFull), $name);

                    return [
                        'error' => false,
                        'url' => "/$pathFull/$name"
                    ];
                }
            }

            return [
                'error' => true,
                'url' => ''
            ];
        } catch (\Exception $error) {
            Log::error('Upload error: ' . $error->getMessage());
            return [
                'error' => true,
                'url' => ''
            ];
        }
    }

    // Hàm upload nhiều file
    public function storeMultiple($request, $fieldName, string $folder = "products")
    {
        $urls = [];
        try {
            if ($request->hasFile($fieldName)) {
                foreach ($request->file($fieldName) as $file) {
                    if ($file->isValid()) {
                        $name = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
                        $pathFull = "uploads/$folder";
                        $file->move(public_path($pathFull), $name);

                        $urls[] = "/$pathFull/$name";
                    }
                }
            }

            return [
                'error' => false,
                'urls' => $urls
            ];
        } catch (\Exception $error) {
            Log::error('Upload multiple error: ' . $error->getMessage());
            return [
                'error' => true,
                'urls' => []
            ];
        }
    }
}
