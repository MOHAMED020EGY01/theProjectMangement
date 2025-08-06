<?php

namespace App\Http\Controllers\Dashboard;

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

    public function update(ProfileRequest $request, $id)
    {
        try {
            $profile =Profile::where('user_id', $id)->first();

            DB::beginTransaction();
            $user_id = Auth::id();
            if ($id == $user_id) {
                Profile::updateOrCreate(
                    ['user_id' => $user_id],
                    $request->validated(),
                );
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $image_name = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('dashboard/assets/img'), $image_name);
                    $data['image'] = $image_name;
                }
                Profile::updateOrCreate(
                    ['user_id' => $user_id],
                    $data,
                );
                DB::commit();
                return redirect()
                    ->route('profile.index')
                    ->with('success', 'Profile updated successfully');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Profile Update" . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Profile updated failed');
        }
    }

    public function show($id){
        return view('dashboard.profile.show', [
            'profile' => Profile::find($id),
        ]);
    }
}
