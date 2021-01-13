$present = date('Y-m-d H:i:s');
    $dates = [
        "2013-02-18 05:14:54",
        "2021-02-12 01:44:03",
        "2021-02-05 16:25:07",
        "2021-01-29 02:00:15",
        "2021-01-02 18:33:45",

    ];
    
    $start_date = Carbon::parse($present);
    $end_date = Carbon::parse($dates[4]);

    function getClosest($search, $arr) {
        $timestamps = collect($arr);
        $search = Carbon::parse($search);
        $future_timestamps = $timestamps->map(function ($dates) use($search) {
            $date = Carbon::parse($dates);
            return $search->diffInMinutes($date, false) > 0 ? $date : null;
        });

        return $future_timestamps->filter()->min();
    }

    $closest_date = getClosest($present, $dates);

    if(!$closest_date) {
        return "No closest date is found";
    }

    return $closest_date;
