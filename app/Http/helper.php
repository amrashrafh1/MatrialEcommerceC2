<?php

use App\Product;
use App\Shipping_methods;
use App\Sold;
use App\Tradmark;
use App\User;
use App\ContactUs;
use Illuminate\Support\Facades\DB;
// /Admin url

if (!function_exists('aurl')) {
    function aurl($url = null)
    {
        return url('/admin' . $url);
    }
}
// upload single file
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
// upload multiple file

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

            $model->gallery()->create([
                'name' => $filenametostore,
                'size' => $logo->filesize(),
                'file' => $img,
                'path' => 'public/' . $path . '/',
                'mime_type' => $extension,
            ]);
        }
    }
}

// calc free space
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

// get users by day
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
// get sales by day

if (!function_exists('seller_sales_charts')) {
    function seller_sales_charts(int $day, $period = 'days', $seller_id)
    {
        if ($period == 'days') {

            $solds = [
                Sold::whereDate('created_at', today())
                    ->whereHas('product', function ($query) use ($seller_id) {
                        $query->where('seller_id', $seller_id);
                    })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', today()->subDays($i))
                        ->whereHas('product', function ($query) use ($seller_id) {
                            $query->where('seller_id', $seller_id);
                        })->sum('sold'));
            }
        } elseif ($period == 'months') {
            $solds = [
                Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('sold'));
            }
        } else {
            $solds = [
                Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('sold'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('sold'));
            }
        }
        return $solds;

    }
}
//  get sales by (days, months, years)

if (!function_exists('revenue_chart')) {
    function revenue_chart(int $day, $period = 'days', $seller_id)
    {
        if ($period == 'days') {
            $solds = [
                Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')));
            }
        } elseif ($period == 'months') {
            $solds = [
                Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')));
            }
        } else {
            $solds = [
                Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM((sale_price * sold )  - coupon)')));
            }
        }
        return $solds;

    }
}

//  get profits by (days, months, years)

if (!function_exists('profit_chart')) {
    function profit_chart(int $day, $period = 'days', $seller_id)
    {
        if ($period == 'days') {
            $solds = [
                Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')));
            }
        } elseif ($period == 'months') {
            $solds = [
                Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')));
            }
        } else {
            $solds = [
                Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->value(DB::raw('SUM(sale_price - purchase_price)')));
            }
        }
        return $solds;

    }
}
//  get cost by (days, months, years)

if (!function_exists('cost_chart')) {
    function cost_chart(int $day, $period = 'days', $seller_id)
    {
        if ($period == 'days') {
            $solds = [
                Sold::whereDate('created_at', today())->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', today()->subDays($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('purchase_price'));
            }
        } elseif ($period == 'months') {
            $solds = [
                Sold::whereMonth('created_at', \Carbon\Carbon::now()->month)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->startOfMonth($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('purchase_price'));
            }
        } else {
            $solds = [
                Sold::whereYear('created_at', \Carbon\Carbon::now()->year)->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
                })->sum('purchase_price'),
            ];
            for ($i = 1; $i <= $day; $i++) {
                array_push($solds, Sold::whereDate('created_at', \Carbon\Carbon::now()->subYear($i))->whereHas('product', function ($query) use ($seller_id) {
                    $query->where('seller_id', $seller_id);
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

// for Shop page & CMS page (event page)
if (!function_exists('shop_sort')) {
    function shop_sort($cat_id = null, $prods = null, $brand = null, $attributes = [], $sort = 'newness', $perpage = 20)
    {
        $products = [];
        $pros = [];
        $tradmark = Tradmark::where('id', $brand)->first();
        if ($tradmark) {
            return $products = tradmark_exist(($cat_id) ? $cat_id : null, ($prods) ? $prods : null, $tradmark, $attributes, $sort, $perpage);
        } else {
            // if $attributes not null
            return $products = tradmark_not_exist(($cat_id) ? $cat_id : null, ($prods) ? $prods : null, $attributes, $sort, $perpage);
        }
    }
}

if (!function_exists('brand_sort')) {
    function brand_sort($brand_id, $brand = null, $attributes = [], $sort = 'newness', $perpage = 20)
    {
        $products = [];
        $pros = [];
        $tradmark = Tradmark::where('id', $brand)->first();
        if ($tradmark) {
            if ($attributes && count($attributes) > 0) {
                return $products = $tradmark->productsSortBy($sort)
                //->where('tradmark_id', $brand_id)
                    ->whereHas('attributes', function ($q) use ($attributes) {
                        $q->whereIn('id', $attributes);
                    })
                    //->select('name', 'image', 'tax', 'short_description', 'category_id','tradmark_id','sale_price', 'sku', 'id', 'slug', 'product_type')->with(['ratings', 'discount', 'methods'])
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = $tradmark->productsSortBy($sort)
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
            // if not $tradmark exist
        }
        return redirect()->route('shop');
    }
}

if (!function_exists('sortProductsDiscount')) {
    function sortProductsDiscount($brand = null, $attributes = [], $sort = 'newness', $perpage = 20)
    {
        $products = [];
        $pros = [];
        $tradmark = Tradmark::where('id', $brand)->first();
        if ($tradmark) {
            if ($attributes && count($attributes) > 0) {
                return $products = $tradmark->discountProductsSortBy($sort)
                    ->whereHas('attributes', function ($q) use ($attributes) {
                        $q->whereIn('id', $attributes);
                    })
                //->select('name', 'image', 'tax', 'short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            } else {
                return $products = $tradmark->discountProductsSortBy($sort)
                //->select('name', 'image', 'tax', 'short_description', 'sale_price', 'sku', 'id', 'slug', 'product_type')
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
            // if not $tradmark exist
        } else {

            // if $attributes not null

            if ($attributes && count($attributes) > 0) {
                return $products = Product::hasDiscount()
                    ->productsSortBy($sort)
                    ->whereHas('attributes', function ($q) use ($attributes) {
                        $q->whereIn('id', $attributes);
                    })
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);

                // if $attributes null
            } else {
                return $products = Product::hasDiscount()
                    ->productsSortBy($sort)
                    ->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
            }
        }
    }
}

if (!function_exists('get_purchase_price')) {
    function get_purchase_price($cart)
    {
        return $cart->buyable->purchase_price;
    }
}

if (!function_exists('profit_calc')) {
    function profit_calc($days)
    {
        return intval(Sold::whereDate('created_at', today()->subDays($days))
                ->value(DB::raw('SUM((sale_price * sold - purchase_price * sold) - coupon)')));
    }
}

if (!function_exists('revenue_calc')) {
    function revenue_calc($days)
    {
        return intval(Sold::whereDate('created_at', today()->subDays($days))
                ->value(DB::raw('SUM((sale_price * sold )  - coupon)')));
    }
}
if (!function_exists('sales_calc')) {
    function sales_calc($days)
    {
        if($days == 0) {
            return Sold::whereDate('created_at', today())->sum('sold');
        }
        return Sold::whereDate('created_at', today()->subDays($days))->sum('sold');
    }
}
if (!function_exists('contact_us_messages')) {
    function contact_us_messages($days)
    {
        if($days == 0) {
            return ContactUs::whereDate('created_at', today())->count();
        }
        return ContactUs::whereDate('created_at', today()->subDays($days))->count();
    }
}

if (!function_exists('getPercentageChange')) {
    function getPercentageChange($oldNumber, $newNumber)
    {
        $decreaseValue = $oldNumber - $newNumber;

        return ($decreaseValue / $oldNumber) * 100;
    }
}

if (!function_exists('tradmark_exist')) {
    function tradmark_exist($cat_id = null, $prods = null, $tradmark = null, $attributes = [], $sort, $perpage)
    {
        if ($attributes && count($attributes) > 0) {
            $query = $tradmark->productsSortBy($sort);
            if ($cat_id) {
                if (count($cat_id) > 1 ) {
                    $query->whereIn('category_id', $cat_id);
                } elseif(count($cat_id) == 1 ) {
                    $query->where('category_id', $cat_id);
                }
            }
            ;
            if ($prods) {
                $query->whereIn('id', $prods);
            }
            ;
            return $query->whereHas('attributes', function ($q) use ($attributes) {
                $q->whereIn('id', $attributes);
            })->with(['ratings'=> function ($query) {
                $query->where('approved', 1);
            }, 'discount', 'methods'])->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
        } else {
            $query = $tradmark->productsSortBy($sort);
            if ($cat_id) {
                if (count($cat_id) > 1 ) {
                    $query->whereIn('category_id', $cat_id);
                } elseif(count($cat_id) == 1 ) {
                    $query->where('category_id', $cat_id);
                }
            }

            if ($prods) {
                $query->whereIn('id', $prods);
            }

            return $query->with(['ratings'=> function ($query) {
                $query->where('approved', 1);
            }, 'discount', 'methods'])->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
        }
    }
}

if (!function_exists('tradmark_not_exist')) {
    function tradmark_not_exist($cat_id = null, $prods = null, $attributes = [], $sort, $perpage)
    {

        // if $attributes not null
        if ($attributes && count($attributes) > 0) {
            $query = Product::with(['ratings'=> function ($query) {
                $query->where('approved', 1);
            }, 'discount', 'methods'])->IsApproved()->productsSortBy($sort);
            if ($cat_id) {
                if (count($cat_id) > 1 ) {
                    $query->whereIn('category_id', $cat_id);
                } elseif(count($cat_id) == 1 ) {
                    $query->where('category_id', $cat_id);
                }
            }
            ;
            if ($prods) {
                $query->whereIn('id', $prods);
            };
            return $query->whereHas('attributes', function ($q) use ($attributes) {
                $q->whereIn('id', $attributes);
            })->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);

        } else {
            // if $attributes null

            $query = Product::with(['ratings'=> function ($query) {
                $query->where('approved', 1);
            }, 'discount', 'methods'])->IsApproved()->productsSortBy($sort);
            if ($cat_id) {
                if (count($cat_id) > 1 ) {
                    $query->whereIn('category_id', $cat_id);
                } elseif(count($cat_id) == 1 ) {
                    $query->where('category_id', $cat_id);
                }
            };
            if ($prods) {
                $query->whereIn('id', $prods);
            };

            return $query->disableCache()->paginate((is_numeric($perpage)) ? $perpage : 20);
        }
    }
}

if (!function_exists('quantity_based_per_order')) {
    function quantity_based_per_order(Shipping_methods $method, $qty)
    {
        $rates = $method->rates;
        foreach ($rates as $rate) {
            if ($qty >= $rate->from && $qty <= $rate->to) {
                return $rate->value;
            }
            ;
        }
        return 0;
    }
}
if (!function_exists('weight_based_per_order')) {
    function weight_based_per_order($weight, Shipping_methods $method, $qty)
    {
        $rates = $method->rates;
        foreach ($rates as $rate) {
            if (($weight * $qty) >= $rate->from && ($weight * $qty) <= $rate->to) {
                return $rate->value;
            }
            ;
        }
        return 0;
    }
}

if (!function_exists('carts_content')) {
    function carts_content()
    {
        $carts = [];
        if (session()->get('items') !== null) {
            foreach (session()->get('items') as $cart) {
                array_push($carts, ['cart' => \Cart::content()->find($cart['item']), 'shipping' => Shipping_methods::findOrfail($cart['shipping'])]);
            }
            return collect($carts);
        }
        foreach (\Cart::content() as $cart) {
            array_push($carts, ['cart' => $cart, 'shipping' => get_shipping($cart->getProduct())]);
        }

        return collect($carts);
    }
}

if (!function_exists('get_shipping')) {
    function get_shipping($product)
    {
        $country_id = (session('country')) ? session('country') : 1;
        $country = DB::table('countries')->where('id', $country_id)->first();

        $method = $product->methods()->where('status', 0)
        ->whereHas('zone', function ($q) use ($country_id) {
            $q->whereHas('countries', function ($query) use ($country_id) {
                $query->where('id', $country_id);
            });
        })->first();
        if (blank($method)) {
            // will get the default shipping method if has this country
            $defaultShipping = config('app.setting');
            if ($defaultShipping->default_shipping == 1 && $defaultShipping->shipping !== null) {

                $isDefaultMethod = $defaultShipping->shipping()->where('status', 0)
                ->whereHas('zone', function ($q) use ($country_id) {
                    $q->whereHas('countries', function ($query) use ($country_id) {
                        $query->where('id', $country_id);
                    });
                })->first();
                // push $defaultShipping to shippings array
                if ($isDefaultMethod !== null) {

                    return $isDefaultMethod;

                } else {
                    // if $defaultShipping empty remove this item from items array
                    return null;
                }

            }
            // if $defaultShipping empty remove this item from items array
            if ($defaultShipping->default_shipping != 1 || $defaultShipping->shipping == null) {
                return null;
            }
        }
        return $method;
    }
}
