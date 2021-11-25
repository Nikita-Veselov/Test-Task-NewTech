<?php

namespace App\Http\Controllers;

use App\Models\Blacklist;
use App\Http\Requests\StoreBlacklistRequest;
use App\Models\Advertiser;
use App\Models\Publisher;
use App\Models\Site;
use Illuminate\Http\Request;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = Advertiser::all();
        $blacklists = Blacklist::all();
        $randomSiteOrPublisher = collect([Publisher::all(), Site::all()])->random()->random();

        $allBlacklists = Blacklist::where('site_id', $randomSiteOrPublisher->site_id)
                                    ->orWhere('publisher_id', $randomSiteOrPublisher->publisher_id)
                                    ->get();
        $allAdvertisers = collect();

        foreach ($allBlacklists as $black) {
            $allAdvertisers->add(
                Advertiser::where('adv_id', $black->adv_id)
                            ->first()
            );
        }

        return view('main', [
                'advertisers' => $advertisers,
                'blacklists' => $blacklists,
                'rand' => $randomSiteOrPublisher,
                'allAdvertisers' => $allAdvertisers->unique(),
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBlacklistRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlacklistRequest $request)
    {
        $matches = $this->stringMatch($request);

        foreach ($matches[0] as $match) {
            $inserts = $this->stringTrim($match);

            if (Publisher::all()->where('publisher_id', $inserts[0])->isEmpty()) {
                return back()->withErrors("Не найден паб с id - $inserts[0]");
            }

            if (Site::all()->where('site_id', $inserts[1])->isEmpty()) {
                return back()->withErrors("Не найден сайт с id - $inserts[1]");
            }
        }

        foreach ($matches[0] as $match) {
            $inserts = $this->stringTrim($match);

            Blacklist::create([
                'publisher_id' => $inserts[0],
                'site_id' => $inserts[1],
                'adv_id' => $request->adv_id,
            ]);
        }

        return redirect()->route('main')->with('message', 'Добавлено!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blacklist  $blacklist
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $advBlacklists = [];
        $blacklistCollection = Blacklist::where('adv_id', $request->advertiser_id)->get();

        foreach ($blacklistCollection as $blacklist) {
            array_push($advBlacklists, 'p' . $blacklist->publisher_id, 's' . $blacklist->site_id );
        }

        $advBlacklists = implode(', ', $advBlacklists);

        return redirect()->route('main')->with('blacklists', "$advBlacklists");
    }

    public function stringMatch($request) {
        $pattern = '/p[0-9]+,\ss[0-9]+/';
        preg_match_all($pattern, $request->blacklist, $matches);

        return $matches;
    }

    public function stringTrim($match) {
        $needle = ['p', 's'];
        $match = str_replace($needle, '', $match);

        return explode(', ', $match);
    }

}
