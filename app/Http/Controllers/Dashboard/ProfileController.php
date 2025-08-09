<?php

namespace App\Http\Controllers\Dashboard;

use App\Facades\StorageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileRequest;
use App\Models\Profile;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
        DB::beginTransaction();
        try {
            $user_id = Auth::id();
            if ($id != $user_id) {
                return redirect()->back()->with('error', 'Unauthorized');
            }


            $data = $request->validated();
            $data['user_id'] = $user_id;
            $profile = Profile::where('user_id', $id)->first();

            // image uplode
            if ($request->hasFile('image')) {
                $data['image'] = StorageHelper::storeFile($request->file('image'), $profile, $request->hasFile('image'), 'public', 'image', 'image');
            }

            $profile = Profile::updateOrCreate(
                ['user_id' => $id],
                $data
            );

            
            $tags = $this->testTags($request);
            if (empty($tags)) {
                return redirect()->back()->with('error', 'Tags Error');
            }
            $tags_id = [];
            foreach ($tags as $tag) {
                $tag = Tag::firstOrCreate([
                    'slug' => Str::slug($tag),
    
                ], [
                    'name' => $tag,
                ]);
    
                $tags_id[] = $tag->id;
            }
            $profile->tags()->sync($tags_id);

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

    /**
     * Summary of testTags
     * @param \App\Http\Requests\Dashboard\ProfileRequest $request
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function testTags(ProfileRequest $request)
    {
        try {
            $tags = json_decode($request->input('tags', []), true) ?? [];
            $tags = array_map(fn($t) => $t['value'] ?? null, $tags);
            return array_values($tags);
        } catch (\Exception $e) {
            Log::error('Tags Error ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        return view('dashboard.profile.show', [
            'profile' => Profile::find($id),
        ]);
    }
}
