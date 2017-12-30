<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Socialite;
use App\Social\FacebookUser;
use App\Jobs\UpdateProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Two\User as SocialiteUser;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FacebookController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     */
    public function handleProviderCallback()
    {
        $socialiteUser = Socialite::driver('facebook')->user();

        try {
            $user = User::findByFacebookId($socialiteUser->getId());

            return $this->userFound($user, $socialiteUser);
        } catch (ModelNotFoundException $exception) {
            return $this->userNotFound(new FacebookUser($socialiteUser->user));
        }
    }

    private function userFound(User $user, SocialiteUser $socialiteUser): RedirectResponse
    {
        $this->dispatchNow(new UpdateProfile($user, ['facebook_username' => $socialiteUser->nickname]));

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    private function userNotFound(GithubUser $user): RedirectResponse
    {
        if ($user->isTooYoung()) {
            $this->error('errors.facebook_account_too_young');

            return redirect()->home();
        }

        return $this->redirectUserToRegistrationPage($user);
    }

    private function redirectUserToRegistrationPage(FacebookUser $user): RedirectResponse
    {
        session(['facebookData' => $user->toArray()]);

        return redirect()->route('register');
    }
}
