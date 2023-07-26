<?php

namespace Hosam\ProductCrud\Http\Services\Attachment;

use Carbon\Carbon;

class UploadAttachment
{
    protected mixed $location;
    protected mixed $files;
    private mixed $parentLocation;

    public function store($files, $location, $parentLocation = "public")
    {
        $this->files = $files;
        $this->location = $location;
        $this->parentLocation = $parentLocation;

        if (is_array($this->files)) {
            $files = [];
            foreach ($this->files as $file) {
                $files[] = $this->saveFile($file);
            }
            return $files;
        } else {
            return $this->saveFile($this->files);
        }
    }

    private function saveFile($file)
    {
        $size = round($file->getSize() / 1024 / 1024, 2) . ' MB';
        $location = $this->location . "/" . Carbon::now()->format('Y-m-d');
        $originalFileName = str_replace(" ", "-", explode('.', $file->getClientOriginalName())[0]);
        $fileName = $originalFileName . '-' . time() . '-' . rand(1, 9) . '.' . $file->getClientOriginalExtension();
        $parentLocationPath = $this->parentLocation == "public" ? public_path() : storage_path();
        if ($file->move($parentLocationPath . '/' . $location, $fileName)) {
            return [
                'name' => $originalFileName,
                'path' => $location . '/' . $fileName,
                'size' => $size,
                'type' => $file->getClientOriginalExtension(),
            ];
        }
        return null;
    }
}
