<?php

namespace Modules\Shared\Infrastructure;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Returns abort response.
     */
    protected function abort(int $code, string $message = '', $headers = [])
    {
        abort($code, $message, $headers);
    }

    /**
     * Generates a URL from the given parameters.
     */
    protected function generateUrl(string $route, array $parameters = [], bool $absolute = true): string
    {
        return route($route, $parameters, $absolute);
    }

    /**
     * Returns a RedirectResponse to the given URL.
     */
    protected function redirect(string $to, int $status = 302, array $headers = [])
    {
        return redirect($to, $status, $headers);
    }

    /**
     * Returns a RedirectResponse to the given route.
     */
    protected function redirectToRoute(string $route, array $parameters = [], int $status = 302, array $headers = [])
    {
        return redirect()->route($route, $parameters, $status, $headers);
    }

    /**
     * Create a new redirect response to the previously intended location.
     */
    protected function redirectIntended(string $default = '', $status = 302, $headers = [])
    {
        return redirect()->intended($default, $status, $headers);
    }

    /**
     * Create a new redirect response to the previous location.
     */
    protected function redirectBack(int $status = 302, array $headers = [], $fallback = false)
    {
        return back($status, $headers, $fallback);
    }

    /**
     * Create a new "no content" response.
     */
    protected function noContent(int $status = 204, array $headers = [])
    {
        return response()->noContent($status, $headers);
    }

    /**
     * Returns a JsonResponse.
     */
    protected function json(array $data, int $status = 200, array $headers = [], $options = 0)
    {
        return new JsonResponse($data, $status, $headers, $options);
    }

    /**
     * Return the raw contents of a binary file.
     */
    protected function file(string $file, array $headers = [])
    {
        return response()->file($file, $headers);
    }

    /**
     * Returns a download response from file path.
     */
    protected function download(string $file, string $name = null, array $headers = [], $disposition = 'attachment')
    {
        return response()->download($file, $name, $headers, $disposition);
    }

    /**
     * Returns a stream download response from callback.
     */
    protected function streamedDownload($callback, string $name = null, array $headers = [], $disposition = 'attachment')
    {
        return response()->streamDownload($callback, $name, $headers, $disposition);
    }

    /**
     * Returns session instance or session value.
     *
     * @param  array|string|null  $key
     * @param  mixed|null  $default
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed
     */
    protected function session($key = null, $default = null)
    {
        return session($key, $default);
    }

    /**
     * Adds a flash message to the current session for type.
     */
    protected function addFlash(string $key, $message)
    {
        return $this->session()->flash($key, $message);
    }

    /**
     * Add success flash message.
     */
    protected function addSuccessFlash($message)
    {
        return $this->session()->flash(FlashMessageTypeEnum::SUCCESS_MSG, $message);
    }

    /**
     * Add warning flash message.
     */
    protected function addWarningFlash($message)
    {
        return $this->session()->flash(FlashMessageTypeEnum::WARNING_MSG, $message);
    }

    /**
     * Add error flash message.
     */
    protected function addErrorFlash($message)
    {
        return $this->session()->flash(FlashMessageTypeEnum::ERROR_MSG, $message);
    }

    /**
     * Add info flash message.
     */
    protected function addInfoFlash($message)
    {
        return $this->session()->flash(FlashMessageTypeEnum::INFO_MSG, $message);
    }

    /**
     * Add default flash message.
     */
    protected function addDefaultFlash($message)
    {
        return $this->session()->flash(FlashMessageTypeEnum::DEFAULT_MSG, $message);
    }

    /**
     * Renders a view.
     */
    protected function render(string $view, array $data = [], array $mergeData = [])
    {
        return view($view, $data, $mergeData);
    }

    /**
     * Get auth instance.
     */
    protected function auth(string $guard = null)
    {
        return auth($guard);
    }

    /**
     * Determine if guest.
     */
    protected function isGuest(string $guard = null): bool
    {
        return $this->auth($guard)->guest();
    }

    /**
     * Determine if authenticated.
     */
    protected function isAuth(string $guard = null): bool
    {
        return $this->auth($guard)->check();
    }

    /**
     * Get authenticated user.
     *
     * @return \App\Models\User|null
     */
    protected function getUser(string $guard = null): ?Authenticatable
    {
        return $this->auth($guard)->user();
    }
}
