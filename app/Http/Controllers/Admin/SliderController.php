<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Slider;
use App\SliderMedia;
use App\ParameterValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Filesystem\Filesystem;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $active = $request->get('active');

        $pv = new ParameterValue();

        $sliders = Slider::active($active)
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('sliders.index')->with(['pv' => $pv, 'sliders' => $sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $slider_types = ParameterValue::where('parameter_id', 3)->get();
        //
        return view('sliders.create')->with('slider_types', $slider_types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd(config('filesystems'));

        $slider = Slider::create($request->all());
        
        foreach ($request->input('document', []) as $file) {
            $fileMedia = new SliderMedia();
            $fileMedia->fk_slider_id = $slider->id;
            $fileMedia->filename=$file;
            $fileMedia->path = '/storage/uploads/gallery/sliders/' . $file;
    
            $fileMedia->save();
        }
    
        return redirect()->route('sliders.index');
    }

    public function storeMedia(Request $request)
    {
        $path = storage_path('uploads/gallery/sliders');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
    
        $file = $request->file('file');
    
        $name = uniqid() . '_' . trim($file->getClientOriginalName());
    
        // $file->move($path, $name);
        Storage::putFileAs('uploads/gallery/sliders', $file, $name);
    
        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::find($id);
        $sliderMedia = SliderMedia::withTrashed(false)
            ->where('fk_slider_id', $slider->id)
            ->get();
 
        foreach ($sliderMedia as $media) {
            $media->path = URL::to('/').$media->path;            
        }

        $slider->slider_type = ParameterValue::GetValue($slider->fk_slider_type_id);
    
        $data = [
            'slider' => $slider,
            'media' => $sliderMedia
        ];

        return view('sliders.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
        $slider = Slider::find($slider->id);
        $sliderMedia = SliderMedia::withTrashed(false)
            ->where('fk_slider_id', $slider->id)
            ->get();
     
        
        $data = [
            'slider' => $slider,
            'media' => $sliderMedia
        ];

        return view('sliders.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        //
        $slider->update($request->all());

        $mediaFiles = SliderMedia::where('fk_slider_id', $slider->id)->get();
        if (count($mediaFiles) > 0) {
            foreach ($mediaFiles as $media) {
                if (!in_array($media->filename, $request->input('document', []))) {
                    $media->delete();
                }
            }
        }
    
        $media = SliderMedia::where('fk_slider_id', $slider->id)->pluck('filename')->toArray();
    
        foreach ($request->input('document', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $fileMedia = new SliderMedia();
                $fileMedia->fk_slider_id = $slider->id;
                $fileMedia->filename=$file;
                $fileMedia->path = '/storage/uploads/gallery/sliders/' . $file;
            // $fileMedia->path = storage_path('uploads/gallery/sliders') . $file;
    
                $fileMedia->save();
            }
        }
    
        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $param = Slider::find($id)->delete();

        SliderMedia::where('fk_slider_id', $id)->delete();

        return response()->json(['data' => null], 200);
    }
}
