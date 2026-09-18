<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the sliders.
     */
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.slider', compact('sliders'));
    }

    /**
     * Store a newly created slider.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('sliders', 'public');
            $data['image'] = $imagePath;
        }

        // Set default status if not provided
        if (!isset($data['status'])) {
            $data['status'] = true;
        }

        Slider::create($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slide created successfully!');
    }

    /**
     * Update the specified slider.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'link' => 'nullable|url',
            'order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $imagePath = $request->file('image')->store('sliders', 'public');
            $data['image'] = $imagePath;
        }

        // Set status
        $data['status'] = $request->has('status') ? true : false;

        $slider->update($data);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slide updated successfully!');
    }

    /**
     * Remove the specified slider.
     */
    public function destroy(Slider $slider)
    {
        // Delete image
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }
        
        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slide deleted successfully!');
    }

    /**
     * Toggle slider status.
     */
    public function toggleStatus(Slider $slider)
    {
        $slider->status = !$slider->status;
        $slider->save();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slide status updated successfully!');
    }
}