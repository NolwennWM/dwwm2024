<?php 
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class Uploader
{
    public function __construct(private SluggerInterface $slugger)
    {}

    public function uploadFile(UploadedFile $file, string $folder):string|null
    {
        $original = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safe = $this->slugger->slug($original);
        $new = $safe."-".uniqid().".".$file->guessExtension();
        try
        {
            $file->move($folder, $new);
        }catch(FileException $e)
        {
            return null;
        }
        return $new;
    }
}

?>