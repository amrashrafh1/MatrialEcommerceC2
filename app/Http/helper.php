<?php

use App\Product;
use App\Tradmark;
use App\User;
use App\Category;
use App\Attribute;
use App\Attribute_Family;

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('/admin' . $url);
    }
}
if (!function_exists('mega_menu')) {
    function megaMenu($chunk = 4, $mainName = 'Cats', $field = 'title', $url = 'cat/', $urlFiled = 'id', $data)
    {
        $chunkArray = [
            4 => 3,
            3 => 4,
            6 => 2,
            2 => 6,
            12 => 1,
        ];
        if (!$chunkArray[$chunk]) {
            dd('This number of cols not valid');
        }
        $out = '<li class="nav-item dropdown">';
        $out .= '<a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
        $out .= $mainName;
        $out .= '</a>';
        $out .= '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
        foreach ($data->chunk($chunk) as $d) {
            $out .= '<div class="col-lg-' . $chunkArray[$chunk] . '">';
            foreach ($d as $item) {
                $out .= '<a class="dropdown-item" href="' . url($url . $item->{$urlFiled}) . '">' . $item->{$field} . '</a>';
            }
            $out .= '</div>';
        }
        $out .= '</div>';
        $out .= '</li>';
        return $out;
    }
}
if (!function_exists('upload')) {
    function upload($image, $path, $height = 600, $width = 550)
    {
        $filenamewithextension = $image->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $image->getClientOriginalExtension();

        //filename to store
        $filenametostore = $filename . '_' . time() . '.' . $extension;

        \Storage::put('public/' . $path . '/' . $filenametostore, fopen($image, 'r+'));
        \Storage::put('public/' . $path . '/thumbnail/' . $filenametostore, fopen($image, 'r+'));

        //Resize image here
        $thumbnailpath = public_path('storage/' . $path . '/thumbnail/' . $filenametostore);
        $logo = Image::make($thumbnailpath)->resize($height, $width, function ($constraint) {
            $constraint->aspectRatio();
        });
        $logo->save($thumbnailpath);
        $img = 'public/' . $path . '/thumbnail/' . $filenametostore;
        return $img;
    }
}

if (!function_exists('multiple_uploads')) {
    function multiple_uploads($images, $path, $model, $height = 600, $width = 550)
    {
        foreach ($images as $image) {

            $filenamewithextension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . time() . '.' . $extension;

            \Storage::put('public/' . $path . '/' . $filenametostore, fopen($image, 'r+'));
            \Storage::put('public/' . $path . '/thumbnail/' . $filenametostore, fopen($image, 'r+'));

            //Resize image here
            $thumbnailpath = public_path('storage/' . $path . '/thumbnail/' . $filenametostore);
            $logo = Image::make($thumbnailpath)->resize($height, $width, function ($constraint) {
                $constraint->aspectRatio();
            });
            $logo->save($thumbnailpath);
            $img = 'public/' . $path . '/thumbnail/' . $filenametostore;

            $model->files()->create([
                'name'        => $filenametostore,
                'size'        => $logo->filesize(),
                'file'        => $img,
                'path'        => 'public/' . $path . '/',
                'mime_type'   => $extension,
            ]);
        }
    }
}

if (!function_exists('getSymbolByQuantity')) {

    function getSymbolByQuantity($bytes)
    {
        $symbols = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB');
        $exp = floor(log($bytes) / log(1024));

        return sprintf('%.2f ' . $symbols[$exp], ($bytes / pow(1024, floor($exp))));
    }
}

if (!function_exists('product_category')) {
    function product_category($products)
    {
        $count = 0;
        foreach ($products as $product) {
            foreach (\App\Product_Order::where('product_id', $product->id)->orderBy('quantity', 'desc')->get() as $pro) {
                $count += $pro->quantity;
            }

        }
        return $count;

    }
}

if (!function_exists('product_table')) {
    function product_table($product)
    {
        $count = 0;
        foreach (\App\Product_Order::where('product_id', $product->id)->orderBy('quantity', 'desc')->get() as $pro) {
            $count += $pro->quantity;
        }
        return $count;

    }
}
;

if (function_exists('user_agent')) {
    function user_agent($user_agent)
    {
        if (preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent)) {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        } elseif (preg_match('/Firefox/i', $user_agent)) {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        } elseif (preg_match('/Chrome/i', $user_agent)) {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        } elseif (preg_match('/Safari/i', $user_agent)) {
            $bname = 'Apple Safari';
            $ub = "Safari";
        } elseif (preg_match('/Opera/i', $user_agent)) {
            $bname = 'Opera';
            $ub = "Opera";
        } elseif (preg_match('/Netscape/i', $user_agent)) {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        echo $bname;
    }
}

if (!function_exists('users_charts')) {
    function users_charts(int $day)
    {
        $users = [
            User::whereDate('created_at', today())->count(),
        ];
        for ($i = 1; $i <= $day; $i++) {
            array_push($users, User::whereDate('created_at', today()->subDays($i))->count());
        }
        return $users;

    }
}

if (!function_exists('seller_sales_charts')) {
    function seller_sales_charts(int $day, $period = 'days')
    {
        $user_id = auth()->user()->id;
        if ($period == 'days') {
            $solds = [
                App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'));
            }
        } elseif ($period == 'months') {
            $solds = [
                App\Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'));
            }
        } else {
            $solds = [
                App\Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sold'));
            }
        }
        return $solds;

    }
}

if (!function_exists('revenue_chart')) {
    function revenue_chart(int $day, $period = 'days')
    {
        $user_id = auth()->user()->id;
        if ($period == 'days') {
            $solds = [
                App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'));
            }
        } elseif ($period == 'months') {
            $solds = [
                App\Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'));
            }
        } else {
            $solds = [
                App\Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('sale_price'));
            }
        }
        return $solds;

    }
}

if (!function_exists('profit_chart')) {
    function profit_chart(int $day, $period = 'days')
    {
        $user_id = auth()->user()->id;
        if ($period == 'days') {
            $solds = [
                App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')));
            }
        } elseif ($period == 'months') {
            $solds = [
                App\Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')));
            }
        } else {
            $solds = [
                App\Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->value(\DB::raw('SUM(sale_price - purchase_price)')));
            }
        }
        return $solds;

    }
}

if (!function_exists('cost_chart')) {
    function cost_chart(int $day, $period = 'days')
    {
        $user_id = auth()->user()->id;
        if ($period == 'days') {
            $solds = [
                App\Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'));
            }
        } elseif ($period == 'months') {
            $solds = [
                App\Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'));
            }
        } else {
            $solds = [
                App\Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, App\Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($user_id) {
                    $query->where('user_id', $user_id);
                })->sum('purchase_price'));
            }
        }
        return $solds;

    }
}

if (!function_exists('curr')) {
    function curr($price)
    {
        return currency(floatVal($price), 'USD', strip_tags(currency()->getUserCurrency()));
    }
}

/* if (!function_exists('getPercentageChange')) {
    function getPercentageChange($oldNumber, $newNumber)
    {
        if ($oldNumber == 0) {
            return 100;
        }
        $decreaseValue = $oldNumber - $newNumber;

        return ($decreaseValue / $oldNumber) * 100;
    }
} */

if (!function_exists('sortProducts')) {
    function sortProducts($brand = null, $products = [],$attributes = [], $sort = 'newness', $perpage = 20)
    {
        if ($sort === 'popularity') {
            return $products = visits('App\Product')->top(100);
        } elseif ($sort === 'newness') {

            return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('id', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        } elseif ($sort === 'price-asc') {
            return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('sale_price', 'asc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        } elseif ($sort === 'price-desc') {
            return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('sale_price', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        }if ($sort === 'rating') {
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $trad = Tradmark::where('id', $brand)->first();
                if ($trad) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Product::whereIn('id',$products)->where('tradmark_id', $trad->id)
                            ->where('visible', 'visible')
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0'));
                            }])
                            ->disableCache()->orderByDesc('average_rating')
                            ->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Product::whereIn('id',$products)->where('tradmark_id', $trad->id)
                            ->where('visible', 'visible')
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }

            if ($attributes && is_array($attributes)) {

                $attr_id = $attributes;
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        } else {
            return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('id', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::whereIn('id',$products)->where('visible', 'visible')
                    ->where('visible', 'visible')
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        }
    }
}

if (!function_exists('shop_sort_products')) {
    function shop_sort_products($brand = null,$attributes = [], $sort = 'newness', $perpage = 20)
    {
        if ($sort === 'popularity') {
            return $products = visits('App\Product')->top(100);
        } elseif ($sort === 'newness') {

            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }


            if ($attributes && is_array($attributes)) {

                $attr_id = $attributes;
                return $products = Product::IsApproved()
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);

            }

        } elseif ($sort === 'price-asc') {

            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()
                            ->orderBy('sale_price','asc')
                            ->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()->orderBy('sale_price','asc')
                            ->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->orderBy('sale_price','asc')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->orderBy('sale_price','asc')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        } elseif ($sort === 'price-desc') {

            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()
                            ->orderBy('sale_price','desc')->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()
                            ->orderBy('sale_price','desc')->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()
                    ->orderBy('sale_price','desc')->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()
                    ->orderBy('sale_price','desc')->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        }if ($sort === 'rating') {
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $trad = Tradmark::where('id', $brand)->first();
                if ($trad) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0'));
                            }])
                            ->disableCache()->orderByDesc('average_rating')
                            ->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }

            if ($attributes && is_array($attributes)) {

                $attr_id = $attributes;
                return $products = Product::IsApproved()
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        } else {
            return $products = Product::IsApproved()
                ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('id', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        }
    }
}


if (!function_exists('sortProductsDiscount')) {
    function sortProductsDiscount($brand = null, $attributes = [], $sort = 'newness', $perpage = 20)
    {
        if ($sort === 'popularity') {
            return $products = visits('App\Product')->top(100);
        } elseif ($sort === 'newness') {

            return $products = Product::IsApproved()
            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('id', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        } elseif ($sort === 'price-asc') {
            return $products = Product::IsApproved()
            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('sale_price', 'asc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        } elseif ($sort === 'price-desc') {
            return $products = Product::IsApproved()
            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                ->select('name', 'image','short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('sale_price', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                return $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }

        }if ($sort === 'rating') {
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $trad = Tradmark::where('id', $brand)->first();
                if ($trad) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0'));
                            }])
                            ->disableCache()->orderByDesc('average_rating')
                            ->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Product::IsApproved()->where('tradmark_id', $trad->id)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->withCount(['ratings as average_rating' => function ($query) {
                                $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                            }])->orderByDesc('average_rating')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }

            if ($attributes && is_array($attributes)) {

                $attr_id = $attributes;
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->where('approved', 1)->select(DB::raw('coalesce(avg(rating),0)'));
                    }])->orderByDesc('average_rating')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        } else {
            return $products = Product::IsApproved()
            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                ->orderBy('id', 'desc')->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            $pros = [];
            if (is_numeric($brand) && $brand) {
                $pros = Tradmark::where('id', $brand)->first();
                if ($pros) {
                    if ($attributes && is_array($attributes)) {
                        $attr_id = $attributes;
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->whereHas('attributes', function ($q) use ($attr_id) {
                                $q->whereIn('id', $attr_id);
                            })
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    } else {
                        return $pros = Tradmark::where('id', $brand)->first()->productsSortBy($sort)
                            ->where('visible', 'visible')
                            ->where('approved', 1)
                            ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                            ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                            ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
                    }
                }
            }
            if ($attributes && is_array($attributes)) {
                $attr_id = $attributes;
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->whereHas('attributes', function ($q) use ($attr_id) {
                        $q->whereIn('id', $attr_id);
                    })
                    ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = Product::IsApproved()
                ->whereHas('discount', function ($d) {
                        $d->where('condition', 'percentage_of_product_price')
                        ->orWhere('condition', 'fixed_amount')
                        ->where('start_at', '<=',\Carbon\Carbon::now())
                        ->where('expire_at', '>',\Carbon\Carbon::now())->orderBy('id', 'desc');
                    })
                    ->select('name','short_description', 'image', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        }
    }
}


if (!function_exists('check_stock')) {
    function check_stock($cart)
    {
        foreach ($cart->buyable->variations as $variation) {
            if (count($variation->attributes()->pluck('name')->diff(array_values($cart->options))) === 0) {
                if ($variation->visible == 'hidden' || $variation->in_stock == 'out_stock') {
                    return 0;
                } else {
                    return $cart->buyable->stock;
                }
            }
        }
    }
}

if (!function_exists('get_purchase_price')) {
    function get_purchase_price($cart)
    {
        if ($cart->buyable->IsAvailable()) {
            foreach ($cart->buyable->variations as $variation) {
                if (count($variation->attributes()->pluck('name')->diff(array_values($cart->options))) === 0) {
                    if ($variation['visible'] === 'hidden' || $variation->in_stock === 'out_stock') {
                        return $cart->buyable->purchase_price;
                    } else {
                        return $variation->purchase_price;
                    }
                }
            }
            return $cart->buyable->purchase_price;

        } else {
            return $cart->buyable->purchase_price;
        }
    }
}


if(!function_exists('profit_calc')) {
    function profit_calc($days) {
        return \App\Sold::whereDate('created_at',today()->subDays($days))->value(\DB::raw('SUM((sale_price * sold - purchase_price * sold) - coupon)'));
    }
}
if(!function_exists('sales_calc')) {
    function sales_calc($days) {
        return \App\Sold::whereDate('created_at',today()->subDays($days))->sum('sold');
    }
}

if(!function_exists('getPercentageChange')) {
    function getPercentageChange($oldNumber, $newNumber){
        $decreaseValue = $oldNumber - $newNumber;

        return ($decreaseValue / $oldNumber) * 100;
    }
}
