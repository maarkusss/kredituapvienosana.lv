<?php

namespace App\Http\Middleware;

use App\Models\Admincp\Settings;
use Closure;
use Illuminate\Support\Facades\App;

class Locales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (in_array($request->segment(1), $this->locales())) {
            App::setLocale($request->segment(1));
        } elseif (!$this->locales()) {
            return redirect(route('setup.index'));
        } else {
            App::setLocale($this->locales()[0]);
            $link = '';
            $i = 0;
            foreach ($request->segments() as $segment) {
                $i++;
                if ($i > 1) {
                    $link .= '/' . $segment;
                }
            }

            return redirect('/' . $this->locales()[0] . '' . $link);
        }

        return $next($request);
    }

    public function locales()
    {
        $locales = [];

        foreach (Settings::where('name', 'lang')->get() as $lang) {
            $locales[] = $lang->value;
        }

        return $locales;
    }
}
