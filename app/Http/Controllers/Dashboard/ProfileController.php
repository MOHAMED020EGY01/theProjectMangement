<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Intl\Countries;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        
        $user = Auth::user();

        $profile = $user->profile ?? new Profile();

        $country = Countries::getNames(config('app.locale'));

        return view('dashboard.profile.index', [
            'profile' => $profile,
            'country' => $country,
            'user_id' => $user->id
        ]);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Dashboard\ProfileRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request, $id)
    {
        try {
            $user_id = Auth::id();
            if ($id != $user_id) {
                return redirect()->back()->with('error', 'Unauthorized');
            }

            DB::beginTransaction();

            $data = $request->validated();
            $profile = Profile::where('user_id', $id)->first();

            $data['image'] = StorageHelper::
            storeFile($request->file('image'), 
            $profile,
            $request->hasFile('image'),
            'public',
            'image',
            'image');   


            Profile::updateOrCreate(
                ['user_id' => $user_id],
                $data
            );

            DB::commit();

            return redirect()
                ->route('profile.index')
                ->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Profile Update: " . $e->getMessage());

            return redirect()
                ->back()
                ->with('error', 'Profile update failed');
        }
    }


    public function show($id)
    {
        return view('dashboard.profile.show', [
            'profile' => Profile::find($id),
        ]);
    }
}
