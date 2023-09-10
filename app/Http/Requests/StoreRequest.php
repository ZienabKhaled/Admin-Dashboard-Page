<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|string',
            'colors' => 'required|string',
            'offer_value' => 'nullable|string',
            'has_offer' => 'string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}




/*
  "_token" => "6HVPUUwcWOQfmOvnH0c7YvKyu6vAIPKacvN2MKJL"
  "name" => "aefaef"
  "description" => "aefaef"
  "price" => "22"
  "colors" => "#3d2727,#e34d4d"
  "color" => null
  "offer_value" => "22"
  "has_offer" => "on" or "not provided"
  "image" => Illuminate\Http\UploadedFile {#345 ▼
    -test: false
    -originalName: "WhatsApp Image 2023-02-05 at 16.59.44.jpeg"
    -mimeType: "image/jpeg"
    -error: 0
    #hashName: null
    path: "C:\xampp\tmp"
    filename: "php3612.tmp"
    basename: "php3612.tmp"
    pathname: "C:\xampp\tmp\php3612.tmp"
    extension: "tmp"
    realPath: "C:\xampp\tmp\php3612.tmp"
    aTime: 2023-09-09 01:10:32
    mTime: 2023-09-09 01:10:32
    cTime: 2023-09-09 01:10:32
    inode: 9288674231904882
    size: 128644
    perms: 0100666
    owner: 0
    group: 0
    type: "file"
    writable: true
    readable: true
    executable: false
    file: true
    dir: false
    link: false
    linkTarget: "C:\xampp\tmp\php3612.tmp"
  }
]

*/
