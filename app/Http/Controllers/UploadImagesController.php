<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Upload;
use Illuminate\Support\Facades\Validator;
use ImageResize;
use Ouzo\Utilities\Validator\Validate;

class UploadImagesController extends Controller
{
    private $public_path;

    public function __construct()
    {
        $this->public_path = public_path('/');
    }

    public function index(Request $request)
    {
        $photos = Upload::all();

        if ($request->ajax())
            return view('backend.images.index', compact('photos'));
        else
            return view('backend.images.upload', compact('photos'));
    }

    public function store(Request $request)
    {
        $input = $request->all();

        foreach ($input['file'] as $photo) {
            $param['file'] = $photo;
            $rules = [
                'file' => 'mimes:jpg,jpeg,bmp,png,webp|max:8192'
            ];
            $validation = Validator::make($param, $rules);

            if ($validation->fails()) {
                $title = basename($photo->getClientOriginalName());
                $result[] = [
                    'success' => false,
                    'message' => $validation->errors(),
                    'title' => $title
                ];
            } else {
                $uploads = $this->public_path . 'uploads';
                $year = $uploads . '/' . date('Y');
                $month = $year . '/' . date('m');

                if (!is_dir($uploads)) {
                    mkdir($uploads, 0777);
                }

                if (!is_dir($year)) {
                    mkdir($year, 0777);
                }

                if (!is_dir($month)) {
                    mkdir($month, 0777);
                }

                $name = sha1(date('YmdHis') . Str::random(30));
                $save_name = $name . '.' . $photo->getClientOriginalExtension();
                $resize_name = $name . Str::random(2) . '.' . $photo->getClientOriginalExtension();

                ImageResize::make($photo)
                    ->resize(250, null, function ($constraints) {
                        $constraints->aspectRatio();
                    })
                    ->save($month . '/' . $resize_name);

                $photo->move($month, $save_name);

                $upload = new Upload();
                $upload->name = $save_name;
                $upload->resized_name = $resize_name;
                $upload->url = 'uploads/' . date("Y") . '/' . date('m');
                $upload->original_name = basename($photo->getClientOriginalName());
                $upload->save();

                $title = basename($photo->getClientOriginalName());
                $result[] = [
                    'success' => true,
                    'message' => "Image upload Successfully",
                    'title' => $title
                ];
            }
        }
        return response()->json(['data' => $result]);
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $uploaded_image = Upload::where('id', basename($id))->first();

        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }

        $file_path = $this->public_path . $uploaded_image->url . '/' . $uploaded_image->name;
        $resized_file = $this->public_path . $uploaded_image->url . '/' . $uploaded_image->resized_name;


        if (file_exists($file_path)) {
            unlink($file_path);
        }

        if (file_exists($resized_file)) {
            unlink($resized_file);
        }

        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }

        return Response::json(['message' => 'File successfully delete'], 200);
    }
}