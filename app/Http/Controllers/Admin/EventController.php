<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Event::latest()->get();
        return view('admin.pages.event.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.event.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'row_one_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'row_three_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'row_five_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation for other fields as necessary
        ]);


        $uploadedFiles = [];

        // Array of files to upload
        $files = [
            'banner_image'    => $request->file('banner_image'),
            'row_one_image'   => $request->file('row_one_image'),
            'row_three_image' => $request->file('row_three_image'),
            'row_five_image'  => $request->file('row_five_image'),
        ];


        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $filePath = 'events/' . $key;
                $uploadedFiles[$key] = newUpload($file, $filePath);
                if ($uploadedFiles[$key]['status'] === 0) {
                    return redirect()->back()->with('error', $uploadedFiles[$key]['error_message']);
                }
            } else {
                $uploadedFiles[$key] = ['status' => 0];
            }
        }


        // Create the event in the database
        Event::create([
            'event_name'            => $request->event_name,
            'start_date'            => $request->start_date,
            'start_time'            => $request->start_time,
            'end_date'              => $request->end_date,
            'end_time'              => $request->end_time,
            'event_short_descp'     => $request->event_short_descp,
            'max_attendees'         => $request->max_attendees,
            'current_attendees'     => $request->current_attendees,
            'banner_badge'          => $request->banner_badge,
            'banner_sub_title'      => $request->banner_sub_title,
            'banner_title'          => $request->banner_title,
            'organizer_text'        => $request->organizer_text,
            'map_link'              => $request->map_link,
            'website_link'          => $request->website_link,
            'whatsapp_link'         => $request->whatsapp_link,
            'other_link'            => $request->other_link,
            'row_one_title'         => $request->row_one_title,
            'row_one_description'   => $request->row_one_description,

            'row_one_button_name'   => $request->row_one_button_name,
            'row_one_button_link'   => $request->row_one_button_link,

            'row_two_title'         => $request->row_two_title,
            'row_two_description'   => $request->row_two_description,
            'row_three_badge'       => $request->row_three_badge,
            'row_three_title'       => $request->row_three_title,
            'row_three_description' => $request->row_three_description,
            'row_three_button_name' => $request->row_three_button_name,
            'row_three_button_link' => $request->row_three_button_link,

            'row_four_badge'        => $request->row_four_badge,
            'row_four_title'        => $request->row_four_title,
            'row_four_description'  => $request->row_four_description,
            'row_four_button_name'  => $request->row_four_button_name,
            'row_four_button_link'  => $request->row_four_button_link,
            'row_five_title'        => $request->row_five_title,
            'row_five_description'  => $request->row_five_description,
            'row_five_button_name'  => $request->row_five_button_name,
            'row_five_button_link'  => $request->row_five_button_link,

            'status'                => $request->status,
            'event_type'            => $request->event_type,
            'payment_type'          => $request->payment_type,
            'ticket_price'          => $request->ticket_price,
            'currency'              => $request->currency,
            'location'              => $request->location,
            'contact'               => $request->contact,

            'event_status'               => $request->event_status,

            'added_by'              => Auth::guard('admin')->user()->id,
            'updated_by'            => Auth::guard('admin')->user()->id,
            'created_at'            => now(),

            'banner_image'          => $uploadedFiles['banner_image']['status'] == 1 ? $uploadedFiles['banner_image']['file_path'] : null,
            'row_one_image'         => $uploadedFiles['row_one_image']['status'] == 1 ? $uploadedFiles['row_one_image']['file_path'] : null,
            'row_three_image'       => $uploadedFiles['row_three_image']['status'] == 1 ? $uploadedFiles['row_three_image']['file_path'] : null,
            'row_five_image'        => $uploadedFiles['row_five_image']['status'] == 1 ? $uploadedFiles['row_five_image']['file_path'] : null,
        ]);

        return redirect()->route('admin.event.index')->with('success', 'Data Inserted Successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Event::find($id);

        return view('admin.pages.event.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Event::findOrFail($id);

        // Define upload paths
        $uploadedFiles = [];

        // Array of files to upload
        $files = [
            'banner_image'    => $request->file('banner_image'),
            'row_one_image'   => $request->file('row_one_image'),
            'row_three_image' => $request->file('row_three_image'),
            'row_five_image'  => $request->file('row_five_image'),
        ];

        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $filePath = 'events/' . $key;
                $oldFile = $item->$key ?? null;

                if ($oldFile) {
                    Storage::delete("public/" . $oldFile);
                }
                $uploadedFiles[$key] = newUpload($file, $filePath);
                if ($uploadedFiles[$key]['status'] === 0) {
                    return redirect()->back()->with('error', $uploadedFiles[$key]['error_message']);
                }
            } else {
                $uploadedFiles[$key] = ['status' => 0];
            }
        }

        // Update the item with new values
        $item->update([

            'event_name'            => $request->event_name,
            'start_date'            => $request->start_date,
            'start_time'            => $request->start_time,
            'end_date'              => $request->end_date,
            'end_time'              => $request->end_time,

            'event_short_descp'     => $request->event_short_descp,

            'max_attendees'         => $request->max_attendees,
            'current_attendees'     => $request->current_attendees,

            'banner_badge'          => $request->banner_badge,
            'banner_sub_title'      => $request->banner_sub_title,
            'banner_title'          => $request->banner_title,
            'organizer_text'        => $request->organizer_text,

            'map_link'              => $request->map_link,
            'website_link'          => $request->website_link,
            'whatsapp_link'         => $request->whatsapp_link,
            'other_link'            => $request->other_link,
            'event_status'            => $request->event_status,

            'row_one_title'         => $request->row_one_title,
            'row_one_description'   => $request->row_one_description,
            'row_one_title'         => $request->row_one_title,
            'row_one_description'   => $request->row_one_description,
            'row_one_button_name'   => $request->row_one_button_name,
            'row_one_button_link'   => $request->row_one_button_link,

            'row_two_title'         => $request->row_two_title,
            'row_two_description'   => $request->row_two_description,

            'row_three_badge'       => $request->row_three_badge,
            'row_three_title'       => $request->row_three_title,
            'row_three_description' => $request->row_three_description,
            'row_three_button_name' => $request->row_three_button_name,
            'row_three_button_link' => $request->row_three_button_link,

            'status'                => $request->status,
            'event_type'            => $request->event_type,
            'row_four_badge'        => $request->row_four_badge,
            'row_four_title'        => $request->row_four_title,
            'row_four_description'  => $request->row_four_description,
            'row_four_button_name'  => $request->row_four_button_name,
            'row_four_button_link'  => $request->row_four_button_link,
            'row_five_title'        => $request->row_five_title,
            'row_five_description'  => $request->row_five_description,
            'row_five_button_name'  => $request->row_five_button_name,
            'row_five_button_link'  => $request->row_five_button_link,

            'status'                => $request->status,
            'event_type'            => $request->event_type,

            'payment_type'          => $request->payment_type,
            'ticket_price'          => $request->ticket_price,
            'currency'              => $request->currency,

            'location'              => $request->location,
            'contact'               => $request->contact,

            'added_by'              => Auth::guard('admin')->user()->id,
            'updated_by'            => Auth::guard('admin')->user()->id,
            'banner_image'          => $uploadedFiles['banner_image']['status'] == 1 ? $uploadedFiles['banner_image']['file_path'] : $item->banner_image,
            'row_one_image'         => $uploadedFiles['row_one_image']['status'] == 1 ? $uploadedFiles['row_one_image']['file_path'] : $item->row_one_image,
            'row_three_image'       => $uploadedFiles['row_three_image']['status'] == 1 ? $uploadedFiles['row_three_image']['file_path'] : $item->row_three_image,
            'row_five_image'        => $uploadedFiles['row_five_image']['status'] == 1 ? $uploadedFiles['row_five_image']['file_path'] : $item->row_five_image,



        ]);

        return redirect()->route('admin.event.index')->with('success', 'Data Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Event::findOrFail($id);

        $files = [
            'banner_image'    => $item->banner_image,
            'row_one_image'   => $item->row_one_image,
            'row_three_image' => $item->row_three_image,
            'row_five_image'  => $item->row_five_image,
        ];
        foreach ($files as $key => $file) {
            if (!empty($file)) {
                $oldFile = $item->$key ?? null;
                if ($oldFile) {
                    Storage::delete("public/" . $oldFile);
                }
            }
        }
        $item->delete();
    }
}
