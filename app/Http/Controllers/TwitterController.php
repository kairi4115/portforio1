<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function tweetProduct($id)
    {
        // 商品情報を取得
        $product = Product::find($id);

        if (!$product) {
            abort(404);
        }

        // Twitter投稿に使用する情報
        $status = "Check out this product: {$product->name} - {$product->description} Price: {$product->price} 円 + 税";

        // Twitter APIへのアクセス
        $twitter = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret')
        );

        // 画像をアップロード
        $media = asset('C:\xampp\htdocs\creperestaurant\public\images') . '/' . $product->image; // 画像のURL
        $imagePath = public_path('images') . DIRECTORY_SEPARATOR . $product->image;

        if (file_exists($imagePath)) {
            // 画像をアップロード
            $media_upload = $twitter->upload('media/upload', ['media' => $imagePath]);
           
            // 投稿に画像を添付
            $parameters = [
                'status' => $status,
                'media_ids' => $media_upload->media_id_string,
            ];

            // 投稿実行
            $result = $twitter->post('statuses/update', $parameters);

            return redirect()->back()->with('success', 'Product tweeted successfully');
        } else {
            // ファイルが存在しない場合
            Log::error('Image file not found: ' . $imagePath);
            return redirect()->back()->with('error', 'Failed to tweet product: image not found');
        }
    }
}
