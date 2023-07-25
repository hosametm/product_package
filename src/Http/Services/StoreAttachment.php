<?php

namespace Hosam\ProductCrud\Http\Services;

use Carbon\Carbon;

class StoreAttachment
{
    protected mixed $location;
    protected mixed $files;

    public function __construct($files, $location)
    {
        $this->files = $files;
        $this->location = $location;
    }

    public function __invoke(): ?array
    {
        if (is_array($this->files)) {
            $files = [];
            foreach ($this->files as $file) {
                $files[] = $this->store($file);
            }
            return $files;
        } else {
            return $this->store($this->files);
        }
    }

    private function store($file): ?array
    {
        $size = round($file->getSize() / 1024 / 1024, 2) . ' MB';
        $location = $this->location . "/" . Carbon::now()->format('Y-m-d');
        $originalFileName = str_replace(" ", "-", explode('.', $file->getClientOriginalName())[0]);
        $fileName = $originalFileName . '-' . time() . '-' . rand(1, 9) . '.' . $file->getClientOriginalExtension();
        if ($file->move(public_path() . '/' . $location, $fileName)) {
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
