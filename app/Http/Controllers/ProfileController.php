<?php

namespace App\Http\Controllers;

use App\Enums\AnnouncementsEnum;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\Announcement;
use App\Models\Favorite;
use App\Models\User;
use App\Models\UserPhoneNumber;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * @return Factory|View
     */
    public function view()
    {
        return view('website.profile.view');
    }

    /**
     * @return Factory|View
     */
    public function edit()
    {
        return view('website.profile.edit');
    }

    /**
     * @param UpdateUserProfileRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserProfileRequest $request)
    {
        try {
            DB::beginTransaction();
            $fileName = null;
            if (auth()->check() && $user = User::find(auth()->id())){
                $user->update([
                    'full_name' => $request->full_name,
                    'email' => $request->email
                ]);
                $profile_data = [
                    'address' => $request->address,
                    'viber' => $request->viber,
                    'whatsapp' => $request->whatsapp,
                    'telegram' => $request->telegram,
                ];
                if (($request->hasFile('avatar_image')) || (!$request->hasFile('avatar_image') && $request->is_avatar)){
                    $avatar = $user->profile->avatar;
                    if ($avatar && file_exists(public_path("/$avatar"))){
                        $dirPath = substr($avatar, 0, strrpos($avatar, '/'));
                        File::deleteDirectory(public_path("/$dirPath"));
                        $profile_data['avatar'] = null;
                    }
                    if ($request->hasFile('avatar_image')){
                        $file = $request->file('avatar_image');
                        $path = make_directory(['user-profile',$user->id]);
                        $fileName = save_image($file,0,$path);
                        $profile_data['avatar'] = "uploads/user-profile/$user->id/$fileName";
                    }
                }
                $user->profile()->update($profile_data);
                $user->phone()->delete();
                $phones = array(
                    new UserPhoneNumber(array('phone_number' => $request->phone_1)),
                    new UserPhoneNumber(array('phone_number' => $request->phone_2)),
                    new UserPhoneNumber(array('phone_number' => $request->phone_3)),
                );
                $user->phone()->saveMany($phones);
                DB::commit();
                return response()->json(['success' => true], 200);
            }
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error($exception->getMessage());
            return response()->json(['message' => $exception->getMessage()], 417);
        }
    }

    /**
     * @return Factory|View
     */
    public function contactUsPage()
    {
        return view('website.profile.contact-us');
    }

    /**
     * @return Factory|View
     */
    public function walletPage()
    {
        return view('website.profile.wallet');
    }

    /**
     * @return Factory|View
     */
    public function favoritesPage()
    {
        $favorites = Favorite::where('user_id', auth()->id())->get()->pluck('announcement_id');
        $announcements = Announcement::whereIn('id', $favorites)->paginate(9);
        return view('website.profile.favorites', compact('announcements'));
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function addAndRemoveFavorites(Request $request)
    {
        if ($request->ajax() && $request->id) {
            if ($favorite = Favorite::where(['user_id' => auth()->id(), 'announcement_id' => $request->id])->first()) {
                $favorite->delete();
                return response()->json(['message' => __('main.removed'), 'isAdded' => false], 200);
            } else {
                Favorite::create([
                    'user_id' => auth()->id(),
                    'announcement_id' => $request->id,
                ]);
                return response()->json(['message' => __('main.added'), 'isAdded' => true], 200);
            }
        }
        return response()->json(['message' => __('main.failed')], 306);
    }

    /**
     * @param Request $request
     * @return Factory|View|JsonResponse
     */
    public function announcements(Request $request)
    {
        $announcements = Announcement::query()->where(['user_id' => auth()->id()]);
        $statuses = AnnouncementsEnum::STATUSES;


        if ($request->ajax()) {
            $html = __("main.no_result");

            if ($request->has('status') && isset($statuses[$request->get('status')])) {
                $status = $statuses[$request->get('status')];
                $page = $request->get('page') > 1 ? $request->get('page') : 1;

                $announcements = $announcements->where(['status' => $status])
                    ->orderBy('created_at', 'desc')
                    ->paginate(10, '*', 'page', $page);

                $status_name = collect($statuses)->filter(function ($k,$v) use ($status){
                    return $k == $status;
                })->take(1)->keys()->first();

                $html = count($announcements) > 0
                    ? view("website.announcements.partials.items")->with(compact('announcements', 'status'))->render()
                    : __("main.no_announcements.{$request->get('status')}");
            }
            return response()->json(['html' => $html], 200);
        }

        return view('website.profile.announcements.index', compact('announcements', 'statuses'));
    }

}
