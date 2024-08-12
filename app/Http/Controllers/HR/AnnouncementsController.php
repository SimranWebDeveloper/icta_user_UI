<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcements;
use Carbon\Carbon;


class AnnouncementsController extends Controller
{
    
    public function index()
{
    $now = Carbon::now()->addHours(4);  //son
   
    
    Announcements::where('end_date', '<=' , $now->format('Y-m-d H:i:s'))
                 ->where('status', '!=', 0)
                 ->update(['status' => 0]);
    
    $announcements = Announcements::all();
    return view('hr.announcements.index', compact('announcements'));
}
    
    
    public function create()
    {
        return view('hr.announcements.create');
    }

   
    public function store(Request $request)
    {
        $data = $request->all();
        
        if($request->has('image')) {
            $image = $data['image'];
            $image_name = $image->getClientOriginalname();
            $image->move(public_path('assets/images/announcements'), $image_name);
            $data['image'] = $image_name;

        }
        $announcements = Announcements::create($data);
        return redirect()->route('hr.announcements.index')->with(['success'=>'Elan müvəffəqiyyətlə yaradıldı']);
    }

   
    public function show(string $id) 
    {
        $announcement = Announcements::findOrFail($id);        
        return view('hr.announcements.show', compact('announcement'));

    }
    
    public function edit(string $id) 
    {
        $announcement = Announcements::findOrFail($id);
        return view('hr.announcements.edit',compact('announcement'));
    }

    
    public function update(Request $request, string $id) 
    {
        $announcement = Announcements::findOrFail($id);        
        $data = $request->all();

        if ($request->input('delete_image') == '1') {
            if ($announcement->image && \File::exists(public_path('assets/images/announcements/' . $announcement->image))) {
                \File::delete(public_path('assets/images/announcements/' . $announcement->image));
            }
    
            $data['image'] = null; 
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $image->move(public_path('assets/images/announcements'), $image_name);
    
            if ($announcement->image && \File::exists(public_path('assets/images/announcements/' . $announcement->image))) {
                \File::delete(public_path('assets/images/announcements/' . $announcement->image));
            }
    
            $data['image'] = $image_name;
        } else {
            if ($request->input('delete_image') != '1') {
                $data['image'] = $announcement->image;
            }
        }
    
        $announcement->update($data);
    
        return redirect()->route('hr.announcements.index')->with(['success' => 'Elan müvəffəqiyyətlə yeniləndi']);
    }

    
    public function destroy(string $id) 
    {
        try {
            $announcement = Announcements::findOrFail($id);
            if ($announcement->image && \File::exists(public_path('assets/images/announcements/' . $announcement->image))) {
                \File::delete(public_path('assets/images/announcements/' . $announcement->image));
            }
            $announcement->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Elan müvəffəqiyyətlə silindi',
                'route' => route('hr.announcements.index')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Elan silinərkən bir xəta baş verdi: ' . $e->getMessage()
            ]);
        }
        // return redirect()->route('hr.announcements.index')->with('success', 'Elan müvəffəqiyyətlə silindi').;
    }
}